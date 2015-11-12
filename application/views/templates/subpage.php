<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title></title>
		
	</head>

	<body>
		
					<?php
					if ($content_type == 'dynamic')
					{
							if (isset($sidebar) && $sidebar == TRUE)
							{
									//echo '<div class="col-sm-8">';
							}
							
							if (isset($page->heading) && strlen($page->heading) > 0)
							{	
									echo '<h1 class="page-heading">' . $page->heading . '</h1>';
							}

							if (isset($page->opener) && strlen($page->opener) > 0)
							{
									echo '<p class="page-opener">' . $page->opener . '</p>';
							}

							echo $page->content;

							if (isset($sidebar) && $sidebar == TRUE)
							{
									//echo '</div>';
							}
					}
					else
					{
							foreach ($content as $section)
							{
									if (isset($sidebar) && $sidebar == TRUE)
									{
											//echo '<div class="col-sm-8">';
									}
									$this->load->view($section);
									if (isset($sidebar) && $sidebar == TRUE)
									{
											//echo '</div>';
									}
							}
					}
					
					if (isset($sidebar) && $sidebar == TRUE)
					{
							//echo '<div class="col-sm-4 sidebar">';
							foreach ($sidebars as $section)
							{
									$this->load->view('blocks/sidebar/' . $section);
							}
							//echo '</div>';
					}
					?>

	</body>
</html>