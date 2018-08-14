<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\UsersPropertiesAlerts;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

use DB;

class AlertsController extends ApiController
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request) {
		$messages = [];
		$per_page = $request->input('per_page', 500);
		$customer_id = auth()->user()->id;

		// $alerts = UsersPropertiesAlerts::where('customer_id', $customer_id);

		$alerts = DB::table('users_properties_alerts');
		$alerts->leftJoin('cities', 'users_properties_alerts.city_id', '=', 'cities.id');

		$alerts->select(
			'users_properties_alerts.*',
			'cities.city_name'
		);

		$alerts->where('customer_id', $customer_id);

		$alerts->orderBy('created_at', 'DESC');

		$data['alerts'] = $alerts->paginate($per_page);
		$data['status'] = 'success';

		return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function store(Request $request) {
		$request->validate([
			'city_id' => 'required',
		]);

		try {
			$customer_id = auth()->user()->id;

			$customer = User::find($customer_id);

			if ($customer) {
				$alerts = new UsersPropertiesAlerts();
				$alerts->customer_id = $customer_id;
				$alerts->purpose = $request->input('purpose');
				$alerts->city_id = $request->input('city_id');	
				$alerts->created_at = date('Y-m-d H:i:s');	

				$alerts->save();

				$alerts = DB::table('users_properties_alerts');
				$alerts->leftJoin('cities', 'users_properties_alerts.city_id', '=', 'cities.id');

				$alerts->select(
					'users_properties_alerts.*',
					'cities.city_name'
				);

				$alerts->where('customer_id', $customer_id);
				$alerts->orderBy('created_at', 'DESC');					

				$data['alerts']['data'] = $alerts->get();
				$data['messages'] = 'new property alert saved';
				$data['status'] = 'success';

				return response()->json([
					'data' => $data
					], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			} else {
				$data['messages'] = 'customer not found, either deleted or deactivated';
				$data['status'] = 'error';

				return response()->json([
					'data' => $data
					], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}
		} catch (\Exception $e) {
			$data['messages'] = 'Error occurred while adding property alert: ' . $e->getMmessage();
			$data['status'] = 'error';

			return response()->json([
				'data' => $data
				], $e->getCode(), [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}

	public function destroy(Request $request, $id) {
		try {
			$customer_id = auth()->user()->id;

			$customer = User::find($customer_id);

			if ($customer) {
				$alert = UsersPropertiesAlerts::find($id);
				if ($alert) {
					$alert->delete();

					$alerts = DB::table('users_properties_alerts');
					$alerts->leftJoin('cities', 'users_properties_alerts.city_id', '=', 'cities.id');

					$alerts->select(
						'users_properties_alerts.*',
						'cities.city_name'
					);

					$alerts->where('customer_id', $customer_id);
					$alerts->orderBy('created_at', 'DESC');					
	
					$data['messages'] = 'alert deleted successfully';
					$data['alerts']['data'] = $alerts->get();
					$data['status'] = 'success';
				} else {
					$data['messages'] = 'alert not found with the given id: ' . $id;
					$data['status'] = 'info';
				}

				return response()->json([
					'data' => $data
					], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			} else {
				$data['messages'] = 'customer not found, either deleted or deactivated';
				$data['status'] = 'error';

				return response()->json([
					'data' => $data
					], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}
		} catch (\Exception $e) {
			$data['messages'] = 'Error occurred while adding property alert: ' . $e->getMessage();
			$data['status'] = 'error';

			return response()->json([
				'data' => $data
				], $e->getCode(), [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}
}
