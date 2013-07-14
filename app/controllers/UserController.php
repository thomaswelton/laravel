<?php 

class UserController extends AdminBaseController {

	public $template = 'layouts.admin';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->page = 'admin.user.index';
		$this->data = array(
			'users' => User::all()
		);

		return $this->_render();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->page = 'admin.user.form';

		$this->data = array(
			'header' => 'Create User'
		);

		return $this->_render();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;
    	$user->username = Input::get('username');
    	$user->password = Input::get('password');
    	$user->email    = Input::get('email');

    	$user->save();

        Session::flash('success', 'User added');
        return Redirect::to('admin/users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		die('Show '.$id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(is_null($id)){
			Session::flash('error', 'No user ID specified');
			return Redirect::to('admin/users');
		}

		// Load the user
		$user = User::find($id);

		if(!$user){
			Session::flash('error', 'No user found');
			return Redirect::to('admin/users');
		}

		$this->data = array(
			'header' => 'Edit User',
			'user' => $user
		);

		$this->page = 'admin.user.form';
		return $this->_render();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
    	$user->username = Input::get('username');
    	$user->password = Input::get('password');
    	$user->email    = Input::get('email');

    	$user->save();

        Session::flash('success', 'User updated');
        return Redirect::to('admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}