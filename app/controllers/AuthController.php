<?php

class AuthController extends BaseController {

	public $template = 'layouts.admin';

	public function __construct(){
        $this->beforeFilter('auth.admin');
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	public function getIndex(){
		$this->page = 'admin.auth.index';
		return $this->_render();
	}
}
