<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Pages extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
		}
		
		function _remap()
		{		
				$slug = $this->uri->segment(2);
				$data['slug'] = $slug;
				
				$data['pages'] = $this->Pages_model->get_page_by_slug($slug);
				$data['articles'] = $this->Posts_model->get_all_posts();		
					
				if ($data['pages']->num_rows() > 0)
				{
						$page = $data['pages']->row();
						$data['page'] = $page;
						$data['title'] = $page->title;
						$data['heading'] = $page->heading;
						$data['description'] = $page->description;
						$data['keywords'] = $page->keywords;		
						$data['content'] = $page->content;	
						$data['content_type'] = 'dynamic';	
						
						$data['sidebar'] = TRUE;
						$data['sidebars'] = array(
								'contact',
								'sales',
								'articles'
						);

						// load and go
						$this->load->view('templates/subpage', $data);
				}
				else
				{
						echo ' no page found! ';
				}
		}

}


/* End of file pages.php */
/* Location: ./system/application/controllers/pages.php */