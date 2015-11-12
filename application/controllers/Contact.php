<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Contact extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
				$this->load->library('email');
		}
		
		function index()
		{								
				if ($this->form_validation->run('contact_form') == FALSE)
				{
						$data['title'] = 'Contact ' . $this->config->item('company_name');
						
						$data['content_type'] = 'static';
						$data['layout'] = '1_col';
						$data['content'] = array(
								'public/contact/contact_form'
						);
						$data['sidebar'] = TRUE;
						$data['sidebars'] = array(
							'sales',
							'rentals'
						);

						// load and go
						$this->load->view('templates/subpage', $data);
				}
				else
				{
						$name = $this->input->post('name');
						$email = $this->input->post('email');
						$phone = $this->input->post('phone');
						$comments = $this->input->post('comments');
						$add = $this->input->post('add');
						
						// send email address and name to mailbuild
						if ($add == 'yes')
						{
								$mb_url = $this->config->item('mailbuild_url') . '?' . $this->config->item('mailbuild_email') . '=' . $email . '&' . $this->config->item('mailbuild_name') . '=' . $name;
								$curl = curl_init();
								curl_setopt($curl, CURLOPT_URL, $mb_url);
								curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
								$html = curl_exec($curl);
								curl_close ($curl);
						}
						
						// email
						$this->email->initialize(array(
							'protocol' => 'smtp',
							'smtp_host' => $this->config->item('mail_server'),
							'smtp_user' => $this->config->item('mail_username'),
							'smtp_pass' => $this->config->item('mail_password'),
							'wordwrap' => TRUE
						));
							
						$this->email->from('mark@mmavalon.com');
						$this->email->reply_to($email);
						$this->email->to($this->config->item('company_email'));
						$this->email->bcc('joe@sitesbyjoe.com');
						$this->email->subject($this->config->item('site_name') . ' Contact Form');
						
						$body = "Inquiry Results \n";
						$body .= "------------------------------------------\n";
						$body .= "Name: $name \n";
						$body .= "Email: $email \n";
						$body .= "Phone: $phone \n";
						$body .= "Comments: $comments";		
						
						$this->email->message($body);
							
						if ( $this->email->send() )
						{
								//$this->session->set_flashdata('message', 'Thanks for contacting us!');
								redirect('pages/thanks');
						}
						else
						{
								echo $this->email->print_debugger();
						}
				}
		}

		public function list_w_mark()
		{
				if ($this->form_validation->run('list_w_mark') == FALSE)
				{
						// show form
						$data['content_type'] = 'static';
						$data['content'] = array(
								'public/list_w_mark'
						);

						$data['articles'] = $this->Posts_model->get_all_posts();				

						$data['sidebar'] = TRUE;
						$data['sidebars'] = array(
								'contact',
								'articles'
						);
						$this->load->view('templates/subpage', $data);
				}
				else
				{
						// process our form
						$data = array(
								'name' => $this->input->post('name'),
								'email' => $this->input->post('email'),
								'property' => $this->input->post('property'),
								'comments' => $this->input->post('comments'),
								'add' => $this->input->post('add')
						);

						// send email address and name to mailbuild
						if ($data['add'] == 'yes')
						{
								$mb_url = $this->config->item('mailbuild_url') . '?' . $this->config->item('mailbuild_email') . '=' . $data['email'] . '&' . $this->config->item('mailbuild_name') . '=' . $data['name'];
								$curl = curl_init();
								curl_setopt($curl, CURLOPT_URL, $mb_url);
								curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
								$html = curl_exec($curl);
								curl_close ($curl);
						}
						
						// email
						$this->load->library('email');
						$this->email->initialize(array(
							'protocol' => 'smtp',
							'smtp_host' => $this->config->item('mail_server'),
							'smtp_user' => $this->config->item('mail_username'),
							'smtp_pass' => $this->config->item('mail_password'),
							'wordwrap' => TRUE
						));
							
						$this->email->from('mark@mmavalon.com');
						$this->email->reply_to($data['email']);
						$this->email->to($this->config->item('company_email'));
						$this->email->bcc('joe@sitesbyjoe.com');
						$this->email->subject($this->config->item('site_name') . ' Listing Request Form');
						
						$body = "Inquiry Results \n";
						$body .= "------------------------------------------\n";
						$body .= "Name: " . $data['name'] . "\n";
						$body .= "Email: " . $data['email'] . "\n";
						$body .= "Property: " . $data['property'] . "\n";
						$body .= "Comments: " . $data['comments'];		
						
						$this->email->message($body);
							
						if ( $this->email->send() )
						{
								//$this->session->set_flashdata('message', 'Thanks for contacting us!');
								redirect('pages/thanks');
						}
						else
						{
								echo $this->email->print_debugger();
						}
				}
		}

		// using this as part of the server side validation
		public function recaptcha($str)
		{
				$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $this->config->item('captcha_private_key') . '&response=' . $str;

				//open connection
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				$result = json_decode($result);
				curl_close($ch);

				if ($result->success == TRUE)
				{
						return TRUE;
				}
				else
				{
						$this->form_validation->set_message('recaptcha', 'The Captcha was not completed or incorrect');
						return FALSE;
				}
		}

}


/* End of File: contact.php */
/* Location: ./application/controllers/contact.php */