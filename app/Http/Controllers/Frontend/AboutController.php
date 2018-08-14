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
class AboutController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $data['page'] = Page::where('slug', 'about-us')->first();

        return view('frontend.about', $data);
    }
}
