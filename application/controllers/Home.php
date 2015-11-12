<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Home extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
		}
		
		function index()
		{
				$this->load->view('templates/homepage');
		}
		
		function test()
		{
				$this->load->view('templates/test');
		}
			
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */