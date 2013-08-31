<?php

class BaseController extends Controller
{
    public $data = array();

    public function __construct()
    {
        if (Config::get('site::protected') == 1) {
            $this->beforeFilter('auth.protected');
        }
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);

            if (!property_exists($this->layout, 'title')) {
                $this->layout->title = 'Laravel 4';
            }
            if (!property_exists($this->layout, 'description')) {
                $this->layout->description = 'Laravel, the elegant PHP framework for web artisans. Start enjoying development again.';
            }
        }
    }

}
