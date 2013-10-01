<?php

HTML::macro('spacer', function($width, $height, $alt = '') {
    $key = "img_spacer_{$width}_{$height}";

    $src = Cache::remember($key, 1440,  function() use ($width, $height, $alt)
    {
        return Image::canvas($width, $height)->encode('data-url');
    });

    return View::make('macros/html_spacer', array(
        'width'     => $width,
        'height'    => $height,
        'alt'       => $alt,
        'src'       => $src,
    ));
});

HTML::macro('flash', function($syntax = null) {
    $output =  '';

    foreach (array("error", "danger", "success", "warning", "info") as $type) {
        if ( Session::has($type) ) {

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

    foreach ($menulinks as $link) {
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

HTML::macro('icon', function($icon){
    return "<span class=\"glyphicon glyphicon-{$icon}\"></span>";
});


HTML::macro('order_by', function($field, $title){

    $url = new \Purl\Url(Request::fullUrl());
    $url->query->set('orderBy', $field);

    $dir = 'asc';

    if(Input::get('orderBy') == $field){
       if(Input::get('orderDir', 'asc') == 'asc'){
            $dir = 'desc';
        }
    }

    $url->query->set('orderDir', $dir);

    return View::make('macros/html_order_by', array(
        'field' => $field,
        'title' => $title,
        'url' => $url
    ));
});

HTML::macro('pr', function($var){
    return View::make('macros/html_pr', array(
        'var' => $var
    ));
});
