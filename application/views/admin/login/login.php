<form action="/admin/login" method="post" id="login_form" class="col-sm-6 col-sm-offset-3">
	<fieldset>
		<legend>Login</legend>
		
		<div class="form-group">
			<label>Username:</label>
			<input name="username" class="form-control">
		</div>
		
		<div class="form-group">
			<label>Password:</label>
			<input type="password" name="password" class="form-control">
		</div>
		
		<div class="form-group submit">
			<input type="submit" value="Login" class="btn btn-primary btn-lg">
			<p><a href="/admin/forgot_password">Forgot Password?</a></p>
		</div>
	</fieldset>
</form>