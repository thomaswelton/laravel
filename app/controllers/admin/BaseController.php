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

class BaseController extends \BaseController {

	public $layout = 'layouts.admin';

	public function __construct(){
		// Require authorization for all pages expect login
		if(Request::path() != 'admin/login'){
        	$this->beforeFilter('auth.admin');
        }

        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
