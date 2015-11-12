<!doctype html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>CMSbyJoe | Content Management Simplified</title>
		
		<meta name="author" content="Joseph R. B. Taylor - http://sitesbyjoe.com">
		
		<link rel="stylesheet" href="/application/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/application/assets/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="/application/assets/summernote/dist/summernote.css">
		<link rel="stylesheet" href="/application/assets/summernote/dist/summernote-bs3.css">
		<link rel="stylesheet" href="/application/assets/css/admin.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	
	<body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="#">SitesbyJoe CMS</a>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
				
		<div class="container">
			<?php 
			foreach ($content as $section)
			{
					$this->load->view($section); 
			}
			?>		
		</div>
		
		<div id="flash_message">
			<span class="text"><?php echo $this->session->flashdata('message'); ?></span>
		</div>
  	
  	<script src="/application/assets/js/flashdata.js" type="text/javascript"></script>

	</body>
</html>