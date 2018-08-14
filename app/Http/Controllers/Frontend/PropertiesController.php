<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Properties;
use App\Models\Property_type;
use Mapper;
use App\Models\Page;
use DB;
// use Illuminate\Cookie\CookieJar;

class PropertiesController extends Controller
{

    public function index()
	{
		$properties_buy = DB::table('properties')
		->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
		->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
		->leftJoin('users', 'properties.broker_id', '=', 'users.id')
		->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name')
		->where('property_purpose', 'buy')
		->get();

		// Properties Rent        
		$properties_rent = DB::table('properties')
		->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
		->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
		->leftJoin('users', 'properties.broker_id', '=', 'users.id')
		->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name')
		->where('property_purpose', 'rent')
		->get();

		$cities = DB::table('cities')->select('*')->get();
		$districts = DB::table('districts')->select('*')->get();
		$property_types = Property_type::all();
		
		$data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['properties'] = $properties_buy;
		$data['properties_buy'] = $properties_buy;
		$data['properties_rent'] = $properties_rent;
		$data['property_types'] = $property_types;

		// $location = json_encode();
		// $data['location'] = $location;

	    return view('frontend.properties', $data);
	}

	public function create(Request $request)
	{
	    return view('properties.add');
	}

	public function edit(Request $request, $id)
	{
		$propertie = Properties::findOrFail($id);
	    return view('properties.add', [
	        'model' => $propertie	    ]);
	}

	public function show(Request $request, $id)
	{
		$property = DB::table('properties')
		->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
		->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
		->leftJoin('users', 'properties.broker_id', '=', 'users.id')
		->leftJoin('property_types', 'properties.property_type', '=', 'property_types.id')
		->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_types.name as pro_type')
		->where('properties.id', '?')
		->where('properties.status', '?')
		->setBindings([
			$id, 
			config('app.active'),
			])
		->first();

        if (!empty($property)) {
			$cities = DB::table('cities')->select('*')->get();
			$districts = DB::table('districts')->select('*')->get();
			$property_images = DB::table('property_images')->select('*')->where('property_id', '=', $id)->get();
			$property_types = Property_type::all();

			if (!empty($property_images)) {
				foreach ($property_images as $property_image) {
					$property->images[] = $property_image;

					## Setting Cover Image
					if (!empty($property_image->is_featured)) {
						$property->cover_image = $property_image;
					}
				}
			}

			$property->description_excerpt = Str::words(strip_tags($property->description), 50);

			$data['property_types'] = $property_types;
			$data['property'] = $property;
			$data['cities'] = $cities;
			$data['districts'] = $districts;
			$data['property_images'] = $property_images;
			$data['hide_search_bar'] = true;
			
			return view('frontend.properties', $data);
		} else {
			return redirect('/');
		}
	}

	public function preview(Request $request, $id)
	{
		$property = DB::table('properties')
		->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
		->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
		->leftJoin('users', 'properties.broker_id', '=', 'users.id')
		->leftJoin('property_types', 'properties.property_type', '=', 'property_types.id')
		->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_types.name as pro_type')
		->where('properties.id', '?')
		->setBindings([$id])
		->first();

        $cities = DB::table('cities')->select('*')->get();
        $districts = DB::table('districts')->select('*')->get();
        $property_images = DB::table('property_images')->select('*')->where('property_id', '=', $id)->get();
		$property_types = Property_type::all();

		if (!empty($property_images)) {
			foreach ($property_images as $property_image) {
				$property->images[] = $property_image;

				## Setting Cover Image
				if (!empty($property_image->is_featured)) {
					$property->cover_image = $property_image;
				}
			}
		}

		$data['property_types'] = $property_types;
        $data['property'] = $property;
        $data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['property_images'] = $property_images;
		$data['hide_search_bar'] = true;

	    return view('frontend.properties_preview', $data);
	}

	public function panoramic_view(Request $request, $id)
	{
		$property = DB::table('properties')
		->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
		->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
		->leftJoin('users', 'properties.broker_id', '=', 'users.id')
		->leftJoin('property_types', 'properties.property_type', '=', 'property_types.id')
		->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_types.name as pro_type')
		->where('properties.id', '?')
		->where('properties.status', '?')
		->setBindings([
			$id, 
			config('app.active'),
			])
		->first();

        if (!empty($property)) {
			$cities = DB::table('cities')->select('*')->get();
			$districts = DB::table('districts')->select('*')->get();
			$property_images = DB::table('property_images')->select('*')->where('property_id', '=', $id)->get();
			$property_types = Property_type::all();

			if (!empty($property_images)) {
				foreach ($property_images as $property_image) {
					$property->images[] = $property_image;

					## Setting Cover Image
					if (!empty($property_image->is_featured)) {
						$property->cover_image = $property_image;
					}
				}
			}

			$property->description_excerpt = Str::words(strip_tags($property->description), 50);

			$data['property_types'] = $property_types;
			$data['property'] = $property;
			$data['cities'] = $cities;
			$data['districts'] = $districts;
			$data['property_images'] = $property_images;
			$data['hide_search_bar'] = true;
			
			return view('frontend.properties_panoramic_view', $data);
		} else {
			return redirect('/');
		}
	}

