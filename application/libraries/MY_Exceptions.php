<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class MY_Exceptions extends CI_Exceptions {

    function My_Exceptions()
    {
        parent::CI_Exceptions();
    }

    function log_exception($severity, $message, $filepath, $line)
    {   
    		$CI =& get_instance();
    		
        $severity = ( ! isset($CI->levels[$severity])) ? $severity : $CI->levels[$severity];

        log_message('error', 'Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line, TRUE);

        $CI->load->library('email');
        $CI->email->from('joe@sitesbyjoe.com', 'Joe Taylor');
        $CI->email->to('joe@sitesbyjoe.com');
        $CI->email->subject('Uh Oh! Website Error Message!');
        $CI->email->message('Severity: '.$severity.'  --> '.$message. ' '.$filepath.' '.$line);
        $CI->email->send();
    }

}

/* End of File: MY_Exceptions.php */
/* Location: ./application/libraries/MY_Exceptions.php */