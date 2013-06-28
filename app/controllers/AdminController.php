<?php

class AdminController extends BaseController {

	public $template = 'layouts.admin';

	public function __construct(){
		// Requeire authoristaion for all pages expect login
		if(Request::path() != 'login'){
        	$this->beforeFilter('auth');
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
}