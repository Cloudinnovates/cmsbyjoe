<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin_Reviews extends CI_Controller {
	
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
				$data['reviews'] = $this->Reviews_model->get_all_reviews();
				$data['content'] = array(
						'admin/reviews/list'
				);
				
				$this->load->view('templates/admin', $data);
		}
		
		function edit()
		{
				if ($this->form_validation->run('review_form') == FALSE)
				{
						$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
						
						$data['id'] = $this->uri->segment(3);
						
						$this->db->where('id', $data['id']);
						$data['form']  = $this->db->get('reviews')->row();
						
						$data['content'] = array(
								'admin/reviews/add_edit'
						);
						// load the view and populate it
						$this->load->view('templates/admin', $data);
				}
				else
				{
						$id = $this->input->post('id');
						
						$data = array(
							'name' => $this->input->post('name'),
							'review' => $this->input->post('review')
						);
						
						$this->db->where('id', $id);
						$this->db->update('reviews', $data);
						
						$photo_id = $id;

						if (count($_FILES) > 0 && !empty($_FILES['userfile']['type']))
						{
								$uploadDir = 'uploads/testimonials/';
						
								// get the file extension for our new file name - they can't all be jpg!
								$file_ext = strtolower(substr(strrchr($_FILES['userfile']['name'], '.'), 1));
								
								$picname = $photo_id . '.' . $file_ext;
								$path = $uploadDir . $picname;	
								$midsize_path = $uploadDir . $photo_id . '_mid.' . $file_ext;			
								
								$file = $_FILES['userfile'];
								$filename = $file['name'];
							
								if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) 
								{				
										// update the path				
										$data = array(
												'image_path' => $path
										);
										
										$this->db->where('id', $photo_id);
										$this->db->update('reviews', $data);
		
										// make a thumbnail of our photo
										$this->load->library('image_lib');
										$config['image_library'] = 'GD2';
										$config['source_image'] = $path;
										//echo $config['source_image'];
					
										$config['create_thumb'] = TRUE;
										$config['thumb_marker'] = '_tmb';
										$config['quality'] = '100%';
										$config['width'] = 200;
										$config['height'] = 150;				
										$this->image_lib->initialize($config);
										
										//print_r($this->image_lib);
										
										if ( ! $this->image_lib->resize())
										{
												echo $this->image_lib->display_errors();
										}
										
										$this->image_lib->clear();
										// make a mid-size version	
										$config['image_library'] = 'GD2';
										$config['source_image'] = $path;
										$config['create_thumb'] = FALSE;
										$config['new_image'] = $midsize_path;
										$config['quality'] = '100%';
										$config['height'] = 480;
										$config['width'] = 640;										
										$this->image_lib->initialize($config);
										$this->image_lib->resize();
										
										// move along
										redirect('/admin_reviews');
								}	
								else 
								{
										print "The upload did not take!  Here's some debugging info:\n";
										print_r($_FILES);
								}
						}
						
						redirect('admin_reviews');
				}
		}
		
		
		function add()
		{
				if ($this->form_validation->run('review_form') == FALSE)
				{
						$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

						$data['content'] = array(
								'admin/reviews/add_edit'
						);
						// load the view and populate it
						$this->load->view('templates/admin', $data);
				}
				else
				{
						$data = array(
							'name' => $this->input->post('name'),
							'review' => $this->input->post('review')
						);
						
						$this->db->insert('reviews', $data);
						
						$photo_id = $this->db->insert_id();

						if (count($_FILES) > 0 && !empty($_FILES['userfile']['type']))
						{
								$uploadDir = 'uploads/testimonials/';
						
								// get the file extension for our new file name - they can't all be jpg!
								$file_ext = strtolower(substr(strrchr($_FILES['userfile']['name'], '.'), 1));
								
								$picname = $photo_id . '.' . $file_ext;
								$path = $uploadDir . $picname;	
								$midsize_path = $uploadDir . $photo_id . '_mid.' . $file_ext;			
								
								$file = $_FILES['userfile'];
								$filename = $file['name'];
							
								if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) 
								{				
										// update the path				
										$data = array(
												'image_path' => $path
										);
										
										$this->db->where('id', $photo_id);
										$this->db->update('reviews', $data);
		
										// make a thumbnail of our photo
										$this->load->library('image_lib');
										$config['image_library'] = 'GD2';
										$config['source_image'] = $path;
										//echo $config['source_image'];
					
										$config['create_thumb'] = TRUE;
										$config['thumb_marker'] = '_tmb';
										$config['quality'] = '100%';
										$config['width'] = 200;
										$config['height'] = 150;				
										$this->image_lib->initialize($config);
										
										//print_r($this->image_lib);
										
										if ( ! $this->image_lib->resize())
										{
												echo $this->image_lib->display_errors();
										}
										
										$this->image_lib->clear();
										// make a mid-size version	
										$config['image_library'] = 'GD2';
										$config['source_image'] = $path;
										$config['create_thumb'] = FALSE;
										$config['new_image'] = $midsize_path;
										$config['quality'] = '100%';
										$config['height'] = 480;
										$config['width'] = 640;										
										$this->image_lib->initialize($config);
										$this->image_lib->resize();
										
										// move along
										redirect('/admin_reviews');
									
								}	
								else 
								{
										print "The upload did not take!  Here's some debugging info:\n";
										print_r($_FILES);
								}
						}
						redirect('admin_reviews');
				}
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
						echo 'affected rows: ' . $this->Reviews_model->update_sort_order($id, $counter) . ' ';					
				}
		}
		
		function delete()
		{
				$id = $this->uri->segment(3);

				$this->db->where('id', $id);
				$this->db->delete('reviews');
				
				redirect('admin_reviews');
		}
	
}


/* End of file admin_pages.php */
/* Location: ./system/application/controllers/admin_pages.php */