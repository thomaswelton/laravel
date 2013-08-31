<?php namespace Admin;

use \Request;

class BaseController extends \BaseController
{
    public $layout = 'admin.layouts.default';

    public function __construct()
    {
        // Require authorization for all pages expect login
        if (Request::path() != 'admin/login') {
            $this->beforeFilter('auth.admin');
        }

        $this->beforeFilter('csrf', array('on' => 'post'));
    }
}
