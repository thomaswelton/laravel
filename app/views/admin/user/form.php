<?= HTML::page_header($header) ?>

<?= HTML::flash() ?>

<div class="row">
    <?php if(isset($user)): ?>
        <?= Form::model($user, array('url' => array('admin/users/'.$user->id), 'method' => 'PUT', 'class' => 'form-horizontal col-sm-8')) ?>
    <?php else: ?>
        <?= Form::open(array('url' => array('admin/users'), 'method' => 'POST', 'class' => 'form-horizontal col-sm-8')) ?>
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
    <?php if(isset($user)): ?>
        <div class="col-sm-3 col-sm-offset-1">
            <img src="<?= $user->getAvatar(320) ?>" alt="<?= $user->name ?>" class="img-circle img-responsive hidden-xs">
        </div>
    <?php endif; ?>
</div>

<?php if(isset($user)): ?>

    <br>
    <hr>
    <h2>Linked Accounts</h2>
    <br>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-valign-middle table-fixed" valign="middle">
            <tr>
                <th width="100">Provider</th>
                <th>Access Token</th>
                <th width="150">Expiry</th>
                <th class="text-center text-muted" width="150">Actions</th>
            </tr>

            <? foreach ($oauthProviders as $provider): ?>
                <tr>
                    <td><?= Str::studly($provider) ?></td>
                    <td><? if(is_object($user->$provider) && !is_null($user->$provider->access_token)) echo $user->$provider->access_token ?></td>
                    <td><? if(is_object($user->$provider) && !is_null($user->$provider->expire_time)) echo $user->$provider->expire_time->diffForHumans() ?></td>
                    <td width=10 class="row-action">
                        <? if(is_object($user->$provider)): ?>
                            <?= Form::open(array('url' => array('oauth/' . $provider), 'method' => 'DELETE', 'class' => 'form-horizontal')) ?>
                                <input type="hidden" name="redirect" value="<?= Request::url() ?>">
                                <button type="submit" name="action" value="delete" class="btn btn-block btn-danger">Delete Link</button>
                            <?= Form::close() ?>
                        <? else: ?>
                            <a href="<?= OAuth::associate($provider)->redirect(Request::url()) ?>" class="btn btn-block btn-primary">Link to <?= Str::studly($provider) ?></a>
                        <? endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>
