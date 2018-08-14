<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Api\ReportBroker\ReportBroker;
use App\Http\Requests\Api\ReportBroker\ReportBrokerRequest;
use App\Models\Page;

/**
 * Class ContactController.
 */
class ReportBrokerController extends ApiController
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

    /**
     * @param ReportBrokerRequest $request
     *
     * @return mixed
     */
    public function send(ReportBrokerRequest $request)
    {

		try {
            Mail::send(new ReportBroker($request));

			return response()->json([
				'data' => [
					'message'=>__('alerts.frontend.reportbroker.sent'),
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
