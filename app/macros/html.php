<?php

HTML::macro('flash', function($syntax = null) {
    $output =  '';
    $alert_types = array("error", "success", "warning", "info");
    
    foreach ($alert_types as $type) {
        if( Session::has($type) ) {
            $output = '<div class="alert';
            $output .= ($type == 'warning') ? '>' : ' alert-'. $type .'">';
            $output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $output .=  Session::get($type) . '</div>';
        }
    }
    return $output;
});
