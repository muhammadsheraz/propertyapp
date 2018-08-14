<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Backend\PropertyCreated;
use App\Notifications\Backend\PropertyUpdated;
use App\Notifications\Backend\PropertyDeleted;
use App\Notifications\Backend\PropertyStatusRequest;
use App\Helpers\JQUploadHandler;
use App\Mail\Api\PropertyAlerts\PropertyAlert;

use App\Models\Auth\User;
use App\Models\Properties;
use App\Models\District;
use App\Models\City;
use App\Models\Property_type;
use App\Models\PropertyImages;
use App\Models\UsersPropertiesAlerts;
use App\Models\Property_requests;
use App\Models\Property_requests_buyers;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Amkr\Laravel\Guzzle\Facades\Guzzle;


use DB;

class PropertiesController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{
		$properties_rs = DB::table('properties');
		$properties_rs->leftJoin('cities', 'properties.city_id', '=', 'cities.id');
		$properties_rs->leftJoin('districts', 'properties.district_id', '=', 'districts.id');
		$properties_rs->leftJoin('users', 'properties.broker_id', '=', 'users.id');
		$properties_rs->leftJoin('property_requests', 'properties.property_request_id', '=', 'property_requests.id');

		$properties_rs->select(
			'properties.*',
			'cities.city_name',
			DB::raw('districts.name AS district_name'),
			DB::raw("CONCAT(users.first_name,' ',users.last_name) AS broker_name"),
			DB::raw("property_requests.agreement_file AS agreement_file")
		);

		$search = $request->input('search');
    
		if ($search) {
			$search_text = $request->input('search_text');
			$property_purpose = $request->input('property_purpose');
			$city_id = $request->input('city_id');
			$broker_id = $request->input('broker_id');
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
				});
			}

			if(!empty($property_purpose)) {
				$properties_rs->where("properties.property_purpose","=",$property_purpose);
			}

			if(!empty($city_id)) {
				$properties_rs->where("properties.city_id","=",$city_id);
			}

			if(!empty($broker_id)) {
				$properties_rs->where("properties.broker_id","=",$broker_id);
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

		if(!auth()->user()->hasRole('administrator')){
			$properties_rs->where("properties.broker_id", "=", auth()->user()->id);
		}

		$properties = $properties_rs->get();

		$cities = DB::table('cities')->select('*')->orderBy("cities.city_name",'ASC')->get();
        $districts = DB::table('districts')->select('*')->orderBy("districts.name",'ASC')->get();
		$property_types = Property_type::all();
		
		$request_buyers = [];
		if (!empty($properties->toArray())) {
			foreach ($properties as $prop) {
				$property_requests_buyers = DB::table('property_requests_buyers');
				$property_requests_buyers->leftJoin('users', 'property_requests_buyers.buyer_id', '=', 'users.id');
				$property_requests_buyers->leftJoin('properties', 'property_requests_buyers.property_id', '=', 'properties.id');    
				
				$property_requests_buyers->select(
					'property_requests_buyers.*',
					DB::raw("CONCAT(users.first_name, ' ', users.last_name ) AS customer_full_name"),
					'users.customer_no AS customer_no',
					'properties.property_no AS property_no',
					DB::raw("property_requests_buyers.agreement_file AS agreement_file")
				)
				->where("property_requests_buyers.property_id","=",$prop->id)
				->orderBy("created_at", "DESC");
				
				$req = $property_requests_buyers->get()->toArray();
				
				if (!empty($req)) {
					$request_buyers[$prop->id] = $property_requests_buyers->get()->toArray();
				}
			}
		}

		$data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['property_types'] = $property_types;
		$data['properties'] = $properties;
		$data['request_buyers'] = $request_buyers;

	    return view('backend.properties.index', $data);
	}

	public function create(Request $request)
	{
// 		$pdf = \PDF::loadView('api.seller_agreement')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

// $agreement_file = "seller_contracts/" . str_random(40) . ".pdf";

// \Storage::put($agreement_file, $pdf->output());

		$property_requests = [];

		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {

			## Verifying if he has confirmed/signed the contract
			// Conditional Check disabled on per client's request on 2018-05-09 15:55:59
			// if (!auth()->user()->contract_confirmed) {
			// 	if ($request->ajax()) {
			// 		return response()
			// 		->json([
			// 			'message'=>__('alerts.general.property_error_contract_not_confirmed')
			// 		], 403);
			// 	} else {
			// 		return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
			// 	}
			// }

			## Verifying if he has completed his profile
			if (!$this->isCommissionDefined()) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_commission_not_defined')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_commission_not_defined'));
				}
			}

			## Verifying if he has already reached the limit
			if ($this->hasReachedLimit()) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_limit_reached')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_limit_reached'));
				}
			}

			$property_requests = $this->getPropertyRequests(auth()->user()->id);			
		}

		$brokers = User::role('broker')
				->leftJoin('cities', 'users.city_id', '=', 'cities.id')
				->leftJoin('districts', 'users.district_id', '=', 'districts.id')
				->select(
					'users.*',
					DB::raw('cities.id AS city_id'),
					DB::raw('cities.city_name AS city_name'),
					DB::raw('districts.id AS district_id'),
					DB::raw('districts.name AS district_name')
				)
				->get();

		$district_ids = [];
		if (count($brokers) > 0) {
			foreach ($brokers as $broker) {
				$district_ids[$broker->district_id] = $broker->district_id;
			}
		}

		$districts = DB::table('districts')->select('*')->whereIn('id', $district_ids)->get();

		$cities_ids = [];
		if (count($districts) > 0) {
			foreach ($districts as $district) {
				$cities_ids[$district->city_id] = $district->city_id;
			}
		}

		$cities = DB::table('cities')->select('*')->whereIn('id', $cities_ids)->get();

		$property_types = Property_type::all();

		$data['property_requests'] = $property_requests;
		$data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['brokers'] = $brokers;
		$data['property_types'] = $property_types;
		$data['model'] = new Properties();
		$data['mode'] = 'create';

		if (auth()->user()->hasRole('broker')) {
			$data['logged_in_broker'] = auth()->user();
		}

	    return view('backend.properties.add', $data);
	}

	public function edit(Request $request, $id)
	{
		if (auth()->user()->hasRole('broker')) {
			$data['logged_in_broker'] = auth()->user();
			return redirect('/admin/properties');
		}

		$brokers = User::role('broker')->get();
		$district_ids = [];
		if (count($brokers) > 0) {
			foreach ($brokers as $broker) {
				$district_ids[$broker->district_id] = $broker->district_id;
			}
		}

		$districts = DB::table('districts')->select('*')->whereIn('id', $district_ids)->get();

		$cities_ids = [];
		if (count($districts) > 0) {
			foreach ($districts as $district) {
				$cities_ids[$district->city_id] = $district->city_id;
			}
		}

		$cities = DB::table('cities')->select('*')->whereIn('id', $cities_ids)->get();

		$property_types = Property_type::all();
		$property = Properties::findOrFail($id);
		$property_image_featured = DB::table('property_images')->select('*')
			->whereRaw("(property_id = $id) AND (is_pano != 1 OR is_pano IS NULL) AND is_featured=1")->first();
		$property_image_pano = DB::table('property_images')->select('*')->where(['property_id' => $id, 'is_pano' => '1'])->first();

		$data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['brokers'] = $brokers;
		$data['property_types'] = $property_types;
		$data['model'] = $property;
		$data['property_image_featured'] = $property_image_featured;
		$data['property_image_pano'] = $property_image_pano;
		$data['mode'] = 'edit';

	    return view('backend.properties.add', $data);
	}

	public function show(Request $request, $id)
	{
		$property = Properties::findOrFail($id);

		if (auth()->user()->hasRole('broker') AND $property->broker_id != auth()->user()->id ) {
			$data['logged_in_broker'] = auth()->user();
			return redirect('/admin/properties');
		}

		$users = User::role('broker')->get();
		$cities = DB::table('cities')->select('*')->orderBy("cities.city_name",'ASC')->get();
        $districts = DB::table('districts')->select('*')->orderBy("districts.name",'ASC')->get();
        $property_types = Property_type::all();
		$property_images = DB::table('property_images')->select('*')
		->whereRaw("(property_id = $id) AND (is_pano != 1 OR is_pano IS NULL)")->get();
		$property_images_pano = DB::table('property_images')->select('*')->where(['property_id' => $id, 'is_pano' => '1'])->get();

		$property_requests_buyers = Property_requests_buyers::where([
			'property_id' => $property->id,
			'broker_id' => $property->broker_id
		]);

        $data['property_requests_buyers'] = $property_requests_buyers;
        $data['cities'] = $cities;
		$data['districts'] = $districts;
		$data['brokers'] = $users;
		$data['property_types'] = $property_types;
		$data['model'] = $property;
		$data['property_images'] = $property_images;
		$data['property_images_pano'] = $property_images_pano;

	    return view('backend.properties.show', $data);
	}

	public function grid(Request $request)
	{
            $len = $_GET['length'];
            $start = $_GET['start'];

            $select = "SELECT *,1,2 ";
            $presql = " FROM properties a ";
            if($_GET['search']['value']) {
                    $presql .= " WHERE broker_id LIKE '%".$_GET['search']['value']."%' ";
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
		$new_property = false;
		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {
			## Verifying if he has completed his profile
			if (!$this->isCommissionDefined()) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_commission_not_defined')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_commission_not_defined'));
				}
			}
		}

		if (auth()->user()->hasRole('administrator')) {
			$this->validate($request, [
				'title' => 'required|max:255',
			]);
		}

		$property = null;
		if($request->id > 0) {
			$property = Properties::findOrFail($request->id);
		} else {
			$property = new Properties;
			$new_property = true;
		}

		$property->id = $request->id?:0;
		$property->broker_id = !empty($request->broker_id) ? $request->broker_id : 0;
		$property->street1 = $request->street1;
		$property->street2 = $request->street2;
		$property->state = $request->state;
		$property->phone = $request->phone;
		$property->city_id = $request->city_id;
		$property->district_id = !empty($request->district_id) ? $request->district_id : 0;
		// $property->property_image = $request->property_image;
		$property->payment_duration = $request->payment_duration;
		$property->duration_unit = $request->duration_unit;

		$property->currency = $request->currency;
		$property->price = $request->price;
		$property->property_purpose = $request->property_purpose;
		$property->location_lng = $request->location_lng;
		$property->location_lat = $request->location_lat;
		$property->rooms = $request->rooms;

		$property->car_park = isset($request->car_park) ? $request->car_park : 0;
		$property->elevator = isset($request->elevator) ? $request->elevator : 0;
		$property->private_security = isset($request->private_security) ? $request->private_security : 0;
		$property->garden = isset($request->garden) ? $request->garden : 0;
		$property->playground = isset($request->playground) ? $request->playground : 0;

		$property->property_type = $request->property_type;

		$property->commission_type = $request->commission_type;
		$property->commission_value = $request->commission_value;

		$property->pafta_no = $request->pafta_no;
		$property->ada_no = $request->ada_no;
		$property->parcel_no = $request->parcel_no;

		$property->status = strtolower($request->status);

		# Send Push Notification on Property Activation
		if ($request->status == config('app.active')) {
			// $http = new \GuzzleHttp\Client;
			$url = 'https://fcm.googleapis.com/fcm/send';
			$city_id = $property->city_id;
			$property_purpose = $property->property_purpose;

			$arr = array(
				"to" => "/topics/propertyAdd_" . $property_purpose . "_" . $city_id,
				"notification" => array(
					"body" => "250",
					"content_available" => true,
					"priority" => "high",
					"title" => $property->title,
					"type" => "propertyAdd",
					"sound" => "default",
					"vibrate" => true,
					"propertyId" => $property->id,
				),
				"data" => array(
					"body" => "250",
					"content_available" => true,
					"priority" => "high",
					"title" => $property->title,
					"type" => "propertyAdd",
					"sound" => "default",
					"vibrate" => true,
					"propertyId" => $property->id,
				),
			);

			$http = new \GuzzleHttp\Client;
			$headers = [
				'Authorization' => 	'key=AAAAjdq3fo8:APA91bFiQEhPzTnVNkD91MWJT8RyodYHbZucMtf5NohaFq-RsIhmoHhVRB4ymrJ1-M55LEbwxj1Vk6fQp1LaT_wVmxPkLUhKYd9uMoACvlJE5ZqLVTPwdblIvp-Sk2NYSemuh68XlcBe',
				'content-type' => 'application/json'
			];
			try{
				$res = $http->post($url, [
					'headers' => $headers,
					'json' => $arr,
					]);
					\Log::error('Params : ' . json_encode($arr));
			} catch (\Exception $e){
				\Log::error('Error occurred while sending push notification at property add: ' . $e->getMessage() . ': at Line ' . $e->getLine());
			}

		} else {
			\Log::error('Else Condition PSH NOT');
		}

		if($request->id > 0) {
			#$property->created_at = $request->created_at;
		} else {
			$property->created_at = date('Y-m-d H:i:s');
		}	
		
		##################### Translations Processing #######################
		$text = [
			['Text' => $request->title],
			['Text' => $request->description],
			['Text' => $request->meta_description],
			['Text' => $request->meta_keywords],
		];
		
		$langs = ['en', 'tr', 'ar', 'ru', 'de'];
		
		## Getting Translations from MS Translation API Server
		$i = 0;
		$result = \get_translations($text, $langs);
		
		if (!is_object($result)) {
			foreach ($text as $i=>$txt) {
				$translations = [];
				foreach ($result[$i]['translations'] as $translations_arr) {
					$translations[$translations_arr['to']] = $translations_arr['text'];
				}

				switch ($i) {
					case 0:
						$property->title = $translations['en'];
						$property->title_tr = $translations['tr'];
						$property->title_ar = $translations['ar'];
						$property->title_ru = $translations['ru'];
						$property->title_de = $translations['de'];

						break;
					case 1:						
						$property->description = $translations['en'];
						$property->description_tr = $translations['tr'];
						$property->description_ar = $translations['ar'];
						$property->description_ru = $translations['ru'];
						$property->description_de = $translations['de'];
						
						break;				
					case 2:
						$property->meta_description = $translations['en'];
						$property->meta_description_tr = $translations['tr'];
						$property->meta_description_ar = $translations['ar'];
						$property->meta_description_ru = $translations['ru'];
						$property->meta_description_de = $translations['de'];
						break;				
					case 3:
						$property->meta_keywords = $translations['en'];
						$property->meta_keywords_tr = $translations['tr'];
						$property->meta_keywords_ar = $translations['ar'];
						$property->meta_keywords_ru = $translations['ru'];
						$property->meta_keywords_de = $translations['de'];	
						break;				
					default:
						# code...
						break;
				}
			}	
		} else {
			$property->title = $request->title;
			$property->title_tr = $request->title_tr;
			$property->title_ar = $request->title_ar;
			$property->title_ru = $request->title_ru;
			$property->title_de = $request->title_de;

			$property->description = $request->description;
			$property->description_tr = $request->description_tr;
			$property->description_ar = $request->description_ar;
			$property->description_ru = $request->description_ru;
			$property->description_de = $request->description_de;

			$property->meta_keywords = $request->meta_keywords;
			$property->meta_keywords_tr = $request->meta_keywords_tr;
			$property->meta_keywords_ar = $request->meta_keywords_ar;
			$property->meta_keywords_ru = $request->meta_keywords_ru;
			$property->meta_keywords_de = $request->meta_keywords_de;

			$property->meta_description = $request->meta_description;
			$property->meta_description_tr = $request->meta_description_tr;
			$property->meta_description_ar = $request->meta_description_ar;
			$property->meta_description_ru = $request->meta_description_ru;
			$property->meta_description_de = $request->meta_description_de;
		}
		##########################################################################		

		$property->property_request_id = $request->property_request_id;
		$property->created_by = $request->created_by;
		$property->modified_at = date('Y-m-d H:i:s');
		$property->modified_by = $request->modified_by;

		$property_saved = $property->save();

		## Only perform this while activating the property, which performs on update request
		if (!empty($request->property_request_id) AND empty($request->id)) {
			## Generating Contract Agreement
			$property_request = Property_requests::find($request->property_request_id);

			if (!empty($property_request->id)) {
				$broker = auth()->user();
				$broker_data = $broker->toArray();
				$broker_data['city_name'] = City::find($broker->city_id)->city_name;
				$broker_data['district_name'] = District::find($broker->district_id)->name;
				$params['broker'] = (object) $broker_data;
				
				$customer = User::find($property_request->customer_id);
				$customer_data = $customer->toArray();

				if (!empty($customer->city_id)) {
					$customer_data['city_name'] = City::find($customer->city_id)->city_name;
				} else {
					$customer_data['city_name'] = '';
				}

				if (!empty($customer->district_id)) {
					$customer_data['district_name'] = District::find($customer->district_id)->name;
				} else {
					$customer_data['district_name'] = '';
				}

				$params['seller'] = (object) $customer_data;

				$property_data = $property->toArray();

				$property_data['city_name'] = City::find($property->city_id)->city_name;
				$property_data['district_name'] = District::find($property->district_id)->name;
				$params['property'] = (object) $property_data;
				$params['commission_rent_text'] = __('strings.backend.one_month_rent');

				$pdf = \PDF::loadView('api.seller_agreement', $params)
				->setOptions([
					'defaultFont' => 'DejaVu Sans',
					'isRemoteEnabled' => true,
					'isHtml5ParserEnabled' => true,
					])->setPaper('A4', 'landscape');
				$agreement_file = "seller_contracts/" . str_random(40).".pdf";

				\Storage::put($agreement_file, $pdf->output());			

				$property_request->agreement_file = $agreement_file;
				$property_request->property_created = config('app.yes');
				$property_request->updated_at = date('Y-m-d H:is');
				$property_request->updated_by = auth()->user()->id;
				$property_request->status = config('app.closed');
				$property_request->save();

				## Dropping message for the Property Request chat thread  
				try {
					$thread_subject = "thread" . "-" . $property_request->pr_no . "-" . $broker->id . "-" . $property_request->customer_id;
					$customer_id = $property_request->customer_id;
					$broker_id = auth()->user()->id;
					$message =  __('alerts.general.property_created_against_property_request', [
						'property_label' => $property->property_no,
						'property_request_label' => $property_request->pr_no,
						]);
						$recipients = $customer_id;	
						
					$thread = Thread::firstOrCreate(['subject' => $thread_subject]);

					// Message
					Message::create([
						'thread_id' => $thread->id,
						'user_id' => $broker_id,
						'body' => $message,
					]);	
					
					// Sender
					$participant = Participant::firstOrCreate([
						'thread_id' => $thread->id,
						'user_id' => $broker_id,
					]);

					$participant->last_read = new Carbon;
					$participant->save();

					// Add replier as a participant
					$participant = Participant::firstOrCreate([
						'thread_id' => $thread->id,
						'user_id' => $customer_id,
					]);
					
					$participant->save();

					$thread->status = config('app.closed');
					$thread->save();
				} catch (\Exception $e) {
					\Log::error('Error occurred while adding message for property request: ' . $e->getMessage() . ': at Line ' . $e->getLine());
				}		
			}
		}

		## Sending Email Alerts to Customers
		## Implementation Paused at 2018-06-08 22:33:24
		if ($property_saved AND $new_property) {
			$alerts = UsersPropertiesAlerts::where('city_id', $property->city_id);
			$alerts->where('purpose', $property->purpose);	
				
			if ($alerts->count()) {
				foreach ($alerts->get() as $alert) {
					$customer = User::find($alert->customer_id);
					$city = City::find($alert->city_id);

					if ($customer) {
						## Alert Process will be handled by push notifications
						## Mail::send(new PropertyAlert($request, $property, $customer));
					}
				}
			}
		}

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();

		if (!empty($property->broker_id))
			$broker = User::find($property->broker_id);


		## Preparing Notification
		if($request->id > 0) {
			if ($request->mode == config('app.create')) {
				$response_message = __('alerts.general.property_created');
				
				## Generating and Saving Property No
				$property_no = 'P' . str_pad($property->id,config('app.property_no_padding_size'),"0",STR_PAD_LEFT);
				$property->property_no = $property_no;
				$property->save();

				## Property Created
				\Notification::send($administrator, new PropertyCreated($done_by, $property));

				if (!empty($broker))
					\Notification::send($broker, new PropertyCreated($done_by, $property));
			} else if ($request->mode == config('app.edit')) {
				$response_message = __('alerts.general.property_updated');
				if (!empty($request->input('step')) AND $request->input('step') > 0) {
					## Property Updated
					\Notification::send($administrator, new PropertyUpdated($done_by, $property));
	
					if (!empty($broker))
						\Notification::send($broker, new PropertyUpdated($done_by, $property));
				}
			}
		} else {
			$response_message = __('alerts.general.property_drafted');
		}

		if ($request->ajax()) {
			return response()
			->json([
				'property_id'=>$property->id,
				'message'=>$response_message
				])
			->header('Content-Type', 'text');
		} else {
			return redirect('/admin/properties')
			->withFlashSuccess($response_message);
		}
	}

	public function store(Request $request)
	{
		## If user is broker then verify if he has confirmed/signed the contract
		// if (auth()->user()->hasRole('broker')) {
		// 	if (!auth()->user()->contract_confirmed) {
		// 		if ($request->ajax()) {
		// 			return response()
		// 			->json([
		// 				'message'=>__('alerts.general.property_error_contract_not_confirmed')
		// 			], 403);
		// 		} else {
		// 			return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
		// 		}
		// 	}
		// }
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {

		if (auth()->user()->hasRole('broker') AND $property->broker_id != auth()->user()->id ) {
			$data['logged_in_broker'] = auth()->user();
			return redirect('/admin/properties');
		}

		$property = Properties::findOrFail($id);

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();

		if (!empty($property->broker_id))
			$broker = User::find($property->broker_id);

		if($request->id > 0) {
			## Property Updated
			\Notification::send($administrator, new PropertyDeleted($done_by, $property));

			if (!empty($broker))
				\Notification::send($broker, new PropertyDeleted($done_by, $property));
		}

		$property->delete();

		return redirect('admin/properties')->withFlashSuccess(__('alerts.general.property_deleted'));
	}

	public function delete(Request $request, $id) {

		if (auth()->user()->hasRole('broker') AND $property->broker_id != auth()->user()->id ) {
			$data['logged_in_broker'] = auth()->user();
			return redirect('/admin/properties');
		}

		$property = Properties::findOrFail($id);

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();

		if (!empty($property->broker_id))
			$broker = User::find($property->broker_id);

		if($request->id > 0) {
			## Property Updated
			\Notification::send($administrator, new PropertyDeleted($done_by, $property));

			if (!empty($broker))
				\Notification::send($broker, new PropertyDeleted($done_by, $property));
		}

		$property->delete();

		return redirect('admin/properties')->withFlashSuccess("Selected Property deleted successfully");
	}

	public function sold(Request $request, $id) {
		$property = Properties::findOrFail($id);
		$property->status = config('app.sold');
		$property->save();

		return redirect('admin/properties')->withFlashSuccess(__('alerts.general.property_updated'));
	}

	public function rented(Request $request, $id) {
		$property = Properties::findOrFail($id);
		$property->status = config('app.rented');
		$property->save();

		return redirect('admin/properties')->withFlashSuccess(__('alerts.general.property_updated'));
	}

	public function request_sold(Request $request, $id) {
		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {
			## Verifying if he has completed his profile
			if (!$this->isCommissionDefined()) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_commission_not_defined')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_commission_not_defined'));
				}
			}
		}

		$property = Properties::findOrFail($id);
		$property->status = config('app.request_sold');
		$property->save();

		## Notification for Administrator
		$administrator = User::role('administrator')->get();
		\Notification::send($administrator, new PropertyStatusRequest(auth()->user(), $property));

		## Notification for Broker
		$broker = User::find($property->broker_id);
		\Notification::send($broker, new PropertyStatusRequest(auth()->user(), $property));

		return redirect('admin/properties')->withFlashSuccess(__('strings.frontend.property_status_request_sent'));
	}

	public function request_rented(Request $request, $id) {
		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {
			## Verifying if he has completed his profile
			if (!$this->isCommissionDefined()) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_commission_not_defined')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_commission_not_defined'));
				}
			}
		}
				
		$property = Properties::findOrFail($id);
		$property->status = config('app.request_rented');
		$property->save();

		## Notification for Administrator
		$administrator = User::role('administrator')->get();
		\Notification::send($administrator, new PropertyStatusRequest(auth()->user(), $property));

		## Notification for Broker
		$broker = User::find($property->broker_id);
		\Notification::send($broker, new PropertyStatusRequest(auth()->user(), $property));		

		return redirect('admin/properties')->withFlashSuccess(__('strings.frontend.status_update_request_sent'));
	}

	public function remove_image(Request $request) {
		$image_id = $request->input('image_id');
		$image_obj = DB::table('property_images')->where('id', $image_id);
		$image_obj->sharedLock();
		$image = $image_obj->first();
		Storage::disk('public')->delete($image->image_path);

		$removed = $image_obj->delete();
		$response = [
				'status' => 'success',
				'message' => 'Selected image has been removed',
		];

		echo json_encode($response);
	}

	public function set_featured_image(Request $request) {
		$image_name = $request->input('_image_name');
		$property_id = $request->input('_property_id');
		$image_url = "properties/$property_id/$image_name";

		$image_obj = DB::table('property_images');
		
		## Unsetting previous featured image
		$image_obj->where('property_id', $property_id)->update(['is_featured'=>false]);

		## Updating new panoramic image
		$image_obj->where('image_url', $image_url);						
		if ($image_obj->update(['is_featured'=>true])) {
			return response()
			->json([
					'property_id'=>$property_id,
					'message'=>"Selected image has been set as featured.",
				])
			->header('Content-Type', 'text');
		} else {
			return response()
			->json([
					'property_id'=>$property_id,
					'message'=>"Image not found.",
				])
			->header('Content-Type', 'text');
		}
	}

	public function set_panoramic_image(Request $request) {
		$image_name = $request->input('_image_name');
		$property_id = $request->input('_property_id');
		$image_url = "properties/$property_id/$image_name";

		$image_obj = DB::table('property_images');
		
		## Unsetting previous panoramic image
		$image_obj->where('property_id', $property_id)->update(['is_pano'=>false]);

		## Updating new panoramic image
		$image_obj->where('image_url', $image_url);
		if ($image_obj->update(['is_pano'=>true])) {
			return response()
			->json([
					'property_id'=>$property_id,
					'message'=>"Selected image has been set for panoramic view.",
				])
			->header('Content-Type', 'text');
		} else {
			return response()
			->json([
					'property_id'=>$property_id,
					'message'=>"Image not found.",
				])
			->header('Content-Type', 'text');
		}
	}

	public function get_districts(Request $request) {
		$city_id = $request->input('_city_id');
		$districts = DB::table('districts')->select('*')
		->where('city_id','=',$city_id)
		->get();

		return response()
		->json([
				'districts'=>$districts->toArray(),
				'message'=>"success.",
			]);		
	}	

	public function get_brokers(Request $request) {
		$district_id = $request->input('_district_id');
		$brokers = DB::table('users')->select('*')
			->where('district_id','=',$district_id)
			->get();

		return response()
		->json([
				'brokers'=>$brokers->toArray(),
				'message'=>"success.",
			]);		
	}	

	public function view_agreement(Request $request, $id) {
		$district_id = $request->input('_district_id');
		$brokers = DB::table('users')->select('*')
			->where('district_id','=',$district_id)
			->get();

		return response()
		->json([
				'brokers'=>$brokers->toArray(),
				'message'=>"success.",
			]);		
	}	

	private function isCommissionDefined () {
		$broker = auth()->user();

		return (!empty($broker->commission_sale_landlord) 
			AND !empty($broker->commission_sale_buyer) 
			AND !empty($broker->commission_rent_landlord)
			AND !empty($broker->commission_rent_tenant));
	}

	private function hasReachedLimit () {
		$broker = auth()->user();
		$properties = DB::table('properties')->select('*')->where('broker_id', $broker->id)->get()->toArray();

		return (count($properties) >= $broker->property_limit);
	}

	private function getPropertyRequests($broker_id = '') {
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

		if(!empty($broker_id)) {
			$property_requests->where('broker_id', $broker_id);
		}

		// $property_requests->where('property_created', '=', NULL);


		$property_requests->where(function ($query) {
			$query->where('status', '=', config('app.active'));
			$query->where('property_created', '=', NULL)
					->orWhere('property_created', '=', 'no');
		});

		return $property_requests->get();			
	}


}
