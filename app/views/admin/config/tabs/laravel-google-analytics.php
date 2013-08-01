<?= Form::open(array('url' => array('admin/config'), 'method' => 'POST', 'class' => 'form-horizontal')) ?>
	
	<input type="hidden" name="config" value="laravel-google-analytics">

	<?= Form::control('text', 'laravel-google-analytics[id]', 'ID', Config::get('laravel-google-analytics::id')) ?>
	
	<div class="form-actions">
		<div class="pull-left">
			<button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button>
			<a href="<?= url('admin/config/laravel-google-analytics') ?>" class="btn">Cancel</a>
		</div>
	</div>

<?= Form::close() ?>