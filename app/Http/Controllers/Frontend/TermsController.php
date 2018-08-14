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
class TermsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = Page::where('slug', 'terms-and-conditions')->first()->toArray();

        return view('frontend.terms', $data);
    }
}
