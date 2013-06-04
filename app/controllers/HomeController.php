<?php

class HomeController extends BaseController {

	public $template = 'layouts.default';

	private function _render(){
		$content = View::make($this->page);

		if (Request::ajax()){
			$data = array(
				'html' => $content->render(),
				'url' =>  Request::path()
			);

			return Response::json($data);
		}else{
			return View::make($this->template)->with('content', $content);
		}
	}

	public function getIndex(){
		$this->page = 'pages.index';
		return $this->_render();
	}

	public function getContent(){
		$this->page = 'pages.content';
		return $this->_render();
	}
}