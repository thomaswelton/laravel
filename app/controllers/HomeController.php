<?php

class HomeController extends BaseController {

	public function getIndex(){
		return View::make('layouts.default')->nest('content', 'pages.index');
	}

	public function getContent(){
		return View::make('layouts.default')->nest('content', 'pages.content');
	}
}