<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class AjaxController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{
        // Keep Code Clean ;)
    }
    
    public function set_session_value(Request $request)
	{
        $session_key = $request->input('_session_key');
        $session_value = $request->input('_session_value');

        $request->session()->put($session_key, $session_value);
        
        return response()->json([
            'status' => 'success',
        ]);
	}

	
}