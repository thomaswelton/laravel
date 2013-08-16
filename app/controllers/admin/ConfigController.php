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

class ConfigController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex($tab = null)
	{
		if(is_null($tab)){
			$tab = 'laravel-facebook';
		}

		$this->layout->content = View::make('admin.config.index', array(
			'form' => View::make('admin.config.tabs.' . $tab),
			'tab' => $tab
		));
	}

	public function postIndex()
	{
		$configItem = Input::get('config');
		$configValues = Input::get($configItem);

		
		$config = \App\Models\Config::where('name', '=', $configItem)->first();

		if(is_null($config)){
			$config = new \App\Models\Config();
		}

		$config->name = $configItem;
		$config->config = json_encode($configValues);
		
		if($config->save())
		{
			Session::flash('success', 'Config saved');
		}else{
			Session::flash('error', 'Config could not be saved.');
		}

		return Redirect::to("admin/config/" . $configItem);
	}

}