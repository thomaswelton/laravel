<h1>Reset password</h1>

<p class="lead">To reset your password, enter your reset code and the new password you'd like to use</p>


<?= Form::open(array('url' => Request::url(), 'class' => 'login-form form-horizontal col-md-8 col-md-offset-2', 'autocomplete' => 'off')) ?>
    <fieldset>
        <?= HTML::flash() ?>

        <div class="form-group <? if($errors->has('code')) echo 'has-error' ?>">
            <label class="col-sm-2 control-label" for="code">Reset Code:</label>
            <div class="col-sm-6">
                <?= Form::text('code', null, array('id' => 'code', 'class' => 'form-control', 'placeholder' => 'Password reset code')) ?>
                <? if($errors->has('code')) echo $errors->first('code', '<span class="help-block">:message</span>') ?>
            </div>
        </div>

        <div class="form-group <? if($errors->has('email')) echo 'has-error' ?>">
            <label class="col-sm-2 control-label" for="code">Email:</label>
            <div class="col-sm-6">
                <?= Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email Address')) ?>
                <? if($errors->has('email')) echo $errors->first('email', '<span class="help-block">:message</span>') ?>
            </div>
        </div>

        <div class="form-group <? if($errors->has('password')) echo 'has-error' ?>">
            <label class="col-sm-2 control-label" for="password">Password:</label>
            <div class="col-sm-6">
                <?= Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')) ?>
                <? if($errors->has('password')) echo $errors->first('password', '<span class="help-block">:message</span>') ?>
            </div>
        </div>

        <div class="form-group <? if($errors->has('password_confirmation')) echo 'has-error' ?>">
            <div class="col-sm-6 col-sm-offset-2">
                <?= Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Confirm Password')) ?>
                <? if($errors->has('password_confirmation')) echo $errors->first('password_confirmation', '<span class="help-block">:message</span>') ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </div>
    </fieldset>
<?= Form::close() ?>
