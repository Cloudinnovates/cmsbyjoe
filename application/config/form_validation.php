<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

$config = array(
		// !login
		'login' => array(
				array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'), 
				array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
		),
		
		// !page_add_edit
		'page_add_edit' => array(
				array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'), 
				array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required')
		),
		
		// !contact_form
		'contact_form' => array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'), 
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'), 
				array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim'), 
				array('field' => 'comments', 'label' => 'Comments', 'rules' => 'trim'),
				array('field' => 'g-recaptcha-response', 'label' => 'Captcha', 'rules' => 'callback_recaptcha')
		), 
		
		// !articles_add_edit
		'articles_add_edit' => array(
				array('field' => 'headline', 'label' => 'Headline', 'rules' => 'trim|required'), 
				array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required')
		),  
		
		// !user_add
		'user_add' => array(
				array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'), 
				array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'), 
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|callback_check_email'), 
				array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required|callback_check_username'), 
				array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'), 
				array('field' => 'password_conf', 'label' => 'Password Confirmation', 'rules' => 'trim|required|matches[password]') 
				//array('field' => 'role', 'label' => 'Role', 'rules' => 'trim|required')
		), 
		
		// !user_edit
		'user_edit' => array(
				array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'), 
				array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required'), 
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email'),   
				array('field' => 'password', 'label' => 'Password', 'rules' => 'trim'), 
				array('field' => 'password_conf', 'label' => 'Password Confirmation', 'rules' => 'trim|matches[password]')
		), 

		// !forgot_password
		'forgot_password' => array(
				array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback_check_email')
		), 


		'review_form' => array(
				array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'), 
				array('field' => 'review', 'label' => 'Testimonial', 'rules' => 'trim|required')
		)
);


/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */