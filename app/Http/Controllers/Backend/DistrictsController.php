<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\District;

use App\Notifications\Backend\DistrictCreated;
use App\Notifications\Backend\DistrictUpdated;
use App\Notifications\Backend\DistrictDeleted;

use DB;

class DistrictsController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{                
            $districts_rs = DB::table('districts');
            $districts_rs->leftJoin('cities', 'districts.city_id', '=', 'cities.id');
            $districts_rs->select(
                    'districts.id', 
                    'districts.name', 
                    DB::raw('cities.city_name')
			)
			->orderBy("districts.name",'ASC');
            
            $data['districts'] = $districts_rs->get();
		
	    return view('backend.districts.index', $data);
	}

	public function create(Request $request)
	{
            $data['cities'] = DB::table('cities')->get();
	    return view('backend.districts.add', $data);
	}

	public function edit(Request $request, $id)
	{
            $district = District::findOrFail($id);
            
            $data['model'] = $district;
            $data['cities'] = DB::table('cities')->get();
	    return view('backend.districts.add', $data);
	}

	public function show(Request $request, $id)
	{
		$district = District::findOrFail($id);
	    return view('backend.districts.show', [
	        'model' => $district	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM districts a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
		}
		
		$presql .= "  ";

		$sql = $select.$presql." LIMIT ".$start.",".$len;


		$qcount = DB::select("SELECT COUNT(a.id) c".$presql);
		//print_r($qcount);
		$count = $qcount[0]->c;

		$results = DB::select($sql);
		$ret = [];
		foreach ($results as $row) {
			$r = [];
			foreach ($row as $value) {
				$r[] = $value;
			}
			$ret[] = $r;
		}

		$ret['data'] = $ret;
		$ret['recordsTotal'] = $count;
		$ret['iTotalDisplayRecords'] = $count;

		$ret['recordsFiltered'] = count($ret);
		$ret['draw'] = $_GET['draw'];

		echo json_encode($ret);

	}


	public function update(Request $request) {
	    
	    $this->validate($request, [
	        'name' => 'required|max:255',
		]);
		
		$district = null;
		if($request->id > 0) { $district = District::findOrFail($request->id); }
		else { 
			$district = new District;
		}
	
		$district->id = $request->id?:0;    		
		$district->city_id = $request->city_id;
		$district->name = $request->name;
		$district->save();
		
		$administrator = User::role('administrator')->get();

		if (!empty($district->broker_id)) 
			$broker = User::find($district->broker_id);

		if($request->id > 0) {
			$response_message = __('alerts.general.district_updated');

			## District Updated
			\Notification::send($administrator, new DistrictUpdated($administrator, $district));

			if (!empty($broker)) 
				\Notification::send($broker, new DistrictUpdated($broker, $district));
		} else {
			$response_message = __('alerts.general.district_created');

			## District Created
			\Notification::send($administrator, new DistrictCreated($administrator, $district));

			if (!empty($broker)) 
				\Notification::send($broker, new DistrictCreated($broker, $district));
		}		

	    return redirect('/admin/districts')->withFlashSuccess($response_message);
	}

	public function store(Request $request)
	{
            return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		$district = District::findOrFail($id);

		$district->delete();

		$administrator = User::role('administrator')->get();
		\Notification::send($administrator, new DistrictDeleted($administrator, $district));

		return redirect('admin/districts')->withFlashSuccess(__('alerts.general.district_deleted'));
	}

	public function delete(Request $request, $id) {
		$district = District::findOrFail($id);

		$district->delete();

		$administrator = User::role('administrator')->get();
		\Notification::send($administrator, new DistrictDeleted($administrator, $district));

		return redirect('admin/districts')->withFlashSuccess(__('alerts.general.district_deleted'));
	}	
}