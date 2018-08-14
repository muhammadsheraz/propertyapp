<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\District;

use App\Notifications\Backend\CityCreated;
use App\Notifications\Backend\CityUpdated;
use App\Notifications\Backend\CityDeleted;

use DB;

class CitiesController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
	{
		$cities_rs = DB::table('cities');
		$cities_rs->leftJoin('districts', 'cities.id', '=', 'districts.city_id');
		$cities_rs->select(
				'cities.id', 
				'cities.city_name', 
				DB::raw('GROUP_CONCAT(districts.name) AS district_name')
		)
		->orderBy("cities.city_name",'ASC');
		
		$cities_rs->groupBy('cities.id','cities.city_name');
		
		$data['cities'] = $cities_rs->get();
            
	    return view('backend.cities.index', $data);
	}

	public function create(Request $request)
	{
	    return view('backend.cities.add');
	}

	public function edit(Request $request, $id)
	{
            $city = City::findOrFail($id);

            $data['model'] = $city;

	    return view('backend.cities.add', $data);
	}

	public function show(Request $request, $id)
	{
            $city = City::findOrFail($id);
	    return view('backend.cities.show', [
	        'model' => $city	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM cities a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE city_name LIKE '%".$_GET['search']['value']."%' ";
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
	        'city_name' => 'required|max:255',
		]);

		$city = null;
		if($request->id > 0) { 
			$city = City::findOrFail($request->id); }
		else { 
			$city = new City;
		}
	    	
		$city->id = $request->id?:0;
		$city->city_name = $request->city_name;
		$city->save();
		
		$administrator = User::role('administrator')->get();

		if($request->id > 0) {
			## City Updated
			\Notification::send($administrator, new CityUpdated($administrator, $city));
			$response_message = __('alerts.general.city_updated');
		} else {
			## City Created
			\Notification::send($administrator, new CityCreated($administrator, $city));
			$response_message = __('alerts.general.city_created');
		}			

	    return redirect('/admin/cities')->withFlashSuccess($response_message);
	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
            $city = City::findOrFail($id);

            $users = DB::table('users')->select('*')->where(['city_id' => $id])->get();

            if (count($users) > 0) {
                    return redirect('/admin/cities')->withFlashDanger(__('alerts.general.associated_city_cannot_be_deleted'));
            }

            $city->delete();

            $administrator = User::role('administrator')->get();
            \Notification::send($administrator, new CityDeleted($administrator, $city));

	    return redirect('/admin/cities')->withFlashSuccess(__('alerts.general.city_deleted'));	    
	}
	
}