<?php namespace Admin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content = View::make('admin.user.index', array(
			'users' => Sentry::getUserProvider()->findAll()
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('admin.user.form', array(
			'header' => 'Create User'
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$ardent = new User;

		if ( $ardent->validate() )
		{
			$validData = $ardent->getAttributes();

			try
			{
				$user = Sentry::register($validData, true);

				Session::flash('success', 'User added');
	        	return Redirect::to('admin/users');
	        }
	        catch(Exception $e)
	        {
	        	Session::flash('error', $e->getMessage());
	        }
		}

		Input::flash();
		return Redirect::to('admin/users/create')->withErrors($ardent->errors());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
		    $user = Sentry::getUserProvider()->findById($id);
		    print_r($user);
		    die;
		}
		catch (UserNotFoundException $e)
		{
		    Session::flash('User not found', $e->getMessage());
		    return Redirect::to('admin/users');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try
		{
		    $user = Sentry::getUserProvider()->findById($id);
		    
		    $this->layout->content = View::make('admin.user.form', array(
		    	'header' => 'Edit User',
		    	'user' => $user
		    ));
		}
		catch (UserNotFoundException $e)
		{
		    Session::flash('error', 'No user found');
			return Redirect::to('admin/users');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
		    // Find the user using the user id
		    $user = Sentry::getUserProvider()->findById($id);

		    // Update the user details
		    $user->email = Input::get('email');

		    // Update the user
		    if ($user->save())
		    {
		    	Session::flash('success', 'User updated');
		        return Redirect::to('admin/users');
		    }
		    else
		    {
		       Session::flash('error', 'User could not be saved.');
		    }
		}
		catch(Exception $e){
			Session::flash('error', $e->getMessage());
		}

		Input::flash();
		return Redirect::to('admin/users/'.$id.'/edit');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// TODO: cant delete the last superadmin only super admins can delete
		try{
			User::destroy($id);
		}catch(Exception $e){
			Session::flash('error', $e->getMessage());
	        return Redirect::to('admin/users');
		}

		Session::flash('success', 'User deleted');
	   	return Redirect::to('admin/users');
	}

}