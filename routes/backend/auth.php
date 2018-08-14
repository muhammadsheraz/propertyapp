<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
], function () {
    Route::group([
        'middleware' => 'role:administrator',
    ], function () {
        /*
         * User Management
         */
        Route::group(['namespace' => 'User'], function () {

            /*
             * User Status'
             */
            Route::get('user/deactivated', 'UserStatusController@getDeactivated')->name('user.deactivated');
            Route::get('user/deleted', 'UserStatusController@getDeleted')->name('user.deleted');

            /*
             * User CRUD
             */
            Route::resource('user', 'UserController');

            /*
             * Specific User
             */
            Route::group(['prefix' => 'user/{user}'], function () {
                // Account
                Route::get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);

                // Social
                Route::delete('social/{social}/unlink', 'UserSocialController@unlink')->name('user.social.unlink');

                // Confirmation
                Route::get('confirm', 'UserConfirmationController@confirm')->name('user.confirm');
                Route::get('unconfirm', 'UserConfirmationController@unconfirm')->name('user.unconfirm');

                // Password
                Route::get('password/change', 'UserPasswordController@edit')->name('user.change-password');
                Route::patch('password/change', 'UserPasswordController@update')->name('user.change-password.post');

                // Access
                Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

                // Session
                Route::get('clear-session', 'UserSessionController@clearSession')->name('user.clear-session');
            });

            /*
             * Deleted User
             */
            Route::group(['prefix' => 'user/{deletedUser}'], function () {
                Route::get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
                Route::get('restore', 'UserStatusController@restore')->name('user.restore');
            });
        });

        

        /*
         * Broekr Management
         */
        Route::group(['namespace' => 'Broker'], function () {

            /*
             * Broker Status'
             */
            Route::get('broker/deactivated', 'BrokerStatusController@getDeactivated')->name('broker.deactivated');
            Route::get('broker/deleted', 'BrokerStatusController@getDeleted')->name('broker.deleted');

            /*
             * Broker CRUD
             */
            Route::any('broker/{id}/download_contract_file', 'BrokerController@download_contract_file');
            Route::resource('broker', 'BrokerController');
            
            /*
             * Specific Broker
             */
            Route::group(['prefix' => 'broker/{broker}'], function () {
                // Account
                Route::get('account/confirm/resend', 'BrokerConfirmationController@sendConfirmationEmail')->name('broker.account.confirm.resend');

                // Status
                Route::get('mark/{status}', 'BrokerStatusController@mark')->name('broker.mark')->where(['status' => '[0,1]']);

                // Social
                Route::delete('social/{social}/unlink', 'BrokerSocialController@unlink')->name('broker.social.unlink');

                // Confirmation
                Route::get('confirm', 'BrokerConfirmationController@confirm')->name('broker.confirm');
                Route::get('unconfirm', 'BrokerConfirmationController@unconfirm')->name('broker.unconfirm');

                // Password
                Route::get('password/change', 'BrokerPasswordController@edit')->name('broker.change-password');
                Route::patch('password/change', 'BrokerPasswordController@update')->name('broker.change-password.post');

                // Access
                Route::get('login-as', 'BrokerAccessController@loginAs')->name('broker.login-as');

                // Session
                Route::get('clear-session', 'BrokerSessionController@clearSession')->name('broker.clear-session');
            });

            /*
             * Deleted Broker
             */
            Route::group(['prefix' => 'broker/{deletedBroker}'], function () {
                Route::get('delete', 'BrokerStatusController@delete')->name('broker.delete-permanently');
                Route::get('restore', 'BrokerStatusController@restore')->name('broker.restore');
            });
        });

        // Route::group(['namespace' => 'Brokers'], function () {
        //     Route::resource('brokers', 'BrokersController');
        //     Route::get('brokers', 'BrokersController@index')->name('brokers');           
        // });        

        /*
         * Role Management
         */
        Route::group(['namespace' => 'Role'], function () {
            Route::resource('role', 'RoleController', ['except' => ['show']]);
        });
    });
});
