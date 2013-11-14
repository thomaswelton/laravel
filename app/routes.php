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

Route::get('/login','AuthController@getLogin');
Route::get('/logout','AuthController@getLogout');
Route::post('/login','AuthController@postLogin');

Route::get('/password','AuthController@getForgot');
Route::post('/password','AuthController@postForgot');
Route::controller('/password','AuthController');

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

View::composer('admin.user.form', function($view)
{
    $view->with('groups', Sentry::findAllGroups());
    $view->with('rules', User::$rules);
});