	public function rent(Request $request)
	{
		$per_page = 15;
		
		$properties_rs = DB::table('properties')
        ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
        ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
        ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
        ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
        ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
        ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
        ->whereRaw('property_purpose = "rent" and is_featured = 1');

		$properties = [];
		if (!empty($properties_rs)) {
			foreach ($properties_rs->simplePaginate($per_page) as $property) {
				$property_images = DB::table('property_images')->select('*')->where('property_id', '=', $property->id)->get();
		
				if (!empty($property_images)) {
					foreach ($property_images as $property_image) {
						$property->images[] = $property_image;
		
						## Setting Cover Image
						if (!empty($property_image->is_featured)) {
							$property->cover_image = $property_image;
						}
					}
				}

				$properties[] = $property;
			}
		}		

        $cities = DB::table('cities')->select('*')->get();
        $districts = DB::table('districts')->select('*')->get();

        $data['cities'] = $cities;
		$data['districts'] = $districts;
		
		$property_types = Property_type::all();
		
        $data['properties'] = $properties;
		$data['property_types'] = $property_types;  
		
	    return view('frontend.properties_list', $data);
	}

	public function buy(Request $request)
	{
		$per_page = 15;
		
		$properties_rs = DB::table('properties')
        ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
        ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
        ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
        ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
        ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
        ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
        ->whereRaw('property_purpose = "buy" and is_featured = 1');

		$properties = [];
		if (!empty($properties_rs)) {
			foreach ($properties_rs->simplePaginate($per_page) as $property) {
				$property_images = DB::table('property_images')->select('*')->where('property_id', '=', $property->id)->get();
		
				if (!empty($property_images)) {
					foreach ($property_images as $property_image) {
						$property->images[] = $property_image;
		
						## Setting Cover Image
						if (!empty($property_image->is_featured)) {
							$property->cover_image = $property_image;
						}
					}
				}

				$properties[] = $property;
			}
		}


        $cities = DB::table('cities')->select('*')->get();
        $districts = DB::table('districts')->select('*')->get();

        $data['cities'] = $cities;
		$data['districts'] = $districts;
		
		$property_types = Property_type::all();
		
        $data['properties'] = $properties;
		$data['property_types'] = $property_types;  
		
	    return view('frontend.properties_list', $data);
	}

