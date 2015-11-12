<!DOCTYPE html>
<html>
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<title>CMSbyJoe | Content Management Simplified</title>

	<link rel="stylesheet" href="/application/assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/application/assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/application/assets/summernote/dist/summernote.css">
	<link rel="stylesheet" href="/application/assets/summernote/dist/summernote-bs3.css">
	<link rel="stylesheet" href="/application/assets/css/admin.css">
	<link href="/assets/formvalidation/dist/css/formValidation.min.css" rel="stylesheet">

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="/assets/formvalidation/dist/js/formValidation.min.js"></script>
	<script src="/assets/formvalidation/dist/js/framework/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">SitesbyJoe CMS</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/" target="_blank">View Live Site</a></li>
					<li><?php echo anchor('admin_listings', 'Featured Sales', array('id' => 'pages_link')); ?></li>
					<li><?php echo anchor('admin_pages', 'Pages', array('id' => 'pages_link')); ?></li>
					<li><?php echo anchor('admin_posts', 'News', array('id' => 'blog_link')); ?></li>
					<li><?php echo anchor('admin_reviews', 'Testimonials', array('id' => 'reviews_link')); ?>
					<li><?php echo anchor('admin_solds', 'Solds'); ?>
					<li><?php echo anchor('admin_users', 'Users', array('id' => 'users_link')); ?></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if ($this->erkanaauth->try_session_login()) : ?>
					<li><?php echo anchor('admin/logout', 'Logout'); ?></li>
					<?php endif; ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	<div class="container">

		<?php if (strlen($this->session->flashdata('message')) > 0) : ?>
		<div id="flash-data" class="alert alert-success alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<span class="message"><?php echo $this->session->flashdata('message'); ?></span>
		</div>
		<?php endif; ?>

		<?php if (isset($heading)) : ?>
		<h1 class="page_heading"><?=$heading?></h1>
		<?php if (isset($description)) : ?>
			<p class="page_description"><?=$description?></p>
		<?php endif; ?>
		<?php endif; ?>
						
		<?php 
		foreach ($content as $section)
		{
				$this->load->view($section);
		}
		?>
	</div>
		
	<footer>
		<p align="center" style="">CMS designed and developed by <a href="http://sitesbyjoe.com">Sites by Joe</a>.</p>
	</footer>	
	
	<script src="/application/assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/application/assets/js/flashdata.js" type="text/javascript"></script>
	<script src="/application/assets/js/jquery.smartmodal.js" type="text/javascript"></script>
	<script src="/application/assets/summernote/dist/summernote.min.js"></script>

</body>
</html>