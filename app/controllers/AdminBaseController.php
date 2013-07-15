<?php

class AdminBaseController extends BaseController {

	public $layout = 'layouts.admin';

	public function __construct(){
		// Require authorization for all pages expect login
		if(Request::path() != 'admin/login'){
        	$this->beforeFilter('auth.admin');
        }

        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
