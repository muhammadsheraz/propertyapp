<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use Illuminate\Http\UploadedFile;
use App\Models\Properties;
use App\Models\Property_type;
use App\Models\PropertyImages;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Backend\PropertyCreated;
use App\Notifications\Backend\PropertyUpdated;
use App\Notifications\Backend\PropertyDeleted;
use App\Notifications\Backend\PropertyStatusRequest;
use App\Helpers\JQUploadHandler;
use Illuminate\Support\Facades\Response;

use DB;

class PropertiesController extends ApiController
{

    public function index(Request $request)
	{
		$properties_rs = DB::table('properties');
		$properties_rs->leftJoin('cities', 'properties.city_id', '=', 'cities.id');
		$properties_rs->leftJoin('districts', 'properties.district_id', '=', 'districts.id');
		$properties_rs->leftJoin('users', 'properties.broker_id', '=', 'users.id');

		$properties_rs->select(
			'properties.*',
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

		$per_page = $request->input('per_page', 9);

		$search_text = $request->input('search_text');
		$property_no = $request->input('property_id');
		$property_purpose = $request->input('property_purpose');
		$city_id = $request->input('city_id');
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

				$query->orWhere('properties.property_no', 'LIKE', "%$search_text%");
			});
		}

		if(!empty($property_purpose)) {
			$properties_rs->where("properties.property_purpose","=",$property_purpose);
		}

		if(!empty($property_no)) {
			$properties_rs->where("properties.property_no","=",$property_no);
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
			$properties_rs->whereBetween("properties.price",[$price_from, $price_to]);
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


		// $properties_rs->where("properties.broker_id", "=", auth()->user()->id);
		$properties_results = $properties_rs->paginate($per_page);

		foreach ($properties_results as $key=>$properties_result) {
			$properties_results[$key]->description_text = strip_tags($properties_result->description);

			$property_images = DB::table('property_images')
			->select('id','image_url', 'image_type', 'is_featured', 'is_pano')
			->where('property_id', '=', $properties_result->id)
			->get();

			foreach ($property_images->toArray() as $k=>$property_image) {
				$property_images[$k]->abs_path = \Storage::url($property_image->image_url);

				if (!empty($property_images[$k]->is_featured)) {
					$properties_results[$key]->property_image = \Storage::url($property_image->image_url);
				}
			}

			$properties_results[$key]->images = $property_images->toArray(); 
		}

		$properties_count = count($properties_results);

    	return response()->json([
			'data' => [
				'status'=>'success',
				'properties'=>$properties_results,
				'records_count'=>$properties_count,
			]
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

	}

	public function show(Request $request, $id)
	{		
		$properties = DB::table('properties');
		$properties->leftJoin('cities', 'properties.city_id', '=', 'cities.id');
		$properties->leftJoin('districts', 'properties.district_id', '=', 'districts.id');
		$properties->leftJoin('users', 'properties.broker_id', '=', 'users.id');

		$properties->select(
			'properties.*',
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

		$properties->where("properties.id","=",$id);
		$property = (array) $properties->first();

		if (!empty($property)) {
			$property['description_text'] = strip_tags($property['description']);
			$property_images = DB::table('property_images')
				->select('id','image_url', 'image_type', 'is_featured', 'is_pano')
				->where('property_id', '=', $id)
				->get();

			foreach ($property_images->toArray() as $k=>$property_image) {
				$property_images[$k]->abs_path = \Storage::url($property_image->image_url);
			}

			$property['images'] = $property_images->toArray();

			return response()->json([
				'data' => $property,
				'status' => 'success',
				'message' => 'property found',
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);			
		} else {
			return response()->json([
				'data' => [],
				'status' => 'fail',
				'message' => 'property not found',
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}	
	}

	public function update(Request $request) {
		return response()->json([
			'data' => 'success PATCH'
		]);

		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {

			## Verifying if he has confirmed/signed the contract
			if (!auth()->user()->contract_confirmed) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_contract_not_confirmed')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
				}
			}

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

	    $this->validate($request, [
	        'title' => 'required|max:255',
		]);

		$property = null;
		if($request->id > 0) {
			$property = Properties::findOrFail($request->id);
		} else {
			$property = new Properties;
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
		$property->title = $request->title;
		$property->description = $request->description;
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

		$property->ada_no = $request->ada_no;
		$property->parcel_no = $request->parcel_no;

		$property->status = strtolower($request->status);

		if($request->id > 0) {
			#$property->created_at = $request->created_at;
		} else {
			$property->created_at = date('Y-m-d H:i:s');
		}

		$property->meta_description = $request->meta_description;
		$property->meta_keywords = $request->meta_keywords;

		$property->title_tr = array_get($request, 'title_tr', $request->title);
		$property->description_tr = array_get($request, 'description_tr', $request->description);
		$property->meta_description_tr = array_get($request, 'meta_description_tr', $request->meta_description);
		$property->meta_keywords_tr = array_get($request, 'meta_keywords_tr', $request->meta_keywords);

		$property->title_ar = array_get($request, 'title_ar', $request->title);
		$property->description_ar = array_get($request, 'description_ar', $request->description);
		$property->meta_description_ar = array_get($request, 'meta_description_ar', $request->meta_description);
		$property->meta_keywords_ar = array_get($request, 'meta_keywords_ar', $request->meta_keywords);

		$property->title_ru = array_get($request, 'title_ru', $request->title);
		$property->description_ru = array_get($request, 'description_ru', $request->description);
		$property->meta_description_ru = array_get($request, 'meta_description_ru', $request->meta_description);
		$property->meta_keywords_ru = array_get($request, 'meta_keywords_ru', $request->meta_keywords);		

		$property->title_de = array_get($request, 'title_de', $request->title);
		$property->description_de = array_get($request, 'description_de', $request->description);
		$property->meta_description_de = array_get($request, 'meta_description_de', $request->meta_description);
		$property->meta_keywords_de = array_get($request, 'meta_keywords_de', $request->meta_keywords);		

		$property->created_by = $request->created_by;
		$property->modified_at = date('Y-m-d H:i:s');
		$property->modified_by = $request->modified_by;

		$property->save();

		$administrator = User::role('administrator')->get();
		$done_by = auth()->user();

		if (!empty($property->broker_id))
			$broker = User::find($property->broker_id);


		## Preparing Notification
		if($request->id > 0) {
			## Property Updated
			\Notification::send($administrator, new PropertyUpdated($done_by, $property));

			if (!empty($broker))
				\Notification::send($broker, new PropertyUpdated($done_by, $property));
		} else {
			## Generating and Saving Property No
			$property_no = 'P' . str_pad($property->id,config('app.property_no_padding_size'),"0",STR_PAD_LEFT);
			$property->property_no = $property_no;
			$property->save();

			## Property Created
			\Notification::send($administrator, new PropertyCreated($done_by, $property));

			if (!empty($broker))
				\Notification::send($broker, new PropertyCreated($done_by, $property));
		}

		if ($request->ajax()) {
			return response()
			->json([
				'property_id'=>$property->id
				])
			->header('Content-Type', 'text');
		} else {
			return redirect('/admin/properties')
			->withFlashSuccess(__('alerts.general.property_updated'));
		}
	}

	public function store(Request $request)
	{
		return response()->json([
			'data' => 'success post'
		]);

		## If user is broker then verify if he has confirmed/signed the contract
		if (auth()->user()->hasRole('broker')) {
			if (!auth()->user()->contract_confirmed) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_contract_not_confirmed')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
				}
			}
		}

		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		return response()->json([
			'data' => 'success DELETE'
		]);

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

		return redirect('admin/properties')->withFlashSuccess("Selected Property status updated successfully");
	}

	public function rented(Request $request, $id) {
		$property = Properties::findOrFail($id);
		$property->status = config('app.rented');
		$property->save();

		return redirect('admin/properties')->withFlashSuccess("Selected Property status updated successfully");
	}

	public function request_sold(Request $request, $id) {
		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {

			## Verifying if he has confirmed/signed the contract
			if (!auth()->user()->contract_confirmed) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_contract_not_confirmed')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
				}
			}

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
		\Notification::send($broker, new PropertyDeleted(auth()->user(), $property));

		return redirect('admin/properties')->withFlashSuccess("A status update request has been sent to Administrator for approval.");
	}

	public function request_rented(Request $request, $id) {
		## Verifying if user is broker
		if (auth()->user()->hasRole('broker')) {

			## Verifying if he has confirmed/signed the contract
			if (!auth()->user()->contract_confirmed) {
				if ($request->ajax()) {
					return response()
					->json([
						'message'=>__('alerts.general.property_error_contract_not_confirmed')
					], 403);
				} else {
					return redirect('admin/properties')->withFlashDanger(__('alerts.general.property_error_contract_not_confirmed'));
				}
			}

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
		\Notification::send($broker, new PropertyDeleted(auth()->user(), $property));		

		return redirect('admin/properties')->withFlashSuccess("A status update request has been sent to Administrator for approval.");
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

	protected function isCommissionDefined () {
		$broker = auth()->user();

		return (!empty($broker->commission_sale_landlord) 
			AND !empty($broker->commission_sale_buyer) 
			AND !empty($broker->commission_rent_landlord)
			AND !empty($broker->commission_rent_tenant));
	}


}
