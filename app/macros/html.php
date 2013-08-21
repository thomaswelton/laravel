<?php

HTML::macro('flash', function($syntax = null) {
    $output =  '';
    
    foreach (array("error", "danger", "success", "warning", "info") as $type) {
        if( Session::has($type) ) {
            
            switch ($type) {
                case 'warning':
                    $class = '';
                    break;

                case 'error':
                    $class = 'alert-danger';
                    break;
                
                default:
                    $class = 'alert-'.$type;
                    break;
            }

            $output .= View::make('macros/html_flash', array(
                'class' => $class,
                'text' => Session::get($type)
            ));
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
