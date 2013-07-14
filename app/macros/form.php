<?php

Form::macro('control', function($type, $field, $title = null)
{
	if(is_null($title)) $title = ucfirst($field);
	
	$data = array(
		'label' => Form::label($field, $title, array('class' => 'control-label')),
		'input' => Form::$type($field),
		'field' => $field
	);

	return View::make('macros/form_control', $data);
});