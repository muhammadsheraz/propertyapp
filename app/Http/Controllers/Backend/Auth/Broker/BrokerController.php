<?php

namespace App\Http\Controllers\Backend\Auth\Broker;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\Backend\Auth\User\UserReactivated;

use Illuminate\Support\Facades\Mail;
use App\Mail\Backend\Account\SendNotification;
use App\Models\Properties;

use DB;

use App\Events\Backend\Auth\User\UserDeleted;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\BrokerRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Notifications\Backend\Auth\BrokerAccountDeleted;
use App\Notifications\Backend\Auth\BrokerAccountCreated;
use App\Notifications\Backend\Auth\BrokerAccountUpdated;
use App\Notifications\Backend\Auth\BrokerAccountActive;
use App\Notifications\Backend\Auth\BrokerAccountInActive;
use App\Notifications\Backend\Auth\BrokerContractConfirmed;
use App\Notifications\Backend\Auth\BrokerContractDiscontinued;
use App\Notifications\Backend\PropertyAssigned;
use App\Notifications\Backend\PropertyDeleted;
use Illuminate\Validation\Rule;

class BrokerController extends Controller
{

    public function index()
	{
		$users = User::role('broker')
			->leftJoin('cities', 'users.city_id', '=', 'cities.id')
			->leftJoin('districts', 'users.district_id', '=', 'districts.id')
			->leftJoin('properties', 'users.id', '=', 'properties.broker_id')
			->select(
				'users.*',
				DB::raw('cities.id AS city_id'),
				DB::raw('cities.city_name AS city_name'),
				DB::raw('districts.id AS district_id'),
				DB::raw('districts.name AS district_name'),
				DB::raw('count(properties.id) AS properties_count')
			)
			->groupBy('users.id')
			->get();

		$data['users'] = $users;
		$data['brokers'] = User::getAllBrokers()->get();

		$cities_temp = DB::table('cities')->select('*')->get();
		foreach ($cities_temp as $city) {
			$cities[$city->id] = (array)$city;
		}

		$data['cities'] = $cities;

	    return view('backend.auth.broker.index', $data);
	}

	public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
	{

            $data['cities'] = DB::table('cities')->select('*')->orderBy("city_name",'ASC')->get();
            $data['districts'] = DB::table('districts')->orderBy("name",'ASC')->select('*')->get();
            $data['roles'] = $roleRepository->where('id', 2)->with('permissions')->get(['id', 'name']);
			$data['permissions'] = $permissionRepository->get(['id', 'name']);
            
            return view('backend.auth.broker.create', $data);
	}

