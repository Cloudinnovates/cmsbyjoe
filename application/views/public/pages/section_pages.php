<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

if ($section->num_rows() > 0)
{
		echo '<h1>' . $section->row()->name . '</h1>';
}

foreach ($pages->result() as $page)
{
		echo '<hr>';
		echo '<h2>' . anchor('pages/' . $page->slug, $page->title) . '</h2>';
		echo auto_typography($page->description);
}


/* End of File: section_pages.php */
/* Location: ./application/views/public/pages/section_pages.php */