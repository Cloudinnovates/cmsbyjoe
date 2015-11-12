<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Testimonials extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
		}
		
		function index()
		{
				$data['title'] = 'Testimonials for ' . $this->config->item('company_name');
				
				$data['content_type'] = 'static';
				$data['reviews'] = $this->Reviews_model->get_all_reviews();
				$data['articles'] = $this->Posts_model->get_all_posts();
				
				$data['content'] = array(
						'public/reviews/reviews'
				);

				$data['sidebar'] = TRUE;
				$data['sidebars'] = array(
						'sales',
						'articles'
				);
				
				// load and go
				$this->load->view('templates/subpage', $data);
		}

}


/* End of File: contact.php */
/* Location: ./application/controllers/contact.php */