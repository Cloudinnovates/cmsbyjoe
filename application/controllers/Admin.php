<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin extends CI_Controller {
	
		function __construct()
		{
				parent::__construct();	
				$this->load->library('Erkanaauth');
		}
		
		function index()
		{								
				redirect('admin/login');
		}
		
		function login()
		{			
				if ($this->form_validation->run('login') == FALSE)
				{
						$data['heading'] = "Control Panel";
						$data['description'] = 'Manage your website content';
						$data['content'] = array(
								'admin/login/login'
						);
						$this->load->view('templates/login', $data);
				}
				else
				{		
						$this->load->helper('security');
						$username = $this->input->post('username');
			 			$password = do_hash(trim($this->input->post('password')));

					  if ($this->erkanaauth->try_login(array('username' => $username, 'password' => $password))) 
					  {
					    	$this->session->set_flashdata('message', 'You have logged in successfully.');
								redirect('admin_pages');
					  } 
					  else 
					  {
					    	// the login passed our rules but no user exists
								$this->session->set_flashdata('message', 'No matching user found.');
							  redirect('admin/login');
					  }				
				}
		}
		
		function logout() 		
		{
  			$this->erkanaauth->logout();
				$this->session->set_flashdata('message', 'You have logged out successfully.');
				redirect('admin/login');				
		}
			
		function dashboard()
		{
				if ($this->erkanaauth->try_session_login()) 
			  {
						redirect('admin_pages');
				}
				else
				{
						redirect('admin/login');
				}
		}		
		
		function password_cheat()
		{
				$this->load->helper('security');
				$password = do_hash($this->uri->segment(3));
				echo $password;				
		}
		
		function forgot_password()
		{
				if ($this->form_validation->run('forgot_password') == FALSE)
				{
						$data['heading'] = "Forgot your Password?";
						$data['description'] = 'Fill in your user account email address and we\'ll send you a new one.';
						$data['content'] = array(
								'admin/login/forgot_password'
						);
						$this->load->view('templates/login', $data);
				}
				else
				{		
						$email = $this->input->post('email');
						// make th enew password
						$length = 10;
    				$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    				$password = '';
				    for ($p = 0; $p < $length; $p++) 
				    {
				        $password .= $characters[mt_rand(0, strlen($characters) - 1)];
				    }
				    
				    // hash it and save
				    $this->load->helper('security');
				    $record['password'] = do_hash($password);				    
				    $this->db->where('email', $email);
				    $this->db->update('users', $record);
				    
				    // email
				    $this->load->library('email');
						$this->email->initialize(array(
							'protocol' => 'smtp',
							'smtp_host' => $this->config->item('mail_server'),
							'smtp_user' => $this->config->item('mail_username'),
							'smtp_pass' => $this->config->item('mail_password'),
							'charset' =>'iso-8859-1',
							'wordwrap' => TRUE
						));
							
						$this->email->from('joe@sitesbyjoe.com');		
						$this->email->to($email);
						$this->email->subject('Password Reset');
						
						$body = "We have received a request to have your user account password reset. \n";
						$body .= "-------------------------------------------------------------- \n";
						$body .= "New Account Password: $password \n\n";
						$body .= "Login at " . base_url() . "admin \n\n";
						$body .= "";
						
						$this->email->message($body);				  
						$this->email->message($body);
							
						if ( $this->email->send() )
						{
								$this->session->set_flashdata('message', "Your password has been sent to: $email");
				   			// send to login screen
				    		redirect('admin/login');
						}
						else
						{
								echo $this->email->print_debugger();
						}  				    
				}
		}
		
		function check_username($str)
		{
				$this->load->model('Users_model');
				$username_exists = $this->Users_model->username_exists($str);
				if ($username_exists)
				{
						// passes test
						return TRUE;
				}
				else
				{
						// fails test
						return FALSE;
				}
		}
		
		function _check_password()
		{}
		
}


/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */