@extends('admin.layouts.default')

@section('content')
    <?= HTML::page_header($header) ?>

    <?= HTML::flash() ?>

    <div class="row">
        <?php if(isset($user)): ?>
            <?= Form::model($user, array('url' => array('admin/users/'.$user->id), 'method' => 'PUT', 'class' => 'form-horizontal col-sm-8', 'autocomplete' => 'off', 'data-validation-rules' => json_encode($rules))) ?>
        <?php else: ?>
            <?= Form::open(array('url' => array('admin/users'), 'method' => 'POST', 'class' => 'form-horizontal col-sm-8', 'autocomplete' => 'off', 'data-validation-rules' => json_encode($rules))) ?>
        <?php endif; ?>


            <fieldset>
                <legend>Details</legend>

                <?= Form::control('text', 'first_name', 'First Name') ?>
                <?= Form::control('text', 'last_name', 'Last Name') ?>
                <?= Form::control('email', 'email', 'Email') ?>

                <? if(isset($user)): ?>
                    <?= Form::control('password', 'password')->with('help', 'Leave empty to remain unchanged') ?>
                    <?= Form::control('static', 'created_at', 'Date created') ?>
                    <?= Form::control('static', 'updated_at', 'Last Edit') ?>
                <? else: ?>
                    <?= Form::control('password', 'password') ?>
                    <?= Form::control('password', 'password_confirmation', 'Confirm Password') ?>

                    <div class="col-sm-9 col-sm-offset-3">
                        <label class="checkbox-inline">
                            <?= Form::checkbox('notify', 1) ?>
                            <span title="Email this user with their login details" data-toggle="tooltip">Notify User</span>
                        </label>
                    </div>
                <? endif ?>

            </fieldset>

            <br>

            <fieldset>
                <legend>Permissions</legend>

                <div class="col-sm-3 control-label">
                    <b>User permissions</b>
                </div>

                <div class="col-sm-9">
                    <label class="checkbox-inline">
                        <? $superuserChecked = (isset($user)) ? $user->isSuperUser() : null ?>
                        <? $superuserAttributes = (Auth::user()->isSuperUser()) ? null : array('disabled' => true) ?>
                        <?= Form::checkbox('superuser', 1, $superuserChecked, $superuserAttributes) ?>
                        <span title="Super users have full access to the website, and can delete any other user" data-toggle="tooltip">Super User</span>
                    </label>

                    <? foreach($groups as $group): ?>
                        <label class="checkbox-inline">
                            <? if(isset($user)): ?>
                                <?= Form::checkbox('groups[]', $group->id, $user->inGroup($group)) ?>
                            <? else: ?>
                                <?= Form::checkbox('groups[]', $group->id) ?>
                            <? endif ?>

                            <?= Str::studly($group->name) ?>
                        </label>
                    <? endforeach ?>
                </div>

            </fieldset>

            <br>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
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
                                <?= Form::open(array('url' => array('admin/users/oauth/' . $user->id), 'method' => 'DELETE', 'class' => 'form-horizontal')) ?>

                                    <?= Form::hidden('provider', $provider) ?>

                                    <button type="submit" name="action" value="delete" class="btn btn-block btn-danger">Delete Link</button>
                                <?= Form::close() ?>
                            <? elseif($user->id == Auth::user()->id): ?>
                                <a href="<?= OAuth::associate($provider)->redirect(Request::url()) ?>" class="btn btn-block btn-primary">Link to <?= Str::studly($provider) ?></a>
                            <? endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    <?php endif; ?>
@stop
