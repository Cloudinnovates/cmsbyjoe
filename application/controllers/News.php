<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class News extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
				$this->load->model('Posts_model');
				$this->load->helper('typography');
				$this->load->helper('text');
				$this->load->helper('date');
		}
		
		function index()
		{						
				$data['articles'] = $this->Posts_model->get_all_posts();

				// Meta Data
				$data['title'] = 'Avalon &amp; Stone Harbor Real Estate Blog';
				$data['description'] = '';
				$data['keywords'] = '';
			
				// View
				$data['content_type'] = 'static';
				$data['content'] = array(
						'public/blog/article_list'
				);

				$data['sidebar'] = TRUE;
				$data['sidebars'] = array(
						'sales',
						'rentals'
				);
	
				// and GO
				$this->load->view('templates/subpage', $data);
				//$this->output->cache(60);
		}
		
		function detail()
		{
				$slug = $this->uri->segment(2);
				$data['articles'] = $this->Posts_model->get_recent_posts(8);
				
				// blog data
				$data['news'] = $this->Posts_model->get_post_by_slug($slug);
				$data['article_id'] = $data['news']->row()->id;

				// Meta Data
				$data['title'] = $data['news']->row()->headline;
				$data['description'] = '';
				$data['keywords'] = '';
			
				// View
				$data['content_type'] = 'static';
				$data['content'] = array(
						'public/blog/article_detail'
				);

				$data['sidebar'] = TRUE;
				$data['sidebars'] = array(
						'articles'
				);

				// and GO
				$this->load->view('templates/subpage', $data);
		}

}


/* End of file news.php */
/* Location: ./system/application/controllers/news.php */