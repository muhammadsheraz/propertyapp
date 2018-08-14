<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'HomeController@index')->name('index');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contact/send', 'ContactController@send')->name('contact.send');

Route::any('properties', 'PropertiesController@index')->name('properties');
Route::get('/properties/list', 'PropertiesController@list')->name('properties.list');
Route::get('/properties/rent', 'PropertiesController@rent');
Route::get('/properties/buy', 'PropertiesController@buy');
Route::get('/properties/{id}/preview', 'PropertiesController@preview');

Route::group(['middleware' => ['nodebugbar']], function () {
    Route::get('/properties/{id}/panoramic_view', 'PropertiesController@panoramic_view');    
});

Route::resource('/properties', 'PropertiesController');

// Route::get('terms', 'TermsController@index')->name('terms');
// Route::get('about', 'AboutController@index')->name('about');
// Route::get('sale', 'SaleController@index')->name('sale');
// Route::get('rent', 'RentController@index')->name('rent');
// Route::get('services', 'ServicesController@index')->name('rent');
Route::get('information/{slug}', 'InformationController@index')->name('information');


/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});
