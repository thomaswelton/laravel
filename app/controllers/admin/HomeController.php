<?php namespace Admin;

use \App;
use \Config;
use \Controller;
use \Redirect;
use \Response;
use \Request;
use \View;
use \Input;
use \File;
use \Session;
use \URL;
use \Exception;


class HomeController extends BaseController {

	public function getIndex(){
		$this->layout->content = View::make('admin.index');
	}
}
