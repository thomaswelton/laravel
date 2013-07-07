<?php

class AuthController extends BaseController {

	public $template = 'layouts.admin';

	public function __construct(){
        $this->beforeFilter('auth.admin');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function postUpdate($id){
    	$user = User::find($id);
    	$user->username = Input::get('username');
    	$user->password = Input::get('password');
    	$user->email    = Input::get('email');

    	$user->save();

        Session::flash('success', 'User updated');
        return Redirect::to('admin/auth/index');
    }

    public function postAdd(){
    	$user = new User;
    	$user->username = Input::get('username');
    	$user->password = Input::get('password');
    	$user->email    = Input::get('email');

    	$user->save();

        Session::flash('success', 'User added');
        return Redirect::to('admin/auth/index');
    }

	public function getIndex(){
		$this->page = 'admin.auth.index';
		$this->data = array(
			'users' => User::all()
		);

		return $this->_render();
	}

	public function getAdd(){
		$this->page = 'admin.auth.form';

		return $this->_render();
	}

	public function getEdit($userId = null){
		if(is_null($userId)){
			Session::flash('error', 'No user ID specified');
			return Redirect::to('admin/auth/index');
		}

		// Load the user
		$user = User::find($userId);

		if(!$user){
			Session::flash('error', 'No user found');
			return Redirect::to('admin/auth/index');
		}

		$this->data = array(
			'user' => $user
		);

		$this->page = 'admin.auth.form';
		return $this->_render();
	}
}
