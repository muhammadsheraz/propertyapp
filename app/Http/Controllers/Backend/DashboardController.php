<?php

namespace App\Http\Controllers\Backend;
use App\Models\Properties;
use App\Models\Property_type;
use App\Models\PropertyImages;
use App\Models\Auth\User;
use App\Models\Property_requests_buyers;

use DB;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        $data = [];

        $buyCount = Properties::getAllBuy()->count();
        $rentCOunt = Properties::getAllRent()->count();
        $cities = DB::table('cities')->count();
        $districts = DB::table('districts')->count();
        $brokers =  User::getAllBrokers()->count();
        $customers_counts = User::getAllCustomers()->count();
        $customers = User::getAllCustomers()->get();
        $properties = Properties::getAllProperties()->get(); 
        $properties_for_select = Properties::getAllPropertiesForSelect(); 
        $brokers_for_select = User::getAllBrokersForSelect();

        $sales = [];
        $messages = [];

        // $threads = Thread::forUser(auth()->user()->id)->latest('updated_at')->get();
        // $threads = Thread::forUserWithNewMessages(\Auth::id())->latest('updated_at')->get();
		// if ($threads->count()) {
		// 	foreach ($threads as $thread) {
        //         $user_messages = $thread->userUnreadMessages(auth()->user()->id);
		// 		$messages = array_merge($messages, $user_messages->toArray());
		// 	}
		// }

        // $messages = Message::whereIn('thread_id', $thread_ids)->paginate(10)->toArray();

        // echo '<pre>'; print_r($messages); echo '</pre>'; die;


        $allCount = [
            'properties_count' => $properties->count(), 
            'buy' => $buyCount , 
            'rent' => $rentCOunt , 
            'city' => $cities , 
            'districts' => $districts , 
            'broker' => $brokers , 
            'customers' => $customers_counts, 
            'sales' => count($sales),
            'messages' => count($messages),
        ];
        
		$property_requests_buyers = DB::table('property_requests_buyers');
		$property_requests_buyers->leftJoin('users', 'property_requests_buyers.buyer_id', '=', 'users.id');
        $property_requests_buyers->leftJoin('properties', 'property_requests_buyers.property_id', '=', 'properties.id');    
        
		$property_requests_buyers->select(
			'property_requests_buyers.*',
			'users.customer_no AS customer_no',
			'properties.property_no AS property_no',
			DB::raw("property_requests_buyers.agreement_file AS agreement_file")
        )
        ->where("property_requests_buyers.broker_id","=",auth()->user()->id)
        ->orderBy("created_at", "DESC")->take(50);

        $data['allcount'] = $allCount;
        $data['customers'] = $customers;
        $data['property_requests_buyers'] = $property_requests_buyers;
        $data['properties'] = Properties::getAllProperties()->simplePaginate(10);
        $data['brokers'] = User::getAllBrokers()->get();
        

        if (auth()->user()->hasRole('administrator')) {
            return view('backend.dashboard', $data);
        }else{
            return view('backend.broker-dashboard', $data);
        }
    }

    public function getUnreadMessages($broker_id) {
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
