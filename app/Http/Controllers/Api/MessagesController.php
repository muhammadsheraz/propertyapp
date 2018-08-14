<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\Properties;
use App\Models\Property_requests;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

use App\Notifications\Backend\DistrictCreated;
use App\Notifications\Backend\DistrictUpdated;
use App\Notifications\Backend\DistrictDeleted;

use DB;

class MessagesController extends ApiController
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request) {
		$messages = [];
		$customer_id = auth()->user()->id;
		$per_page = $request->input('per_page', 500);
		$broker_id = $request->input('broker_id');
		$instance_id = $request->input('instance_id');
		$instance_type = $request->input('instance_type');
		
		$instance = '';
		
		switch ($instance_type) {
			case config('app.property'):
			$property = Properties::where([
				'broker_id' => $broker_id,
				'id' => $instance_id,
				])->first();
				
				if (!$property) {
					$data['messages'] = 'property not found';		
					$data['status'] = 'fail';
					
					return response()->json([
						'data' => $data
					], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);	
				}
				
				$instance = $property->property_no;
				
				break;
				case config('app.property_request'):
				$property_request = Property_requests::where([
					'broker_id' => $broker_id,
					'id' => $instance_id,
				])->first();
				
				if (!$property_request) {
					$data['messages'] = 'property request not found';		
					$data['status'] = 'fail';
					
					return response()->json([
						'data' => $data
					], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);	
				}
				
				$instance = $property_request->pr_no;
				
				break;			
				default:
				# code...
				break;
			}		
			
			$subject = 'thread-' . $instance . '-' . $broker_id . '-' . $customer_id;
			$customers = [];
			$threads = [];
			
			if (empty($broker_id)) {
				$data['messages'] = 'Broker id required';		
				$data['status'] = 'error';			
				return response()->json([
					'data' => $data
				], 422, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}	
			
			$broker = User::find($broker_id);		
			
			if ($broker) {
				$thread = Thread::where('subject', $subject)->first();

				$thread_ids = [];
				
				if ($thread) {
					$thread_ids = [$thread->id];
				}

			$messages = Message::whereIn('thread_id', $thread_ids)->orderBy('created_at', 'DESC')->paginate($per_page);

			if ($messages->count()) { 
				foreach ($messages as $message) {
					$message->user_data = User::find($message->user_id)->only('fullname','email','phone_no','mobile_no','broker_no', 'customer_no', 'avatar_location');
					$message->user_data = array_merge($message->user_data, ['avatar_abs_location'=>\Storage::url($message->user_data['avatar_location'])]);
					
					$customers[$message->user_id] = $message->toArray();
				}
			}		
			
			$data['messages'] = $messages;		
			$data['status'] = 'success';

			return response()->json([
				'data' => $data
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		} else {
			$data['messages'] = 'broker not found, either deleted or deactivated';		
			$data['status'] = 'error';

			return response()->json([
				'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}

	/**
	 * Creating message thread between customer and broker. 
	 * It is assumed that messages via API is between Customer and Broker
	 */
	public function store(Request $request) {
		$request->validate([
			'broker_id' => 'required',
			'message' => 'required',
			'instance_type' => 'required',
			'instance_id' => 'required'
		]);

		$broker_id = $request->input('broker_id');
		$customer_id = auth()->user()->id;

		$message = $request->input('message');
		$instance_type = $request->input('instance_type');
		$instance_id = $request->input('instance_id');
		$instance = '';

		switch ($instance_type) {
			case config('app.property'):
				$property = Properties::where([
					'broker_id' => $broker_id,
					'id' => $instance_id,
				])->first();
				
				if (!$property) {
					$data['messages'] = 'property not found';		
					$data['status'] = 'fail';

					return response()->json([
						'data' => $data
						], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);	
				}

				$instance = $property->property_no;

				break;
			case config('app.property_request'):
				$property_request = Property_requests::where([
					'broker_id' => $broker_id,
					'id' => $instance_id,
				])->first();
				
				if (!$property_request) {
					$data['messages'] = 'property request not found';		
					$data['status'] = 'fail';

					return response()->json([
						'data' => $data
						], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);	
				}

				$instance = $property_request->pr_no;

				break;			
			default:
				# code...
				break;
		}

		$recipients = $broker_id;

		$broker = User::find($broker_id);

		if ($broker) {
			$thread_subject = "thread-$instance-$broker_id-$customer_id";

			$thread = Thread::firstOrCreate(['subject' => $thread_subject]);

			// Message
			$new_message = Message::create([
				'thread_id' => $thread->id,
				'user_id' => $customer_id,
				'body' => $message,
			]);
			
			// Sender
			$participant = Participant::firstOrCreate([
				'thread_id' => $thread->id,
				'user_id' => $customer_id,
			]);

			$participant->last_read = new Carbon;
			$participant->save();

			// Add replier as a participant
			$participant = Participant::firstOrCreate([
				'thread_id' => $thread->id,
				'user_id' => $broker_id,
			]);
			
			$participant->save();

			$new_message->user_data = User::find($new_message->user_id)->only('fullname', 'email', 'phone_no', 'mobile_no', 'broker_no', 'customer_no', 'avatar_location');
			$new_message->user_data = array_merge($new_message->user_data, ['avatar_abs_location' => \Storage::url($new_message->user_data['avatar_location'])]);

			
			$data['messages'] = $new_message;		
			$data['status'] = 'success';

			return response()->json([
				'data' => $data
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);			
		} else {
			$data['messages'] = 'broker not found, either deleted or deactivated';
			$data['status'] = 'error';

			return response()->json([
				'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}	
}