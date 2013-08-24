<?php

class Debug {

    public static function pr($var) {
    	echo View::make('layouts.bootstrap', array('content' => HTML::pr($var)));
    	exit();
    }

}
