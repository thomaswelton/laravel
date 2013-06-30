<?php

class HomeController extends BaseController {

	public $template = 'layouts.default';

	public function getIndex(){
		$this->page = 'pages.index';
		return $this->_render();
	}
}
