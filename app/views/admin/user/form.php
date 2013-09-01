<?= HTML::page_header($header) ?>

<?= HTML::flash() ?>

<?php

if(isset($user)): ?>
    <?= Form::model($user, array('url' => array('admin/users/'.$user->id), 'method' => 'PUT', 'class' => 'form-horizontal')) ?>
<?php else: ?>
    <?= Form::open(array('url' => array('admin/users'), 'method' => 'POST', 'class' => 'form-horizontal')) ?>
<?php endif; ?>

    <?= Form::control('email', 'email', 'Email') ?>

    <? if(isset($user)): ?>
        <?= Form::control('password', 'password')->with('help', 'Leave empty to remain unchanged') ?>
        <?= Form::control('static', 'created_at', 'Date created') ?>
        <?= Form::control('static', 'updated_at', 'Last Edit') ?>
    <? else: ?>
        <?= Form::control('password', 'password') ?>
    <? endif ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <hr>
            <button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button>
            <a href="<?= action('Admin\\UserController@index') ?>" class="btn btn-link">Cancel</a>
        </div>
    </div>

<?= Form::close() ?>
