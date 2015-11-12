<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

echo form_open('admin/forgot_password', array('id="login_form'));

	if (validation_errors())
	{
			echo '<div class="form_error">';
			echo '<h4>There was a problem submitting your inquiry</h4>';
			echo '<ul>' . validation_errors() . '</ul>';
			echo '<p>Please correct the fields and re-submit your inquiry.</p>';
			echo '</div>';
	}
	
	echo form_fieldset('Enter your Email Address');
	
		$email = array('name' => 'email', 'value' => '');
		echo div_wrap(form_label('Email Address: ') . form_input($email));
		
		echo '<div class="submit">' . form_submit('submit', 'Reset') . ' ' . anchor('admin/login', 'Return to the Login Screen') . '</div>';
	
	echo form_fieldset_close();

echo form_close();


/* End of File: forgot_password.php */
/* Location: ./application/views/admin/login/forgot_password.php */