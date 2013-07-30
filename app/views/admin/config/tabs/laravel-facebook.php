<?= Form::open(array('url' => array('admin/config'), 'method' => 'POST', 'class' => 'form-horizontal')) ?>
	
	<input type="hidden" name="config" value="laravel-facebook">

	<?= Form::control('text', 'laravel-facebook[appId]', 'Application ID', Config::get('laravel-facebook::appId')) ?>
	
	<div class="form-actions">
		<div class="pull-left">
			<button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button>
			<a href="<?= action('UserController@index') ?>" class="btn">Cancel</a>
		</div>
	</div>

<?= Form::close() ?>