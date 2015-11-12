<?php
if ($this->uri->segment(2) == 'edit')
{
		$action = 'edit/' . $id;
		$form = $query->row();
		$title = 'Edit a User';
}
else
{
		$action = 'add';
		$title = 'Add a New User';
}
?>

<h1><?php echo $title; ?></h1>

<?php echo form_open('admin_users/' . $action, array('id' => 'page_form')); ?>
	
	<?php
	if (validation_errors())
	{
			echo '<div class="form_error">';
			echo '<h4>There was a problem submitting your inquiry</h4>';
			echo '<ul>' . validation_errors() . '</ul>';
			echo '<p>Please correct the fields and re-submit your inquiry.</p>';
			echo '</div>';
	}
	?>

	<?php if (isset($form->id)) : ?>
			<input type="hidden" name="id" value="<?php echo $form->id; ?>">
	<?php endif; ?>

	<fieldset>
		<legend>User Information</legend>
		
		<div class="form-group">
			<label for="first_name">First Name: </label>
			<input type="text" name="first_name" class="form-control" value="<?php echo (isset($form)) ? $form->first_name : set_value('first_name'); ?>"> 
		</div>
		
		<div class="form-group">
			<label for="last_name">Last Name: </label>
			<input type="text" name="last_name" class="form-control" value="<?php echo (isset($form)) ? $form->last_name : set_value('last_name'); ?>"> 
		</div>
		
		<div class="form-group">
			<label for="email">Email: </label>
			<input type="email" name="email" class="form-control" value="<?php echo (isset($form)) ? $form->email : set_value('email'); ?>"> 
		</div>	
	</fieldset>
	
	<fieldset>
		<legend>User Credentials</legend>
		
		<?php if ($this->uri->segment(2) == 'add') : ?>
		<div class="form-group">
			<label for="username">Username: </label>
			<input type="text" name="username" class="form-control" value="<?php echo (isset($form)) ? $form->username : set_value('username'); ?>"> 
		</div>
		<?php elseif ($this->uri->segment(2) == 'edit') : ?>
		<div class="form-group">
			<label for="username">Username: </label>
			<input type="text" name="username" class="form-control" disabled="disabled" value="<?php echo (isset($form)) ? $form->username : set_value('username'); ?>"> 
		</div>
		<?php endif;  ?>

		<!--
		<div>
			<label for="role">Role: </label>
			<select name="role">
				<option value="user"<?php check_select((isset($form)) ? $form->role : set_value('role'), 'user'); ?>>User/Guest</option>
				<option value="admin"<?php check_select((isset($form)) ? $form->role : set_value('role'), 'admin'); ?>>Administrator</option>
			</select>
		</div>
		-->		
	</fieldset>
	
	<fieldset>
	<?php if ($this->uri->segment(2) == 'add') : ?>
		<legend>Password</legend>
		<div class="form-group">
			<label for="password">Password: </label>
			<input type="password" name="password" class="form-control" value="<?php echo (isset($form)) ? $form->password : set_value('password'); ?>"> 
		</div>
		
		<div class="form-group">
			<label for="password_conf">Confirm Password: </label>
			<input type="password" name="password_conf" class="form-control" value="<?php echo (isset($form)) ? $form->password : set_value('password'); ?>"> 
		</div>
		<?php else : ?>	
		
				<?php if ($form->id == $this->session->userdata('user_id')) : ?>
						<legend>Change Password?</legend>	
						<p class="help-block"><em>Leave blank if you're not changing the password.</em></p>
						<div class="form-group">
							<label for="password">New Password: </label>
							<input type="password" name="password" class="form-control" value=""> 
						</div>
						
						<div class="form-group">
							<label for="password_conf">Confirm Password: </label>
							<input type="password" name="password_conf" class="form-control" value=""> 
						</div>				
				<?php endif; ?>
		
		<?php endif; ?>
	</fieldset>
	
	<fieldset>
		<legend>Save Changes</legend>			
		
		<div class="submit form-group">
			<input type="submit" value="Save" class="btn btn-primary btn-lg">
		</div>
	</fieldset>
	
</form>