	public function edit(Request $request, $id, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
	{
		if (auth()->user()->hasRole('broker')) {
			return redirect('/admin');
		}		

		$user = User::findOrFail($id);
		$data['user'] = $user; 
		$data['roles'] = $roleRepository->get(); 
		$data['userRoles'] = $user->roles->pluck('name')->all();
		$data['permissions'] = $permissionRepository->get(['id', 'name']);
		$data['userPermissions'] = $user->permissions->pluck('name')->all();
		$data['cities'] = DB::table('cities')->select('*')->orderBy("city_name",'ASC')->get();
		$data['districts'] = DB::table('districts')->orderBy("name",'ASC')->select('*')->get();

		return view('backend.auth.broker.edit', $data);
	}

	public function show(Request $request, $id)
	{
		if (auth()->user()->hasRole('broker')) {
			return redirect('/admin');
		}	

		$user = User::find($id);
		return view('backend.auth.broker.show')->withUser($user);
	}

	public function list(Request $request)
	{
		if (auth()->user()->hasRole('broker')) {
			return redirect('/admin');
		}

		$get = $request->all();

		$sql = "SELECT p.*, c.city_name AS city_name, d.name AS district_name FROM properties p";
		$sql .= " LEFT JOIN cities c ON p.city_id = c.id";
		$sql .= " LEFT JOIN districts d ON p.district_id = d.id";
		$presql = " WHERE 1 = 1";
		$sql_params = [];

		if (!empty($get)) {
			$length = $request->input('length', '');
			$start = $request->input('start', '');
			$search_text = $request->input('search_text', false);
			$city_id = $request->input('city_id', '');
			$district_id = $request->input('district_id', '');
			$property_purpose = $request->input('property_purpose', '');

			if(!empty($search_text)) {	
				$presql .= " AND (p.title LIKE '%:search_text%' OR p.description LIKE '%:search_text%') ";
				$sql_params['search_text'] = $search_text;
			}
			
			if(!empty($city_id)) {	
				$presql .= " AND p.city_id = '$city_id' ";
				$sql_params['city_id'] = $city_id;
			}
			
			if(!empty($district_id)) {	
				$presql .= " AND p.district_id = '$district_id' ";
				$sql_params['district_id'] = $district_id;
			}

			if(!empty($property_purpose)) {	
				$presql .= " AND p.property_purpose = '$property_purpose' ";
				$sql_params['property_purpose'] = $property_purpose;
			}
	
			$sql .= $presql;
		}

		$properties = DB::select($sql, $sql_params);

        $cities = DB::table('cities')->select('*')->orderBy("city_name",'ASC')->get();
        $districts = DB::table('districts')->orderBy("name",'ASC')->select('*')->get();

        $data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['properties'] = $properties;
		
		return view('frontend.properties_list', $data);
	}


    public function update(Request $request, $id)
    {
		if (auth()->user()->hasRole('broker')) {
			return redirect('/admin');
		}

		$this->validate($request, [
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($id),],
            'first_name'  => 'required|max:75',
            'last_name'  => 'required|max:75',
			'phone_no'   => ['required', 'string', 'max:25', Rule::unique('users')->ignore($id),],
			'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2000',
            'timezone' => 'required|max:191',
			'roles' => 'required|array',
			'commission_sale_landlord' => ['required','numeric','min:1', 'max:100'],
			'commission_sale_buyer' => ['required','numeric','min:1', 'max:100'],
			'commission_rent_landlord' => ['required','numeric', 'min:1', 'max:100'],
			'commission_rent_tenant' => ['required','numeric', 'min:1', 'max:100'],
		]);

		$user = User::find($id);
		$brokerRepository = new BrokerRepository();	

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();		

		if (!empty($request->input('active'))) {
			if (empty($user->active)) {
				event(new UserReactivated($user));

				## Broker Account Activated
				\Notification::send($administrator, new BrokerAccountActive($done_by, $user));

				if (!empty($user))
					\Notification::send($user, new BrokerAccountActive($done_by, $user));			
			}
		} else {
			if (!empty($user->active)) {
				## Broker Account Inactivated
				\Notification::send($administrator, new BrokerAccountInActive($done_by, $user));

				if (!empty($user)) {
					\Notification::send($user, new BrokerAccountInActive($done_by, $user));	
				}				
			}
		}		

		if (!empty($request->input('contract_confirmed'))) {
			if (empty($user->contract_confirmed)) {
				## Broker Contract Confirmed
				\Notification::send($administrator, new BrokerContractConfirmed($done_by, $user));

				if (!empty($user)) {
					\Notification::send($user, new BrokerContractConfirmed($done_by, $user));
				}			
			}
		} else {
			if (!empty($user->contract_confirmed)) {
				## Broker Contract Discontinued
				\Notification::send($administrator, new BrokerContractDiscontinued($done_by, $user));

				if (!empty($user)) {
					\Notification::send($user, new BrokerContractDiscontinued($done_by, $user));
				}
			}			
		}		

		$brokerRepository->update(
			$user,
			$request->only(
				'first_name',
				'last_name',
				'email',
				'active',
				'confirmed',
				'city_id',
				'district_id',
				'nearest_landmark',
				'company_name',
				'tax_no',
				'phone_no',
				'mobile_no',	
				'contract_confirmed',	
				'property_limit',	
				'commission_sale_landlord',	
				'commission_sale_buyer',	
				'commission_rent_landlord',	
				'commission_rent_tenant',	
				'avatar_type',		
				'timezone',
				'roles',
				'permissions',
				'is_default'
			),
			$request->has('profile_photo') ? $request->file('profile_photo') : false
		);	

		## Broker Account Updated
		// \Notification::send($administrator, new BrokerAccountUpdated($done_by, $user));

		// if (!empty($user)) {
		// 	\Notification::send($user, new BrokerAccountUpdated($done_by, $user));
		// }			

        return redirect()->route('admin.auth.broker.index')->withFlashSuccess(__('alerts.backend.brokers.updated'));
    }

	public function store(Request $request)
	{
		$brokerRepository = new BrokerRepository();
		$this->validate($request, [
            'email' => ['required', 'email', 'max:100', Rule::unique('users')],
            'first_name'  => 'required|max:75',
            'last_name'  => 'required|max:75',
			'phone_no'   => ['required', 'string', 'max:25', Rule::unique('users')],
			'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2000',
			'commission_sale_landlord' => ['required','numeric','min:1', 'max:100'],
			'commission_sale_buyer' => ['required','numeric','min:1', 'max:100'],
			'commission_rent_landlord' => ['required','numeric', 'min:1', 'max:100'],
			'commission_rent_tenant' => ['required','numeric', 'min:1', 'max:100'],		
		]);

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();		
		
        $broker = $brokerRepository->create(
			$request->only(
				'first_name',
				'last_name',
				'email',
				'password',
				'city_id',
				'district_id',
				'nearest_landmark',
				'company_name',
				'tax_no',
				'phone_no',
				'mobile_no',
				'avatar_type',
				'timezone',
				'active',
				'confirmed',
				'property_limit',
				'confirmation_email',
				'commission_sale_landlord',	
				'commission_sale_buyer',	
				'commission_rent_landlord',	
				'commission_rent_tenant',				
				'roles',
				'permissions',
				'is_default'
			),

			$request->has('profile_photo') ? $request->file('profile_photo') : false
		);

		## Broker Created
		\Notification::send($administrator, new BrokerAccountCreated($done_by, $broker));

		if (!empty($broker))
			\Notification::send($broker, new BrokerAccountCreated($done_by, $broker));		

        return redirect()->route('admin.auth.broker.index')->withFlashSuccess(__('alerts.backend.brokers.created'));
	}

	public function download_contract_file(Request $request, $id) {
		$user = User::findOrFail($id);
		return \Storage::download($user->contract_file);
		// return response()->download($pathToFile);
	}

	public function destroy(Request $request, $id) {
		$done_by = auth()->user();	
		$user = User::find($id);
		$administrator = User::role('administrator')->get();
		
		\Notification::send($user, new BrokerAccountDeleted($done_by, $user));   
		
		$administrator = User::role('administrator')->get();
		\Notification::send($administrator, new BrokerAccountDeleted($done_by, $user));
		
		$properties = DB::table('properties')->select('*')->where('broker_id', $id)->get()->toArray();
		
		if (!empty($properties)) {
			if (config('app.safe_broker_delete')) {
				$new_broker_id = $request->input('_new_broker_id');

				foreach ($properties as $p) {
					$property = Properties::findOrFail($p->id);

					$property->broker_id = $new_broker_id;
					$property->save();

					$assignee_broker = User::find($new_broker_id);
					$administrator = User::role('administrator')->get();
					
					## Notification for Aministrator
					\Notification::send($administrator, new PropertyAssigned($done_by, $property, $assignee_broker));

					## Notification for Broker
					\Notification::send($assignee_broker, new PropertyAssigned($done_by, $property, $assignee_broker));
				}
			} else {
				foreach ($properties as $p) {
					$property = Properties::findOrFail($p->id);

					## Property Deleted
					\Notification::send($administrator, new PropertyDeleted($done_by, $property));

					if (!empty($broker))
						\Notification::send($broker, new PropertyDeleted($done_by, $property));	
						
					## Deleting Property	
					$property->delete();
				}
			}
		}		
		
		## Deleting Broker Account
		$user->delete();

		return redirect()->route('admin.auth.broker.index')->withFlashSuccess(__('alerts.backend.brokers.deleted'));
	}
	
}