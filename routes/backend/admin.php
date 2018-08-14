<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('account', 'AccountController@index')->name('account');
Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

Route::get('/properties/{id}/sold', 'PropertiesController@sold');
Route::get('/properties/{id}/rented', 'PropertiesController@rented');
Route::get('/properties/{id}/request_sold', 'PropertiesController@request_sold');
Route::get('/properties/{id}/request_rented', 'PropertiesController@request_rented');
Route::any('/properties/{id}/view_agreement', 'PropertiesController@view_agreement');

Route::any('/properties/image_process', 'PropertiesController@image_process');
Route::any('/properties/remove_image', 'PropertiesController@remove_image');
Route::any('/properties/set_featured_image', 'PropertiesController@set_featured_image');
Route::any('/properties/set_panoramic_image', 'PropertiesController@set_panoramic_image');
Route::any('/properties/get_districts', 'PropertiesController@get_districts');
Route::get('/properties/grid', 'PropertiesController@grid');
Route::resource('/properties', 'PropertiesController');

Route::resource('/file', 'FileController');

Route::resource('/notifications', 'NotificationsController');
Route::get('/messages/get_latest_messages', 'MessagesController@ajax_get_latest_messages');
Route::resource('/messages', 'MessagesController');
Route::post('/ajax/set_session_value', 'AjaxController@set_session_value');

Route::group([
    'middleware' => 'role:administrator',
], function () {

    Route::get('/property_types/grid', 'Property_typesController@grid');
    Route::resource('/property_types', 'Property_typesController');
    Route::get('/property_types/{id}/delete', 'Property_typesController@delete');
    
    Route::get('/cities/grid', 'CitiesController@grid');
    Route::resource('/cities', 'CitiesController');
//    Route::get('/cities/{id}/delete', 'CitiesController@delete');
    
    Route::get('/districts/grid', 'DistrictsController@grid');
    Route::resource('/districts', 'DistrictsController');
    
    
    Route::get('/pages/grid', 'PagesController@grid');
    Route::any('/pages/remove_image', 'PagesController@remove_image');
    Route::resource('/pages', 'PagesController');

    Route::resource('/settings', 'SettingsController');
});