<?php

HTML::macro('flash', function($syntax = null) {
    $output =  '';
    $alert_types = array("error", "success", "warning", "info");

    foreach ($alert_types as $type) {
        if( Session::has($type) ) {
            $output = '<div class="alert';
            $output .= ($type == 'warning') ? '">' : ' alert-'. $type .'">';
            $output .= '<button type="button" class="close" data-dismiss="alert"  aria-hidden="true">&times;</button>';
            $output .=  Session::get($type) . '</div>';
        }
    }
    return $output;
});

HTML::macro('render_menu', function($menulinks){
    $html = '<ul class="nav navbar-nav">';

    foreach($menulinks as $link){
        $attributes = $link;
        unset($attributes['title']);
        unset($attributes['href']);

        $active = Request::is($link['href']) ? 'class="active"' : '';

        $html .= '<li '.$active.'>' . HTML::link($link['href'], $link['title'], $attributes, $secure = null);
    }
    $html .= '</ul>';

    return $html;
});

HTML::macro('page_header', function($header){
    return View::make('macros/html_page_header', array(
        'header' => $header
    ));
});
