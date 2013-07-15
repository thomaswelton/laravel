<?php 

class AdminHomeController extends AdminBaseController {

	public function getIndex(){
		$this->layout->content = View::make('admin.index');
	}

	public function getLogin(){
		$this->layout->content = View::make('admin.login');
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

	public function getLogout(){
		Auth::logout();
		Session::flash('success', 'Logout successful');
		
		return Redirect::to('admin/login');
	}
}
