<?= Form::open(array('url' => 'admin/login', 'class' => 'login-form form-horizontal span8 offset2')) ?>
	<fieldset>
		<legend>Login</legend>
		
		<?= HTML::flash() ?>

		<div class="control-group">
		  	<label class="control-label" for="username">Email/Username:</label>
		 	<div class="controls">
				<input type="text" name="username" value="" id="username">
		  	</div>
		</div>

		<div class="control-group">
		  	<label class="control-label" for="password">Password:</label> 
		 	<div class="controls">
				<input type="password" name="password" value="" id="password">
		  	</div>
		</div>
		  
			<div class="control-group">
				<div class="controls">	
				<label class="checkbox">
		  			Remember Me<input type="checkbox" name="remember" value="1" id="remember">
				</label>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" name="submit" class="btn btn-primary">Login</button>
		</div>
	</fieldset>
<?= Form::close() ?>
