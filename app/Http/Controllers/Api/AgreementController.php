<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

use App\Models\Properties;
use App\Models\Property_type;
use App\Models\PropertyImages;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

use DB;

class AgreementController extends ApiController
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request) {
		$messages = 'Agreement index endpoint in progress.';
		
		$data['messages'] = $messages;		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	/**
	 * Creating message thread between customer and broker. 
	 * It is assumed that messages via API is between Customer and Broker
	 */
	public function store(Request $request) {
		
		$data['messages'] = 'agreement POST request';		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}	

	/**
	 * Creating message thread between customer and broker. 
	 * It is assumed that messages via API is between Customer and Broker
	 */
	public function seller(Request $request) {
		$error = [];
		
		$this->validate($request, [
			'property_id' => 'required',
		]);
		
		$property_id = $request->input('property_id');
		$customer_id = auth()->user()->id;

		$property = Properties::find($property_id);

		if ($property) {
			
		} else {
			$error[] = 'Property not found';
		}



		$message = $request->input('message');
		$recipients = $broker_id;
		
		$thread_subject = "thread-$broker_id-$customer_id";

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
		
		$data['messages'] = $new_message;		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}	
}