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

	Route::get('/logout','Admin\\AuthController@getLogout');
	Route::get('/login','Admin\\AuthController@getIndex');
	Route::post('/login','Admin\\AuthController@postIndex');

    Route::resource('users', 'Admin\\UserController');

    Route::controller('config/{tab?}', 'Admin\\ConfigController');

	Route::controller('/','Admin\\HomeController');

});


Route::get('/logout','AuthController@getLogout');
Route::get('/login','AuthController@getIndex');
Route::post('/login','AuthController@postIndex');


Route::controller('/','HomeController');

/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
*/

// View composer for all admin views
View::composer('admin.*', function($view)
{
	$adminUser = false;

	if(Sentry::check()){
		$user = Sentry::getUser();

		if($user->hasAccess('admin')){
			$adminUser = $user;
		}
	}

    $view->with('adminUser', $adminUser);
});
