<?php

namespace App\Http\Controllers\Api;

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


    public function index(Request $request) {        
		$city_id = $request->input('city_id');
		$city_name = $request->input('city_name');

		$districts_rs = DB::table('districts');
		$districts_rs->leftJoin('cities', 'districts.city_id', '=', 'cities.id');
		$districts_rs->select(
			'districts.id', 
			'districts.name'
		);
		
		if (!empty($city_id)) {
			$districts_rs->where('districts.city_id', $city_id);
		}

		if (!empty($city_name)) {
			$districts_rs->where('cities.city_name', $city_name);
		}

		$districts_rs->orderBy("districts.name",'ASC');
		
		$data['districts'] = $districts_rs->get();		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function show(Request $request, $id) {
		$district = District::findOrFail($id);

		$data['district'] = $district;		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}	
}