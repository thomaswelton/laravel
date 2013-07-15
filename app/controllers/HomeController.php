<?php

class HomeController extends BaseController {

	public $layout = 'layouts.default';

	public function getIndex(){
		$this->layout->content = View::make('pages.index');
	}
}
