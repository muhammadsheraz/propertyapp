<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

use App\Models\Auth\User;
use App\Models\Properties;
use App\Models\Property_requests;


class MessagesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request, $id = '')
	{   
        $data = [];
        $broker_id = auth()->user()->id;
        $customers = [];
        $messages = [];
        $threads = Thread::forUser(\Auth::id())->get();

        $instance_map = [
            'p' => 'property',
            'pr' => 'property',
        ];

        if ($threads->count()) {
            foreach ($threads as $thread) {
                $messages = $thread->messages;
                $sub_comps = explode('-', $thread->subject);

                $instance_id = preg_replace("/[^0-9]+/", "", $sub_comps[1]);
                $instance_type = strtolower(preg_replace("/[^a-zA-Z]+/", "", $sub_comps[1]));

                if (!empty($sub_comps[1])) {
                    if ($messages->count()) {
                        foreach ($messages as $message) {
                            if ($message->user_id != \Auth::id()) {
                                $message->user_data = User::find($message->user_id)->only('fullname','email','phone_no','mobile_no','broker_no', 'customer_no', 'avatar_location');
                                $message->instance = $sub_comps[1];
                                $customers[$thread->subject] = $message->toArray(); ## convention of $thread->subject is 'thread - {property or pproperty_request number} - {broker_id} - {customer_id}'
                            }
                        }
                    }
                }

            }
        }

        $data['messages'] = $messages;
        $data['customers'] = $customers;

	    return view('backend.messages.index', $data);
    }

	public function store(Request $request) {
		$broker_id = auth()->user()->id;
		$customer_id = $request->input('_customer_id');

		$message = $request->input('_message');
		$recipients = $customer_id;
		
		$thread_subject = $request->input('_thread_subject');

        $thread = Thread::firstOrCreate(['subject' => $thread_subject]);

        $sub_comps = explode('-', $thread->subject);

        $instance_id = preg_replace("/[^0-9]+/", "", $sub_comps[1]);
        $instance_type = strtolower(preg_replace("/[^a-zA-Z]+/", "", $sub_comps[1]));        

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

        ## Sending Push Notification to Customer
        $url = 'https://fcm.googleapis.com/fcm/send';

        if ($instance_type == 'p') {
            $instance = Properties::find($instance_id);
        } else {
            $instance = Property_requests::find($instance_id);
        }

        if ($instance) {
            $arr = array(
                "to" => "/topics/chatProperty_" . $thread->id,
                "notification" => array(
                    "body" => $message,
                    "content_available" => true,
                    "priority" => "high",
                    "title" => "You've got a new message",
                    "type" => "propertyChat",
                    "sound" => "default",
                    "vibrate" => true,
                    "propertyId" => $instance->id,
                    "brokerId" => auth()->user()->id,
                ),
                "data" => array(
                    "body" => $message,
                    "content_available" => true,
                    "priority" => "high",
                    "title" => "You've got a new message",
                    "type" => "propertyChat",
                    "sound" => "default",
                    "vibrate" => true,
                    "propertyId" => $instance->id,
                    "brokerId" => auth()->user()->id,
                ),
            );

            $http = new \GuzzleHttp\Client;
            $headers = [
                'Authorization' => 'key=AAAAjdq3fo8:APA91bFiQEhPzTnVNkD91MWJT8RyodYHbZucMtf5NohaFq-RsIhmoHhVRB4ymrJ1-M55LEbwxj1Vk6fQp1LaT_wVmxPkLUhKYd9uMoACvlJE5ZqLVTPwdblIvp-Sk2NYSemuh68XlcBe',
                'content-type' => 'application/json',
            ];

            try {
                $res = $http->post($url, [
                    'headers' => $headers,
                    'json' => $arr,
                ]);
            } catch (\Exception $e) {
                \Log::error('Error occurred while sending push notification at message add: ' . $e->getMessage() . ': at Line ' . $e->getLine());
            }            
        }
        
		$data['thread'] = $thread;		
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }    
    
    public function show(Request $request, $thread_id = '')
	{   
        $data = [];
        $broker_id = auth()->user()->id;
        $customer_id = session()->get('_customer_id');
        session()->forget('_customer_id');

        $customers = [];
        $messages = [];

        $threads = Thread::forUser(\Auth::id())->get();

        $instance_map = [
            'p' => 'property',
            'pr' => 'property',
        ];

        if ($threads->count()) {
            foreach ($threads as $thread) {
                $messages = $thread->messages;
                $sub_comps = explode('-', $thread->subject);

                // $instance_type = preg_replace("/[^0-9]+/", "", $sub_comps[1]);
                // $instance_id = strtolower(preg_replace("/[^a-zA-Z]+/", "", $sub_comps[1]));

                if (!empty($sub_comps[1])) {
                    if ($messages->count()) {
                        foreach ($messages as $message) {
                            if ($message->user_id != \Auth::id()) {
                                $message->user_data = User::find($message->user_id)->only('fullname','email','phone_no','mobile_no','broker_no', 'customer_no', 'avatar_location');
                                $message->instance = $sub_comps[1];
                                $customers[$thread->subject] = $message->toArray(); ## convention of $thread->subject is 'thread - {property or pproperty_request number} - {broker_id} - {customer_id}'
                            }
                        }
                    }
                }
            }
        }

        $customer_thread = Thread::find($thread_id);
        $messages = $customer_thread->messages;
        if ($messages->count()) {
            foreach ($messages as $message) {
                if ($message->user_id != \Auth::id()) {
                    $message->user_data = User::find($message->user_id)->only('fullname','email','phone_no','mobile_no','broker_no', 'customer_no', 'avatar_location');
                    $message->instance = $sub_comps[1];
                }
            }        
        }        

        if (empty($customers[$customer_thread->subject])) {
            return redirect('admin/messages');
        }

        if (empty($customer_id)) {
            return redirect('admin/messages');
        }

        $customer_thread->markAsRead($broker_id);

        $data['all_messages'] = $messages;
        $data['customers'] = $customers;
        $data['customer_id'] = $customer_id;
        $data['active_customer'] = $customers[$customer_thread->subject];
        $data['customer_thread'] = $customer_thread;
        
	    return view('backend.messages.show', $data);
    } 
    
    public function ajax_get_latest_messages(Request $request)
	{   
        $data = [];
        $broker_id = auth()->user()->id;
        $customer_id = $request->input('_customer_id');
        $thread_subject = $request->input('_thread_subject');

        $customers = [];
        $messages = [];

        // $subject = 'thread-' . $broker_id . '-' . $customer_id;
        $thread = Thread::where('subject', $thread_subject)->first();

        if (count($thread)) {
            $messages = $thread->userUnreadMessages($broker_id);
            if ($messages->count()) {
                $thread->markAsRead($broker_id);
                
                foreach ($messages as $message) {
                    $message->created_at_formated = strftime('%d %b, %Y %H:%M', strtotime($message->created_at));
                    $messages_arr[] = $message;
                }

                $data['messages'] = $messages_arr;
                $data['status'] = 'success';

                return response()->json([
                    'data' => $data
                    ], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);                
            }
        }
        
        return response()->json([], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }    

    private function getUnreadMessages($broker_id) {
        $messages = [];
        $threads = Thread::forUserWithNewMessages($broker_id)->latest('updated_at')->get();

        if (!$threads->isEmpty()) {
            foreach ($threads as $thread) {
                foreach ($thread->userUnreadMessages($broker_id) as $message) {
                    $message->user_data = User::find($message->user_id)->only('fullname','email','phone_no','mobile_no','broker_no', 'customer_no');
                    $messages[] = $message->toArray();
                }
            }
        }

        return $messages;
    }    
	
}