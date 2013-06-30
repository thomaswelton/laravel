<?php

class AdminController extends BaseController {

	public $template = 'layouts.admin';

	public function __construct(){
		// Require authorization for all pages expect login
		if(Request::path() != 'admin/login'){
        	$this->beforeFilter('auth.admin');
        }

        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	public function getIndex(){
		$this->page = 'admin.index';
		return $this->_render();
	}

	public function getLogin(){
		$this->page = 'admin.login';
		return $this->_render();
	}

	public function postLogin(){
		
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if ( Auth::attempt($userdata) ){
			// we are now logged in, go to admin home
			return Redirect::to('admin');
		}
		else{
			// auth failure! lets go back to the login
			Session::flash('error', 'Login failed. Check your username and password.');

			return Redirect::to('admin/login');
		}
	}
}
