<div class="heading">
	<h1 class="page-heading">Mark's Real Estate Blog</h1>
	<p class="page-opener">What's new in the world of Real Estate in Avalon &amp; Stone Harbor</p>
</div>
	

<div class="news" id="article_list">
<?php if ($articles->num_rows() > 0) : ?>
<?php foreach ($articles->result() as $article) : ?>

	<div class="article">
		<h3><?php echo anchor('blog/' . $article->slug, $article->headline); ?></h3>
		<!--<p class="post_date">Posted <?php echo how_long_ago(strtotime($article->datestamp)); ?>-->
		<?php
		echo '<p class="post_date">Posted on ' . date('l, F dS, Y', strtotime($article->datestamp)) . '</p>';
		?>
		<p><?php echo word_limiter(strip_tags($article->story), 25); ?>
		<?php echo anchor('blog/' . $article->slug, 'Read Post'); ?></p>
	</div>
	
<?php endforeach; ?>
<?php endif; ?>
</div>
