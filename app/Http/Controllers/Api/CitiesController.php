<?php

namespace App\Http\Controllers\Api;

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

    public function index(Request $request) {
		$district_id = $request->input('district_id');

		$cities_rs = DB::table('cities');
		$cities_rs->leftJoin('districts', 'cities.id', '=', 'districts.city_id');
		$cities_rs->select(
				'cities.id', 
				'cities.city_name', 
				DB::raw('GROUP_CONCAT(districts.name) AS district_name')
		);

		if (!empty($district_id)) {
			$cities_rs->where('districts.id', $district_id);
		}

		$cities_rs->orderBy("cities.city_name",'ASC');
		
		$cities_rs->groupBy('cities.id','cities.city_name');
		
		$data['cities'] = $cities_rs->get();
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function show(Request $request, $id) {
		$city = City::findOrFail($id);
		
		$data['status'] = 'success';
		$data['city'] = $city;

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	
}