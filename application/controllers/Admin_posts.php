<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin_posts extends CI_Controller {
	
	function __construct()
	{
			parent::__construct();
			
			$this->load->model('Posts_model');		
			// auth check
			$this->load->library('Erkanaauth');
			if (!$this->erkanaauth->try_session_login()) 
			{
					redirect('admin/login');
			}
	}

	function index()
	{	
			$data['query'] = $this->Posts_model->get_all_posts();					
			$data['content'] = array(
					'admin/blog/list'
			);
			
			$this->load->view('templates/admin', $data);
	}
	
	function add()
	{		
			if ($this->form_validation->run('articles_add_edit') == FALSE)
			{
					$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
						
					// We either failed submission or we haven't submitted yet
					//$data['form'] = $this->validation;
					$data['heading'] = 'Create a new Post';
					$data['description'] = 'Use this form to add a post to the site.';
					$data['content'] = array(
							'admin/blog/add_edit'
					);
					// load the view and populate it
					$this->load->view('templates/admin', $data);
			}
			else
			{
					// We submitted and the data passed the tests, lets collect it
					$data['datestamp'] = date('Y-m-d');
					$data['headline'] = $this->input->post('headline');
					$data['opener'] = $this->input->post('opener');
					$data['slug'] = $this->input->post('slug');
					$data['story'] = $this->input->post('story');
					// Load our model and save our data
					$this->load->model('Posts_model');
					$this->Posts_model->insert_post($data);
					
					$this->session->set_flashdata('message', 'Entry added successfully.');
					// Return to the master page
					redirect('admin_posts');
			}
	}
	
	function edit()
	{		
			if ($this->form_validation->run('articles_add_edit') == FALSE)
			{
					$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
						
					// We either failed submission or we haven't submitted yet
					//$data['form'] = $this->validation;
					$data['id'] = $this->uri->segment(3);
					$this->load->model('Posts_model');
					$data['query'] = $this->Posts_model->get_post_by_id($data['id']);					
					$data['heading'] = 'Edit a Post';
					$data['description'] = 'Use this form to update the post.';
					$data['content'] = array(
							'admin/blog/add_edit'
					);
					// load our view and populate it
					$this->load->view('templates/admin', $data);
			}
			else
			{
					// We submitted and passed, so lets do our db update
					$id = $this->input->post('id');
					$data['headline'] = $this->input->post('headline');
					$data['opener'] = $this->input->post('opener');
					$data['slug'] = $this->input->post('slug');
					$data['story'] = $this->input->post('story');
					//print_r($data);
					//break;			
					$this->load->model('Posts_model');
					$this->Posts_model->update_post($id, $data);
					
					$this->session->set_flashdata('message', 'Entry updated successfully.');
					// Return to master page
					redirect('admin_posts');
			}
	}
	
	function categories()
	{
			$data['categories'] = $this->Posts_model->get_blog_categories();
			$data['content'] = array(
					'admin/blog/categories'
			);
			// load our view and populate it
			$this->load->view('templates/admin', $data);
	}
	
	function comments()
	{
			$data['comments'] = $this->Posts_model->get_all_comments();
			$data['content'] = array(
					'admin/blog/comments'
			);
			// load our view and populate it
			$this->load->view('templates/admin', $data);
	}
	
	function update_post_status()
	{
			// ajax status updates - nice!
			$id = $this->input->post('id');
			if ($id > 0)
			{
					$this->db->where('id', $id);
					$old_status = $this->db->get('post')->row()->status;
					$new_status = ($old_status == 1) ? 0 : 1;
					$record = array('published' => $new_status);
					$this->db->where('id', $id);
					$this->db->update('posts', $record);
					echo $new_status;
			}
			
	}

	function delete_comment()
	{
			$id = $this->uri->segment(3);
			$this->Posts_model->delete_comment($id);
			$this->session->set_flashdata('message', 'Comment removed successfully.');
			redirect('admin_posts/comments');
	}
	
	function delete()
	{
			$id = $this->uri->segment(3);
			$this->db->where('id', $id);
			$this->db->delete('posts');			
			redirect('admin_posts');
	}
	
}


/* End of File: admin_posts.php */
/* Location: ./application/controllers/admin_posts.php */