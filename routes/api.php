<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::filter('nodebugbar', function()
// {
//     \Debugbar::disable();
// });

// Route::when('api/*', 'nodebugbar');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('system', function (Request $request) {
//     return response()->json([
//         'data' => [
//             'message'=>'Success'
//         ]
//         ]);
// });



Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::resource('broker', 'BrokerController');
    Route::resource('cities', 'CitiesController');
    Route::resource('districts', 'DistrictsController');
    
    Route::post('contact/send', 'ContactController@send')->name('contact.send');
    Route::post('reportbroker/send', 'ReportBrokerController@send')->name('reportbroker.send');
    
    Route::resource('contact', 'ContactController');

    Route::resource('properties', 'PropertiesController');
    Route::resource('property_types', 'Property_typesController');

    Route::resource('/pages', 'PagesController');    

    // Password Reset Routes...
    Route::post('password/email', 'ForgotPasswordController@verifyEmail');
    Route::post('password/code', 'ForgotPasswordController@verifyCode');
    Route::post('password/change', 'ForgotPasswordController@changePassword');    
    
    Route::group([
        'middleware' => ['auth:api','nodebugbar', 'role:customer'],
    ], function () {
        Route::resource('messages', 'MessagesController');
        // Route::get('agreement', 'AgreementController');
        Route::post('agreement/seller', 'AgreementController@seller');
        // Route::post('agreement/buyer', 'AgreementController@buyer');
        
        Route::resource('property_requests', 'PropertyRequestsController');        
        Route::resource('property_requests_buyers', 'PropertyRequestsBuyersController');        
        Route::resource('property_alerts', 'AlertsController');        
    });    
    
    Route::group([
        'prefix'     => 'auth',
        'as'         => 'auth.',
        'namespace'  => 'Auth',        
    ], function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');
        
        Route::group([
            'middleware' => ['auth:api','nodebugbar'],
        ], function () {
                Route::post('logout', 'LoginController@logout')->name('logout');       

                // Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
                // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
                
                Route::resource('user', 'UserController');    
                Route::resource('profile', 'ProfileController');            
                Route::patch('profile', 'ProfileController@update');            
                Route::post('profile/avatar', 'ProfileController@avatar');
        });
    });
});
