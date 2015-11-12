<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Admin_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        // auth check
				$this->load->library('Erkanaauth');
				if ( ! $this->erkanaauth->try_session_login()) 
				{
						redirect('admin/login');
				}
    }
}


/* End of File: Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */