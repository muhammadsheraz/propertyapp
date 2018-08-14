<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use Illuminate\Http\UploadedFile;
use App\Models\Property_requests;
use App\Models\City;
use App\Models\District;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Backend\PropertyCreated;
use App\Notifications\Backend\PropertyUpdated;
use App\Notifications\Backend\PropertyDeleted;
use App\Notifications\Backend\PropertyStatusRequest;

use DB;

class PropertyRequestsController extends ApiController
{

    public function index(Request $request)
	{
		$data = [];

		$customer = auth()->user();

		// $property_requests = new Property_requests();
		
		// $property_requests->where('customer_id', $customer->id);


		$property_requests = DB::table('property_requests');
		$property_requests->leftJoin('cities', 'property_requests.city_id', '=', 'cities.id');
		$property_requests->leftJoin('districts', 'property_requests.district_id', '=', 'districts.id');
		$property_requests->leftJoin('users', 'property_requests.broker_id', '=', 'users.id');

		$property_requests->select(
			'property_requests.*',
			'cities.city_name',
			DB::raw('districts.name AS district_name'),
			DB::raw('users.id AS user_id'),
			DB::raw('CONCAT(users.first_name, " ", users.last_name) AS user_fullname'),
			DB::raw('users.phone_no AS user_phone_no'),
			DB::raw('users.mobile_no AS user_mobile_no'),
			DB::raw('users.tax_no AS user_tax_no'),
			DB::raw('users.broker_no AS user_broker_no'),
			DB::raw('users.email AS user_email'),
			DB::raw('users.avatar_location AS user_avatar_location')
		);

		$property_requests->where('customer_id', $customer->id);

		if(!empty($request->input('city_id'))) {
			$property_request->where('city_id', $request->input('city_id'));
		}

		if ($property_requests->count()) {
			$data = [
				'property_requests' => $property_requests->get()->toArray(),
				'status' => 'success',
				'message' =>  $property_requests->count() . ' property request(s) found',
			];

			return response()->json([
				'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	
    	return response()->json([
			'data' => [
				'status' => 'fail',
				'message' => 'property requests not found for this user',
			]
		], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function show(Request $request, $id) {
		$customer = auth()->user();

		$request = Property_requests::find($id)->where('customer_id', $customer->id)->first();

		if ($request) {
			$property_request = $request->toArray();

			$property_request['customer_data'] = User::find($property_request['customer_id'])->only('id', 'broker_no', 'customer_no', 'full_name', 'email', 'phone_no', 'mobile_no');
			$property_request['broker_data'] = User::find($property_request['broker_id'])->only('id', 'broker_no', 'customer_no', 'full_name', 'email', 'phone_no', 'mobile_no');

			$data = [
				'property_request' => $property_request,
				'status' => 'success',
				'message' =>  'property request found',
			];

			return response()->json([
				'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		} else {
			$data = [
				'status' => 'fail',
				'message' =>  'property request not found',
			];

			return response()->json([
				'data' => $data
			], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}

	public function update(Request $request) {
		$property_request = null;
		
		try {
			if($request->id > 0) {
				$property_request = Property_requests::findOrFail($request->id);
			} else {
				$property_request = new Property_requests;
			}

			$broker = User::find($request->broker_id);

			$property_request->id = $request->id?:0;
			$property_request->title = $request->title;
			$property_request->broker_id = !empty($request->broker_id) ? $request->broker_id : 0;
			$property_request->customer_id = auth()->user()->id;
			$property_request->house_no = $request->house_no;
			$property_request->street1 = $request->street1;
			$property_request->street2 = $request->street2;
			$property_request->phone_no = $request->phone_no;

			if (!empty($request->city_id)) {
				$property_request->city_id = $request->city_id;
			} else {
				$property_request->other_city = $request->other_city;
			}

			$property_request->district_id = !empty($request->district_id) ? $request->district_id : 0;		

			// if (!empty($property_request->city_id)) {
			// 	$property_request->city_name = City::find($request->city_id)->first()->city_name;
			// } else {
			// 	$property_request->city_name = $request->other_city;				
			// }

			// $property_request->district_name = District::find($request->district_id)->first()->name;

			$property_request->currency = !empty($request->currency) ? $request->currency : 'USD';
			$property_request->price = $request->price;
			$property_request->purpose = $request->purpose;

			if(empty($request->id)) {
				$property_request->created_at = date('Y-m-d H:i:s');
				$property_request->created_by = auth()->user()->id;
			}

			$property_request->save();

			## Adding Property Requests No
			$property_request_no = 'PR' . str_pad($property_request->id,config('app.property_no_padding_size'),"0",STR_PAD_LEFT);
			$property_request->pr_no = $property_request_no;
			$property_request->save();			

			$property_request_data = $property_request->toArray();

			$data['property_request'] = $property_request_data;		

			if (!empty($property_request_data['city_id'])) {
				$users = User::where('city_id', $property_request_data['city_id']);

				if (empty($users->get()->toArray())) {
					$users = User::where('is_default', 1);
				}

				$data['brokers'] = $users->get();
			} else {
				$data['brokers'] = [];
			}

			$data['status'] = 'success';

			return response()->json([
				'data' => $data
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);					
		} catch (\Exception $e) {
			return response()->json([
				'data' => [
					'message'=>$e->getMessage() . " at :" . $e->getLine(),
					'status'=>'error'
				]
			]);
		}
	}

	public function store(Request $request) {
		$rule = [
			'title' => 'required|max:60',
			'district_id' => 'required|integer',
			'price' => 'required|integer',
			'phone_no' => 'required|numeric',
			'purpose' => 'required',
		];
				
		$messages = [
			'is_agreed.required' => 'You must accept the agreement.',
		];

        \Validator::make($request->all(), $rule, $messages)->validate();

		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		$property_request = Property_requests::findOrFail($id);

		if ($property_request) {
			$property_request->delete();

			$data['messages'] = 'propery request deleted';
			$data['status'] = 'success';

			return response()->json([
				'data' => $data
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		} else {
			return response()->json([
				'data' => [
					'status' => 'fail',
					'message' =>  'property request not found',
				]
			], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}

	private function generateAddress($data = []) {
		$address = '';
		$components = [
			'house_no',
			'street1',
			'street2',
			'district_name',
			'city_name',
			'country_name',
		];

		implode(", ", \array_only($data, $components));

		return $address;
	}
}
