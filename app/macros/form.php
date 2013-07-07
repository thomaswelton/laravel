<?php

Form::macro('control', function($type, $field, $title = null)
{
	if(is_null($title)) $title = ucfirst($field);

	$label = Form::label($field, $title, array('class' => 'control-label'));
	$input = Form::$type($field);

	return <<<EOD

	<div class="control-group">
		{$label}
		<div class="controls">
			{$input}
		</div>
	</div>
EOD;
});