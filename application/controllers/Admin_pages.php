<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin_pages extends CI_Controller {
	
		function __construct()
		{
				parent::__construct();
				
				// auth check
				$this->load->library('Erkanaauth');
				if ( ! $this->erkanaauth->try_session_login()) 
				{
						// you're outta here!
						redirect('admin/login');
				}
	
		}
	
		function index()
		{			
				$data['query'] = $this->Pages_model->get_all_pages();
				$data['parent_pages'] = $this->Pages_model->get_parent_pages();
				$data['content'] = array(
						'admin/pages/list'
				);
				
				$this->load->view('templates/admin', $data);
		}
		
		function update_order()
		{
				$sort_order = $this->input->post('sort_order');
				$id_array = explode(',', $sort_order);
				$counter = 0;
				foreach($id_array as $id)
				{
						$counter ++;
						$updated_rows = 0;
						echo 'affected rows: ' . $this->Pages_model->update_sort_order($id, $counter) . ' ';					
				}
		}

		function add()
		{		
				if ($this->form_validation->run('page_add_edit') == FALSE)
				{				
						$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
						
						$data['heading'] = 'Create a new Page';
						$data['description'] = 'Use this form to add a new page to the site.';
						$data['content'] = array(
								'admin/pages/add_edit'
						);
						// load the view and populate it
						$this->load->view('templates/admin', $data);
				}
				else
				{
						// We submitted and the data passed the tests, lets collect it
						$data['title'] = $this->input->post('title');
						$data['slug'] = $this->input->post('slug');
						$data['description'] = $this->input->post('description');
						$data['keywords'] = $this->input->post('keywords');
						//
						$data['content'] = $this->input->post('content');
						$data['status'] = $this->input->post('status');					
						//$data['section'] = implode(',', $this->input->post('section'));
						$data['parent_page'] = $this->input->post('parent_page');
						$data['heading'] = $this->input->post('heading');
						$data['opener'] = $this->input->post('opener');
						$data['menu_label'] = $this->input->post('menu_label');
						$data['menu_section'] = $this->input->post('menu_section');
						$data['layout'] = $this->input->post('layout');
						// $data['widgets'] = (is_array($this->input->post('widgets'))) ? implode(',', $this->input->post('widgets')) : $this->input->post('widgets');
						// Load our model and save our data
						$this->load->model('Pages_model');
						$this->Pages_model->insert_page($data);
						// Return to the "Pages" master page
						redirect('admin_pages');
				}
		}
		
		function edit()
		{
				if ($this->form_validation->run('page_add_edit') == FALSE)
				{
						// We either failed submission or we haven't submitted yet
						$data['id'] = $this->uri->segment(3);
						$this->load->model('Pages_model');
						$data['query'] = $this->Pages_model->get_page_by_id($data['id']);					
						$data['heading'] = 'Edit a Page';
						$data['description'] = 'Use this form to update the content of the page.';
						$data['content'] = array(
								'admin/pages/add_edit'
						);
						// load our view and populate it
						$this->load->view('templates/admin', $data);
				}
				else
				{
						// We submitted and passed, so lets do our db update
						$id = $this->input->post('id');
						$data['title'] = $this->input->post('title');
						$data['slug'] = $this->input->post('slug');
						$data['description'] = $this->input->post('description');
						$data['keywords'] = $this->input->post('keywords');
						//
						$data['content'] = $this->input->post('content');
						$data['status'] = $this->input->post('status');		
						//$data['section'] = implode(',', $this->input->post('section'));		
						$data['parent_page'] = $this->input->post('parent_page');	
						$data['heading'] = $this->input->post('heading');
						$data['opener'] = $this->input->post('opener');
						$data['menu_label'] = $this->input->post('menu_label');
						$data['menu_section'] = $this->input->post('menu_section');
						$data['layout'] = $this->input->post('layout');
						//$data['widgets'] = (is_array($this->input->post('widgets'))) ? implode(',', $this->input->post('widgets')) : $this->input->post('widgets');
						$this->Pages_model->update_page($id, $data);
						// Return to master page
						redirect('admin_pages');
				}
		}
		
		function update_page_status()
		{
				// ajax status updates - nice!
				$id = $this->input->post('id');
				if ($id > 0)
				{
						$this->db->where('id', $id);
						$old_status = $this->db->get('pages')->row()->status;
						$new_status = ($old_status == 1) ? 0 : 1;
						$record = array('status' => $new_status);
						$this->db->where('id', $id);
						$this->db->update('pages', $record);
						echo $new_status;
				}
				
		}
		
		function delete()
		{
				$id = $this->uri->segment(3);
				$this->Pages_model->delete_page($id);			
				redirect('admin_pages');
		}
		
		function delete_file()
		{
				// check our uri segments (could be a varying number starting at 3 / 10 should be plenty
				$segments = array();
				for ($i = 3; $i < 10; $i++)
				{
						if (strlen($this->uri->segment($i)) > 0)
						{
								//echo $i . $this->uri->segment($i) . '<br>';
								$segments[] = $this->uri->segment($i);
						}
				}
				$path = implode('/', $segments);
				$path = substr_replace($path, '.', -4, 1);
				if (unlink($path))
				{
						return TRUE;
				}
				else
				{
						return FALSE;
				}
		}
	
}


/* End of file admin_pages.php */
/* Location: ./system/application/controllers/admin_pages.php */