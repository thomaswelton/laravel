<?= Form::open(array('url' => 'login', 'class' => 'login-form form-horizontal col-md-8 col-md-offset-2')) ?>
    <fieldset>
        <legend>Password protected</legend>

        <?= HTML::flash() ?>

        <div class="form-group">
              <label class="col-sm-2 control-label" for="email">Email:</label>
             <div class="col-sm-6">
                <input type="text" name="email" value="" id="email" class="form-control">
              </div>
        </div>

        <div class="form-group">
              <label class="col-sm-2 control-label" for="password">Password:</label>
             <div class="col-sm-6">
                <input type="password" name="password" value="" id="password" class="form-control">
              </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="1"> Remember me
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </fieldset>
<?= Form::close() ?>