	public function list(Request $request)
	{
		$get = $request->all();
		$per_page = 9;
		$meta_keywords = '';
		$meta_description = '';

		$properties_rs = DB::table('properties');
		$properties_rs->leftJoin('cities', 'properties.city_id', '=', 'cities.id');
		$properties_rs->leftJoin('districts', 'properties.district_id', '=', 'districts.id');
		$properties_rs->leftJoin('property_types', 'properties.property_type', '=', 'property_types.id');

		$properties_rs->select(
			'properties.*', 
			'cities.city_name', 
			DB::raw('districts.name AS district_name'), 
			DB::raw('property_types.name AS property_type_name') 
		);

		if (!empty($get)) {
			$length = $request->input('length', '');
			$start = $request->input('start', '');
			$search_text = $request->input('search_text');
			$property_purpose = $request->input('property_purpose');
			$city_id = $request->input('city_id');
			
			## Attaching Time in the request
			$request->request->add(['timestamp' => date('Y-m-d H:i:s')]);

			$search_history = \Cookie::get('search_history');
			
			if (!empty($search_history)) {
				$search_history = array_slice(array_prepend(json_decode($search_history, true), $request->all()), 0, 10);
			} else {
				$search_history[] = $request->all();
			}

			\Cookie::queue(\Cookie::make('search_history', json_encode($search_history), 1051200));

			$district_id = $request->input('district_id');
			$property_type = $request->input('property_type');
			$rooms = $request->input('rooms');
			$nearest_land_mark = $request->input('nearest_land_mark');
			$price_from = $request->input('price_from');
			$price_to = $request->input('price_to');
			$status = $request->input('status');

			$car_park = $request->input('car_park');
			$elevator = $request->input('elevator');
			$private_security = $request->input('private_security');
			$garden = $request->input('garden');
			$playground = $request->input('playground');
			$order_by = $request->input('order_by');
			
			if(!empty($property_purpose)) {	
				$properties_rs->where("properties.property_purpose","=",$property_purpose);
			}

			if(!empty($city_id)) {	
				$properties_rs->where("properties.city_id","=",$city_id);
			}
			
			if(!empty($district_id)) {	
				$properties_rs->where("properties.district_id","=",$district_id);
			}

			if(!empty($property_type)) {
				$properties_rs->where("properties.property_type","=",$property_type);	
			}

			if(!empty($rooms)) {	
				$properties_rs->where("properties.rooms","=",$rooms);	
			}

			if(!empty($price_to)) {	
				$properties_rs->whereBetween("properties.rooms",[$price_from, $price_to]);	
			}

			if(!empty($car_park)) {	
				$properties_rs->where("properties.car_park","=",1);	
			}

			if(!empty($elevator)) {	
				$properties_rs->where("properties.elevator","=",1);	
			} 

			if(!empty($private_security)) {	
				$properties_rs->where("properties.private_security","=",1);	
			} 

			if(!empty($garden)) {	
				$properties_rs->where("properties.garden","=",1);	
			} 

			if(!empty($playground)) {	
				$properties_rs->where("properties.playground","=",1);	
			} 

			if(!empty($search_text)) {
				$properties_rs->where(function ($query) use ($search_text) {
					$query->where('properties.title', 'LIKE', "%$search_text%");
					$query->orWhere('properties.title_tr', 'LIKE', "%$search_text%");
					$query->orWhere('properties.title_ar', 'LIKE', "%$search_text%");
					$query->orWhere('properties.title_ru', 'LIKE', "%$search_text%");
					$query->orWhere('properties.title_de', 'LIKE', "%$search_text%");
					$query->orWhere('properties.description', 'LIKE', "%$search_text%");
					$query->orWhere('properties.description_tr', 'LIKE', "%$search_text%");
					$query->orWhere('properties.description_ar', 'LIKE', "%$search_text%");
					$query->orWhere('properties.description_ru', 'LIKE', "%$search_text%");
					$query->orWhere('properties.description_de', 'LIKE', "%$search_text%");
					$query->orWhere('properties.property_no', 'LIKE', "%$search_text%");
				});				
			}			
	
			switch ($order_by) {
				case config('app.cheapest'):
					$properties_rs->orderBy("properties.price",'ASC');	
					break;
				case config('app.highest'):
					$properties_rs->orderBy("properties.price",'DESC');	
					break;
				case config('app.newest'):
					$properties_rs->orderBy("properties.created_at",'DESC');	
					break;
				case config('app.oldest'):
					$properties_rs->orderBy("properties.created_at",'ASC');	
					break;
				default:
					$properties_rs->orderBy("properties.created_at",'DESC');	
					break;
			}	
		} else {
			$properties_rs->orderBy("properties.created_at",'DESC');	
		}

		$properties = [];
		if (!empty($properties_rs)) {
			foreach ($properties_rs->paginate($per_page) as $property) {
				$property_images = DB::table('property_images')->select('*')->where('property_id', '=', $property->id)->get();
		
				if (!empty($property_images)) {
					foreach ($property_images as $property_image) {
						$property->images[] = $property_image;
		
						## Setting Cover Image
						if (!empty($property_image->is_featured)) {
							$property->cover_image = $property_image;
						}
					}
				}

				$properties[] = $property;
			}
		}
		
		$appends = $request->query();

		$nav_links = $properties_rs->paginate($per_page)->appends($appends)->links('vendor.pagination.advance');

		if(!empty($property_purpose)) {	
			$properties_rs->where("properties.property_purpose","=",$property_purpose);

			if ($property_purpose == config('app.rent')) {
				$page = Page::where('slug', 'rent')->first()->toArray();
			} else if ($property_purpose == config('app.buy')) {
				$page = Page::where('slug', 'sale')->first()->toArray();
			}
			if (app()->getLocale() == 'en') { 
				$meta_keywords = $page['meta_keywords'];
				$meta_description = $page['meta_description'];
			} else {
				$local_lang = app()->getLocale();
				$meta_keywords = $page['meta_keywords_'.$local_lang];
				$meta_description = $page['meta_description_'.$local_lang];					
			}
		}
		
        $cities = DB::table('cities')->select('*')->orderBy("cities.city_name",'ASC')->get();
        $districts = DB::table('districts')->select('*')->orderBy("districts.name",'ASC')->get();
		$property_types = Property_type::all();

        $data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['properties'] = $properties;
		$data['nav_links'] = $nav_links;
		$data['property_types'] = $property_types;
		$data['meta_keywords'] = $meta_keywords;
		$data['meta_description'] = $meta_description;

		return view('frontend.properties_list', $data);
	}


	public function update(Request $request) {
		$propertie = null;
		if($request->id > 0) { $propertie = Properties::findOrFail($request->id); }
		else { 
			$propertie = new Propertie;
		}    

	    		
			    $propertie->id = $request->id?:0;
				
					$propertie->brokerID = $request->brokerID?:0;

					    $propertie->title = $request->title;
		
	    		
					    $propertie->description = $request->description;
		
	    		
					    $propertie->price = $request->price;
		
	    		
					    $propertie->acquiretype = $request->acquiretype;
		
	    		
					    $propertie->Location_lng = $request->Location_lng;
		
	    		
					    $propertie->Location_lat = $request->Location_lat;
		
	    		
					    $propertie->status = $request->status;
		
	    		
					    $propertie->created_at = $request->created_at;
		
	    		
					    $propertie->created_by = $request->created_by;
		
	    		
					    $propertie->modified_at = $request->modified_at;
		
	    		
					    $propertie->modified_by = $request->modified_by;
		
	    	    //$propertie->user_id = $request->user()->id;
	    $propertie->save();

	    return redirect('admin/properties');

	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		
		$propertie = Properties::findOrFail($id);

		$propertie->delete();
		return "OK";
	    
	}

	
}