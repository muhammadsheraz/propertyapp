<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Page;
use DB;

/**
 * Class ContactController.
 */
class InformationController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index($slug)
    {

        $page = Page::where('slug', $slug)->first()->toArray();
        
        if ($page) {
            $data['page'] = $page;

            return view('frontend.information', $data);
        } else {
            abort(404);
        }
    }
}
