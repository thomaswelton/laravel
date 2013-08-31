<?php namespace Admin;

use \App;
use \Config;
use \Redirect;
use \Response;
use \View;
use \Input;
use \Session;

class ConfigController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex($tab = 'site')
    {
        $this->layout->content = View::make('admin.config.index', array(
            'form' => View::make('admin.config.tabs.' . $tab),
            'tab' => $tab
        ));
    }

    public function postIndex()
    {
        $configItem = Input::get('config');
        $configValues = (array) Input::get($configItem);

        $config = \App\Models\Config::where('name', '=', $configItem)->first();

        if (is_null($config)) {
            $config = new \App\Models\Config();
        }

        $config->name = $configItem;
        $config->config = json_encode($configValues);

        if ($config->save()) {
            Session::flash('success', 'Config saved');
        } else {
            Session::flash('error', 'Config could not be saved.');
        }

        return Redirect::to("admin/config/" . $configItem);
    }

}
