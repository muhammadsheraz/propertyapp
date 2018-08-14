<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class NotificationsController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{
        $notifications_all = auth()->user()->notifications;
        // $notifications_all->orderBy('created_at');
		$notifications_all->markAsRead(); # commented temporarily and should be enabled back when notification work is done

        $data['notifications_all'] = $notifications_all;
        
        // echo '<pre>'; print_r($notifications_all->toArray()); echo '</pre>'; die;
			
	    return view('backend.notifications.index', $data);
    }
    
    public function ajax_set_notification_id(Request $request)
	{
        $notification_id = $request->input('id');

		return response('success', 200);
	}

	
}