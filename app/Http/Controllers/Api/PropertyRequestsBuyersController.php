<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use Illuminate\Http\UploadedFile;
use App\Models\Property_requests_buyers;
use App\Models\Properties;
use App\Models\City;
use App\Models\District;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Backend\PropertyCreated;
use App\Notifications\Backend\PropertyUpdated;
use App\Notifications\Backend\PropertyDeleted;
use App\Notifications\Backend\PropertyStatusRequest;

use DB;

class PropertyRequestsBuyersController extends ApiController
{

    public function index(Request $request)
	{
		$data = [];

		$customer = auth()->user();

		// $property_requests = new Property_requests();
		
		// $property_requests->where('customer_id', $customer->id);


		$property_requests = DB::table('property_requests_buyers');
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
				$property_request = Property_requests_buyers::findOrFail($request->id);
			} else {
				$property_request = new Property_requests_buyers;
			}

			$broker = User::find($request->broker_id);

			if (!$broker) {
				$data = [
					'status' => 'fail',
					'message' =>  'broker not found',
				];

				return response()->json([
					'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}

			$property = Properties::find($request->property_id);

			if (!$property) {
				$data = [
					'status' => 'fail',
					'message' =>  'property not found',
				];

				return response()->json([
					'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}

			if ($property->broker_id != $broker->id) {
				$data = [
					'status' => 'fail',
					'message' =>  'provided broker id doesnt match with the property associated broker id',
				];

				return response()->json([
					'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}
			
			$buyer = User::find(auth()->user()->id);		
			
			if (!$buyer) {
				$data = [
					'status' => 'fail',
					'message' =>  'buyer account for the provided access token not found',
				];

				return response()->json([
					'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}			

			$property_request->id = $request->id?:0;
			$property_request->property_id = !empty($request->property_id) ? $request->property_id : 0;
			$property_request->broker_id = !empty($request->broker_id) ? $request->broker_id : 0;
			$property_request->buyer_id = $buyer->id;
			$property_request->price = $request->price;
			
			if (!empty($request->status)) {
				$property_request->status = strtolower($request->status);
			}

			$property_request->is_agreed = config('app.yes');

			if(empty($request->id)) {
				$property_request->created_at = date('Y-m-d H:i:s');
				$property_request->created_by = $buyer->id;
			}

			$property_request->save();

			## Adding Property Requests No
			$property_request_no = 'PRB' . str_pad($property_request->id,config('app.property_no_padding_size'),"0",STR_PAD_LEFT);
			$property_request->prb_no = $property_request_no;
			$property_request->save();			

			$property_request_data = $property_request->toArray();

			$data['property_request'] = $property_request_data;

			## Generating Contract Agreement For Buyer
			if (!empty($property_request->id) AND $property_request->is_agreed == config('app.yes')) {
				$broker_data = $broker->toArray();
				$broker_data['city_name'] = City::find($broker->city_id)->city_name;
				$broker_data['district_name'] = District::find($broker->district_id)->name;
				$params['broker'] = (object) $broker_data;
				
				$buyer_data = $buyer->toArray();
				
				if (!empty($buyer->city_id)) {
					$buyer_data['city_name'] = City::find($buyer->city_id)->city_name;
				} else {
					$buyer_data['city_name'] = '';
				}

				if (!empty($buyer->district_id)) {
					$buyer_data['district_name'] = District::find($buyer->district_id)->name;
				} else {
					$buyer_data['district_name'] = '';
				}

				$params['buyer'] = (object) $buyer_data;

				$property_data = $property->toArray();
				$property_data['city_name'] = City::find($property->city_id)->city_name;
				$property_data['district_name'] = District::find($property->district_id)->name;
				$params['property'] = (object) $property_data;
				$params['commission_rent_text'] = __('strings.backend.one_month_rent');

				// $pdf = \PDF::loadView('api.buyer_agreement', $params);
				$pdf = \PDF::loadView('api.buyer_agreement', $params)
					->setOptions([
						'defaultFont' => 'DejaVu Sans',
						'isRemoteEnabled' => true,
						'isHtml5ParserEnabled' => true,
					])->setPaper('A4', 'landscape');
				
				$agreement_file = "buyer_contracts/" . str_random(40).".pdf";

				\Storage::put($agreement_file, $pdf->output());			

				$property_request->agreement_file = $agreement_file;
				$property_request->updated_at = date('Y-m-d H:is');
				$property_request->updated_by = auth()->user()->id;
				$property_request->save();
			}		

			$data['status'] = 'success';
			$data['message'] = 'request submitted';

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
			'property_id' => 'required',
			'broker_id' => 'required',
		];
				
		$messages = [];

        \Validator::make($request->all(), $rule, $messages)->validate();

		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		$property_request = Property_requests_buyers::findOrFail($id);

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

	public function buyer(Request $request) {

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
