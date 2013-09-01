<?= Form::open(array('url' => array('admin/config'), 'method' => 'POST', 'class' => 'form-horizontal')) ?>

    <input type="hidden" name="config" value="site">

    <?= Form::control('checkbox', 'site[protected]', 'Password Protected', Config::get('site::protected')) ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button>
            <a href="<?= url('admin/config/laravel-google-analytics') ?>" class="btn">Cancel</a>
        </div>
    </div>

<?= Form::close() ?>
