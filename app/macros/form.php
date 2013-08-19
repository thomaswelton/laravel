<?php

Form::macro('control', function($type, $name, $title = null, $value = null, $options = array())
{
	if(is_null($title)) $title = ucfirst($field);

	$data = array(
		'label' => Form::label($name, $title, array('class' => 'control-label')),
		'field' => $name
	);

	if(is_null($value)){
		$data['input'] = Form::$type($name);
	}else{
		$data['input'] = Form::$type($name, $value, $options);
	}

	return View::make('macros/form_control', $data);
});

Form::macro('date', function($name, $value = null, $options = array())
{
	$value = Form::getValueAttribute($name, $value);

	if('Carbon\Carbon' == get_class($value)){
		$value = $value->toDateString();
	}

	return Form::input('date', $name, $value, $options);
});