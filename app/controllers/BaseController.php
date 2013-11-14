<?php

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
	public $data = null;

    public function __construct()
    {
        if (Config::get('site::protected') == 1) {
            $this->beforeFilter('auth.protected');
        }

        $this->data = (object) array();
    }
}
