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
class SaleController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = Page::where('slug', 'sale')->first();

        return view('frontend.sale', $data);
    }
}
