<?php

class HomeController extends BaseController {

	public $template = 'layouts.default';

	public function getIndex(){
		$this->page = 'pages.index';
		return $this->_render();
	}

	public function getContent(){
		$this->page = 'pages.content';
		return $this->_render();
	}
}