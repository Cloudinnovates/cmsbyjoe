<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * Extends CI's pagination class (http://codeigniter.com/user_guide/libraries/pagination.html)
 * It sets some variables for configuration of the pagination class dynamically,
 * depending on the URI, so we don't have to substract the offset from the URI,
 * or set $config['base_url'] and $config['uri_segment'] manually in the controller
 * 
 * Here is what is set by this extension class:
 * 1. $this->offset - the current offset
 * 2. $this->uri_segment - the URI segment to be used for pagination
 * 3. $this->base_url - the base url to be used for pagination
 * (where $this refers to the pagination class)
 *
 * The way this works is simple:
 * Drop this library in folder application/libraries
 * If we use pagination, it must ALWAYS follow the following syntax and be
 * located at the END of the URI:
 * PAGINATION_SELECTOR/offset
 * E.g. http://www.example.com/controller/action/Page/2
 *
 * The PAGINATION_SELECTOR is a special string which we know will ONLY be in the
 * URI when paging is set. Let's say the PAGINATION_SELECTOR is 'Page' (since most
 * coders never use any capitals in the URI, most of the times any string with
 * a single capital character in it will suffice). The PAGINATION_SELECTOR is
 * set in the general config file,
 * in the following index: $CI->config->item('pagination_selector')
 *
 * Example use (in controller):
 * // Set pagination and get pagination HTML
 * $this->data['pagination'] = $this->pagination->get_pagination($this->db->count_all_results('my_table'), 10);
 *
 * // Retrieve paginated results, using the dynamically determined offset
 * $this->db->limit($config['per_page'], $this->pagination->offset);
 * $query = $this->db->get('my_table');
 * 
 * @name MY_Pagination.php
 * @version 1.0
 * @author Joost van Veen
 * played with and extended by Joseph R. B. Taylor
 */
class MY_Pagination extends CI_Pagination
{
    
    /**
     * Pagination offset.
     * @var integer
     */
    public $offset = 0;
    public $num_links = 8;
    public $per_page = 20;
    
    /**
     * Pagination selector to be used in URI. Make sure to set this to a value 
     * that is never used elsewhere in the URI.
     * @var string
     */
    public $pagination_selector = '';
    
    //Customizing the First Link
		public $first_link = 'First'; //The text you would like shown in the "first" link on the left.
		public $first_tag_open = '<span class="first_link">'; //The opening tag for the "first" link.
		public $first_tag_close = '</span> '; //The closing tag for the "first" link.
		
		//Customizing the Last Link
		public $last_link = 'Last'; //The text you would like shown in the "last" link on the right.
		public $last_tag_open = '<span class="last_link">'; //The opening tag for the "last" link.
		public $last_tag_close = '</span> '; //The closing tag for the "last" link.
		
		//Customizing the "Next" Link
		public $next_link = 'Next'; //The text you would like shown in the "next" page link.
		public $next_tag_open = '<span class="next_link">'; //The opening tag for the "next" link.
		public $next_tag_close = '</span> '; //The closing tag for the "next" link.
		
		//Customizing the "Previous" Link
		public $prev_link = 'Prev'; //The text you would like shown in the "previous" page link.
		public $prev_tag_open = '<span class="prev_link">'; //The opening tag for the "previous" link.
		public $prev_tag_close = '</span> '; //The closing tag for the "previous" link.
		
		//Customizing the "Current Page" Link
		public $cur_tag_open = '<span class="current_link">'; //The opening tag for the "current" link.
		public $cur_tag_close = '</span> '; //The closing tag for the "current" link.
		
		//Customizing the "Digit" Link
		public $num_tag_open = '<span>'; //The opening tag for the "digit" link.
		public $num_tag_close = '</span> '; //The closing tag for the "digit" link.
   
   	// wrapping the pagination links in a div for safekeeping
    public $full_tag_open = '<div class="pagination_links">'; //The opening tag placed on the left side of the entire result.
		public $full_tag_close = '</div>'; //The closing tag placed on the right side of the entire result.   

    function __construct()
    {
        parent::__construct();
        
        $CI = & get_instance();
        
        log_message('debug', "MY_Pagination Class Initialized");
        
        if ($CI->config->item('pagination_selector') == '') 
        {
            show_error('config->item(\'pagination_selector\') is not set. Set config->item(\'pagination_selector\') in a config file, or $this->pagination->$this->pagination_selector');
        }
        else 
        {
            $this->pagination_selector = $CI->config->item('pagination_selector');
        }
        
        $this->_set_pagination_offset();
    }

    /**
     * Return HTML for pagination, based on count ($total_rows) and limit ($per_page)
     * @param integer $total_rows
     * @param integer $per_page
     * @return string
     */
    public function get_pagination($total_rows, $per_page)
    {
        if ($total_rows > $per_page) 
        {
            $CI = & get_instance();
            $this->initialize(array('total_rows' => $total_rows, 'per_page' => $per_page));
            return $this->create_links();
        }
    }
    
    // Build a results string (e.g. viewing 1 to 20 of 100 items)
    public function get_results_message($results, $total)
    {				
    		$str = FALSE;
    		
				$from = ($this->offset + 1);
				$to = ($this->per_page > $results) ? ($this->offset + $results) : ($this->offset + $this->per_page);

				if ($from)
    		{
    				$str = "Viewing $from to $to of $total";
    		}

    		return $str;		
    }

    /**
     * Set dynamic pagination variables in $CI->data['pagvars']
     * @return void
     */
    private function _set_pagination_offset()
    {     
        // Instantiate the CI super object so we can use the uri class
        $CI = & get_instance();
        
        // Store pagination offset if it is set
        if (strstr($CI->uri->uri_string(), $this->pagination_selector)) {
            
            // Get the segment offset for the pagination selector
            $segments = $CI->uri->segment_array();
            
            // Loop through segments to retrieve pagination offset
            foreach ($segments as $key => $value) {
                
                // Find the pagination_selector and work from there
                if ($value == $this->pagination_selector) {
                    
                    // Store pagination offset
                    $this->offset = $CI->uri->segment($key + 1);
                    
                    // Store pagination segment
                    $this->uri_segment = $key + 1;
                    
                    // Set base url for paging. This only works if the
                    // pagination_selector and paging offset are AT THE END of
                    // the URI!
                    $uri = $CI->uri->uri_string();
                    $pos = strpos($uri, $this->pagination_selector);
                    $this->base_url = $CI->config->item('base_url') . substr($uri, 0, $pos + strlen($this->pagination_selector));
                }
            }
        }
        else 
        {
            // Pagination selector was not found in URI string. So offset is 0
            $this->offset = 0;
            $this->uri_segment = 0;
            $this->base_url = $CI->config->item('site_url') . substr($CI->uri->uri_string(), 1) . '/' . $this->pagination_selector;
        }
    }

}  


/* End of File: my_pagination.php */
/* Location: ./system/application/libraries/MY_pagination.php */