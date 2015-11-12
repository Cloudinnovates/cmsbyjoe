<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

function is_good_url($url)
{
    $status = FALSE;
    
    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		//curl_setopt($ch, CURLOPT_HEADER, true);
		//curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$ret = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		
		if ($info['http_code'] == 200)
		{
				$status = TRUE;
		}
    return $status;
}


// End of file: MY_url_helper.php
// Location: ./application/helpers/MY_url_helper.php 