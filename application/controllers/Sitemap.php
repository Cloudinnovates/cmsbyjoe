<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Sitemap extends CI_Controller {
	
		function __construct() 
		{
				parent::__construct();
		}
		
		function index()
		{
				$url = base_url();
				
				$sitemap = '';/*'<?xml version="1.0" encoding="UTF-8" ?>';*/
				$sitemap .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
				$sitemap .= '
				<url>
					<loc>' . $url . '</loc>
					<priority>0.5</priority>
					<changefreq>weekly</changefreq>
				</url>';

				// regular static urls
				$pages = array(
						'http://www.mmavalon.com/sales',
						'http://www.mmavalon.com/sales/avalon',
						'http://www.mmavalon.com/sales/stone-harbor',
						'http://www.mmavalon.com/sales/mls_search',
						'http://www.mmavalon.com/rentals',
						'http://www.mmavalon.com/contact'
				);
				
				foreach ($pages as $page)
				{
						$sitemap .= '
						<url>
							<loc>' . $page . '</loc>
							<priority>0.5</priority>
							<changefreq>weekly</changefreq>
						</url>';
				}
				
				$curl = curl_init();			
				curl_setopt($curl, CURLOPT_URL, 'http://idxbyjoe.com/web_service/get_mls_list');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($curl);
				curl_close($curl);
				$mls_links = json_decode($data);
				
				foreach ($mls_links as $mls_link)
				{
						$more_pages[] = base_url() . 'sales/detail/' . $mls_link;
						$sitemap .= '
						<url>
							<loc>' . base_url() . 'sales/detail/' . $mls_link . '</loc>
							<priority>0.5</priority>
							<changefreq>weekly</changefreq>
						</url>';
				}

				$sitemap .= '</urlset>';
				
				header("Content-Type: text/xml");
				echo trim($sitemap);
		}

}


/* End of File: sitemap.php */
/* Location: ./system/application/controllers/sitemap.php */