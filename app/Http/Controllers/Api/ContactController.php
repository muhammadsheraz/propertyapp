<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Models\Page;

/**
 * Class ContactController.
 */
class ContactController extends ApiController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
		return response()->json([
			'data' => [
				'message'=>'Success GET'
			]
        ]);
	}
	
    public function store()
    {	
		return response()->json([
			'data' => [
				'status' => 'success',
				'message' => 'verification code sent to email address',
			]
		], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request)
    {
		try {
            Mail::send(new SendContact($request));

			return response()->json([
				'data' => [
					'message'=>__('alerts.frontend.contact.sent'),
					'status'=>'success'
				]
			]);
		} catch (\Exception $e) {
			return response()->json([
				'data' => [
					'message'=>$e->getMessage() . " at :" . $e->getLine(),
					'status'=>'error'
				]
			]);
		}
    }
}
