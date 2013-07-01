<?php

class BaseController extends Controller {

	public $data = array();

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Render the output to the browser
	 */
	public function _render(){
		$content = View::make($this->page);

		foreach ($this->data as $key => $value) {
			$content->with($key, $value);
		}

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

}