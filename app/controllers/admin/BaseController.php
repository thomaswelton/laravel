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

class BaseController extends \BaseController {

	public $layout = 'admin.layouts.default';

	public function __construct(){
		// Require authorization for all pages expect login
		if(Request::path() != 'admin/login'){
        	$this->beforeFilter('auth.admin');
        }

        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
