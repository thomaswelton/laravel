<?php

Form::macro('control', function($type, $name, $title = null, $value = null, $options = array('class' => 'form-control')) {
    if(!is_string($value)) $value = '';

    if(is_null($title)) $title = ucfirst($name);

    if ($type == 'password') {
        $input = Form::password($name, array('class' => 'form-control'));
    } elseif ($type == 'checkbox') {
        if ($value == 1) {
            $options['checked'] = 'checked';
        }
        $input = Form::input($type, $name, 1, $options);
    } else {
        $input = Form::$type($name, $value, array('class' => 'form-control'));
    }

    $data = array(
        'label' => Form::label($name, $title, array('class' => 'col-sm-2 control-label')),
        'input' => $input,
        'field' => $name
    );

    return View::make('macros/form_control', $data);
});

Form::macro('date', function($name, $value = null, $options = array()) {
    $value = Form::getValueAttribute($name, $value);

    if (is_object($value) && 'Carbon\Carbon' == get_class($value)) {
        $value = $value->toDateString();
    }

    return Form::input('date', $name, $value, $options);
});

Form::macro('time', function($name, $value = null, $options = array()) {
    $value = Form::getValueAttribute($name, $value);

    if (is_object($value) && 'Carbon\Carbon' == get_class($value)) {
        $value = $value->format('H:i');
    }

    return Form::input('time', $name, $value, array('class' => 'span2'));
});

Form::macro('datetime', function($name, $value = null, $options = array()) {
    return Form::date($name, $value, $options) . Form::time($name, $value, $options);
});
