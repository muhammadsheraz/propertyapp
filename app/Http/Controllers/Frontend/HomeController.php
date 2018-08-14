<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Properties;
use App\Models\Property_type;
use App\Models\Page;

use DB;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {   

        ##########################
        #$this->createJSON('strings');
        ##########################

        $search_history = $this->getSearchHistory();

        $properties_recommended = [];
        if (!empty($search_history[0]['city_id'])) {
            $properties = DB::table('properties')
                ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
                ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
                ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
                ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
                ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
                ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
                ->whereRaw('properties.status = "' . config('app.active') . '" AND property_images.is_featured = 1');

                $properties->where('properties.city_id', $search_history[0]['city_id']);

                $properties->limit(6);

                $properties_recommended = $properties->get()->toArray();
        }

        // Properties Buy
        $properties_buy = DB::table('properties')
            ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
            ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
            ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
            ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
            ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
            ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
            ->whereRaw('properties.property_purpose = "buy"')
            ->whereRaw('properties.status = "' . config('app.active') . '" AND property_images.is_featured = 1')
            ->orderBy("properties.created_at",'DESC')
            ->limit(6)
            ->get();

        // Properties Rent        
        $properties_rent = DB::table('properties')
            ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
            ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
            ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
            ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
            ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
            ->select('properties.*', 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
            ->whereRaw('property_purpose = "rent"')
            ->whereRaw('properties.status = "' . config('app.active') . '" AND property_images.is_featured = 1')
            ->orderBy("properties.created_at",'DESC')
            ->limit(6)
            ->get();

        ## Fetching Properties for map
        $properties = DB::table('properties')
            ->leftJoin('cities', 'properties.city_id', '=', 'cities.id')
            ->leftJoin('districts', 'properties.district_id', '=', 'districts.id')
            ->leftJoin('users', 'properties.broker_id', '=', 'users.id')
            ->leftJoin('property_images' , 'properties.id','=', 'property_images.property_id')
            ->leftJoin('property_types' , 'property_types.id','=', 'properties.property_type')
            ->select('properties.*', DB::raw('count(properties.id) as properties_count'), 'cities.city_name', 'districts.name AS district_name', 'users.first_name as broker_name', 'property_images.image_url as property_image', 'property_types.name as property_type_name')
            ->whereRaw('properties.status = "' . config('app.active') . '" AND property_images.is_featured = 1')
            ->groupBy('properties.city_id')
            ->get();

        $properties_for_map = [];
        if (!empty($properties->count())) {
            foreach ($properties as $property) {
                $properties_for_map[$property->city_name . "|" . $property->city_id] = $property->properties_count;
            }
        }

        $cities = DB::table('cities')->select('*')->orderBy("cities.city_name",'ASC')->get();
        $districts = DB::table('districts')->select('*')->orderBy("districts.name",'ASC')->get();
        $property_types = Property_type::all();

        $data['cities'] = $cities;
        $data['districts'] = $districts;
        $data['properties_buy'] = $properties_buy;
        $data['properties_rent'] = $properties_rent;
        $data['property_types'] = $property_types;       
        $data['properties_for_map'] = $properties_for_map;  
        $data['properties_recommended'] = $properties_recommended;  
         
        $data['page'] = Page::where('slug', 'home')->first()->toArray();

        return view('frontend.home', $data);
    }

    public function getSearchHistory() {
        return json_decode(\Cookie::get('search_history'), true);
    }

    private function flattenArray($arrayToFlatten) {
        $flatArray = array();
        foreach($arrayToFlatten as $k=>$element) {
            if (is_array($element)) {
                $flatArray = array_merge($flatArray, $this->flattenArray($element));
            } else {
                $flatArray[$k] = trim($element);
            }
        }
        return $flatArray;
    }   

    private function createJSON($fileName) {
        $tr_arr = $this->flattenArray(__($fileName));
        
        $str = json_encode($tr_arr, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        \Storage::put("$fileName.json", $str);

        die();
    }    
}
