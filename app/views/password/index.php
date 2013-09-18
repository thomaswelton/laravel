<h1>Forgot password</h1>

<p class="lead">If you've forgotten your password enter your registered email address below to request that your password be reset</p>


<?= Form::open(array('url' => Request::url(), 'class' => 'login-form form-horizontal col-md-8 col-md-offset-2')) ?>
    <fieldset>
        <?= HTML::flash() ?>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="email">Email:</label>
            <div class="col-sm-6">
                <input type="text" name="email" value="" id="email" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary">Request Reset</button>
            </div>
        </div>
    </fieldset>
<?= Form::close() ?>
