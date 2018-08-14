<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

use App\Models\Page;

use DB;

class PagesController extends ApiController
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{
		$pages_rs = DB::table('pages');

		$pages_rs->select(
			'pages.*'
		);

		$pages_rs->orderBy('pages.title', 'ASC');
		$pages = [];
		if (!empty($pages_rs->get()->toArray())) {
			foreach ($pages_rs->get()->toArray() as $page) {
				unset($page->name);
				unset($page->image);
				$pages[] = $page;
			}
		}

		$data['pages'] = $pages;
		$data['status'] = 'success';

    	return response()->json([
			'data' => $data
			], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}

	public function show(Request $request, $id)
	{
		$page = Page::find($id);

		if ($page) {
			$data['page'] = $page;
			$data['status'] = 'success';

			return response()->json([
				'data' => $data
				], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		} else {
			$data['message'] = 'Page not found';
			$data['status'] = 'fail';

			return response()->json([
				'data' => $data
				], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
		}
	}

	
}