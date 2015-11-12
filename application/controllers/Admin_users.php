<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin_users extends CI_Controller {
	
		function __construct()
		{
				parent::__construct();
				
				// auth check
				$this->load->library('Erkanaauth');
				if (! $this->erkanaauth->try_session_login()) 
				{
						redirect('admin/login');
				}
		}
		
		function test_role()
		{
				echo $this->erkanaauth->getRole();
		}
	
		function index()
		{
				$this->load->model('Users_model');
				$data['users'] = $this->Users_model->get_all_users();
				$data['content'] = array(
					'admin/users/list'
				);
				
				$this->load->view('templates/admin', $data);
		}
		
		function add()
		{
				if ($this->form_validation->run('user_add') == FALSE)
				{
						// show form
						//$data['heading'] = 'Add a New User';
						$data['content'] = array(
								'admin/users/add_edit'
						);						
						$this->load->view('templates/admin', $data);
				}
				else
				{
						// process our form
						$this->load->helper('security');
						$record['first_name'] = $this->input->post('first_name');
						$record['last_name'] = $this->input->post('last_name');
						$record['email'] = $this->input->post('email');
						$record['username'] = $this->input->post('username');
						$record['password'] = do_hash(trim($this->input->post('password')));
						$record['role'] = $this->input->post('role');

						$this->load->model('Users_model');
						
						if($this->Users_model->add_user($record))
						{						
								$id = $this->db->insert_id();
								//$this->history->log_event('add', 'added the user ' . $this->History_model->get_historical_username($id));
								$this->session->set_flashdata('message', 'User successfully added.');
						}
						else
						{
								$this->session->set_flashdata('messsage_type', 'error');
								$this->session->set_flashdata('message', 'An error occurred when trying to add this user.');
						}								
						redirect('admin_users');
				}
		}
		
		function edit()
		{
				if ($this->form_validation->run('user_edit') == FALSE)
				{
						// show form
						$this->db->where('id', $this->uri->segment(3));
						$data['query'] = $this->db->get('users');
						$data['id'] = $this->uri->segment(3);
						//$data['heading'] = 'Edit a User';
						$data['content'] = array(
								'admin/users/add_edit'
						);
						$this->load->view('templates/admin', $data);
				}
				else
				{
						// We submitted and passed, so lets do our db update
						$this->load->helper('security');
						$record['first_name'] = $this->input->post('first_name');
						$record['last_name'] = $this->input->post('last_name');
						$record['email'] = $this->input->post('email');
						$record['role'] = $this->input->post('role');
						
						if ($this->input->post('password') != '')
						{
								$record['password'] = dohash(trim($this->input->post('password')));
						}
						
						$id = $this->input->post('id');						
						
						$this->db->where('id', $id);
						$this->db->update('users', $record);
						
						//$this->history->log_event('edit', 'edited the user ' . $this->History_model->get_historical_username($id));
						$this->session->set_flashdata('message', 'User updated successfully.');
						redirect('admin_users');
				}
		}
		
		function delete()
		{
				// Admins and Superadmins can delete, but users can't
				//if ($this->erkanaauth->getRole() == 'user')
				//{
				//		$this->session->set_flashdata('message', 'Your account does not have the ability to DELETE.');
				//}
				//else
				//{
						//$user = $this->History_model->get_historical_username($this->uri->segment(3));
						
						$this->db->where('id', $this->uri->segment(3));
						$this->db->delete('users');
						
						//$this->history->log_event('delete', 'deleted the user ' . $user);
						$this->session->set_flashdata('message', 'User removed successfully');
				//}
				redirect('admin_users');
		}
						
		function reset_password()
		{
				// get email
				// delete password
				// generate new one (rand) and save hashed version in db
				// send it to email with link to login screen
		}
		
		function send_password()
		{
				$user_id = $this->uri->segment(3);
				
				$this->db->where('id', $user_id);
				$user = $this->db->get('users')->row();
				
				$this->load->library('email');
				// email
				$this->email->initialize(array(
					'protocol' => 'smtp',
					'smtp_host' => $this->config->item('mail_server'),
					'smtp_user' => $this->config->item('mail_username'),
					'smtp_pass' => $this->config->item('mail_password'),
					'wordwrap' => TRUE
				));
					
				$this->email->from('joe@sitesbyjoe.com');
				//$this->email->reply_to($email);		
				$this->email->to($user->email);
				$this->email->subject('Freehold Raceway Control Panel Password');
				
				$body = "Freehold Raceway Control Panel Login \n";
				$body .= "------------------------------------------\n";
				$body .= "Enclosed is your Freehold Raceway Control Panel Password. \n";
				$body .= "Password: $user-> \n";
				$body .= "Phone: $phone \n";
				$body .= "------------------------------------------\n";
				$body .= "Project Name: $project_name \n";
				$body .= "URL: $project_url \n";
				$body .= "Budget: $project_budget \n";
				$body .= "Timeline: $project_timeline \n";
				$body .= "Details: $project_details";			
				
				$this->email->message($body);
					
				if ( $this->email->send() )
				{
						redirect('admin_users');
				}
				else
				{
						echo $this->email->print_debugger();
				}
		}
		
		function check_username($str)
		{
				$this->db->where('username', $str);
				$query = $this->db->get('users');
				if ($query->num_rows() > 0)
				{
						$this->form_validation->set_message('check_username', 'This username is already being used.');
						return FALSE;
				}
				else
				{
						return TRUE;
				}
		}
		
		function check_email($str)
		{
				$this->db->where('email', $str);
				$query = $this->db->get('users');
				if ($query->num_rows() > 0)
				{
						$this->form_validation->set_message('check_email', 'This email is already being used.');
						return FALSE;
				}
				else
				{
						return TRUE;
				}
		}
		
}


/* End of file admin_users.php */
/* Location: ./application/controllers/admin_users.php */