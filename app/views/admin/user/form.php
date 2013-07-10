<?= HTML::page_header('Edit User') ?>

<?= HTML::flash() ?>

<?php

if(isset($user)): ?>
	<?= Form::model($user, array('url' => array('admin/users/'.$user->id), 'method' => 'PUT', 'class' => 'form-horizontal')) ?>
<?php else: ?>
	<?= Form::open(array('url' => array('admin/users'), 'method' => 'POST', 'class' => 'form-horizontal')) ?>
<?php endif; ?>

	<?= Form::control('text', 'username', 'Username') ?>
	<?= Form::control('email', 'email', 'Email') ?>
	<?= Form::control('password', 'password') ?>

	<div class="form-actions">
		<div class="pull-left">
			<button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button>
			<a href="<?= action('UserController@index') ?>" class="btn">Cancel</a>
		</div>
	</div>

<?= Form::close() ?>