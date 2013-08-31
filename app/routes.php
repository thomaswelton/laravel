<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'admin'), function() {

    Route::resource('users', 'Admin\\UserController');
    Route::controller('users', 'Admin\\UserController');

    Route::controller('config/{tab?}', 'Admin\\ConfigController');

    Route::controller('/','Admin\\HomeController');

});


Route::controller('/','HomeController');

/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
*/

// View composer for all admin views
View::composer('admin.*', function($view) {
    $adminUser = false;

    if (Sentry::check()) {
        $user = Sentry::getUser();

        if ($user->hasAccess('admin')) {
            $adminUser = $user;
        }
    }

    $view->with('adminUser', $adminUser);
});
