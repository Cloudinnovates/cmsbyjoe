<div class="post news">
	<?php
	foreach ($news->result() as $story)
	{
			//$this_url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
			
			echo '<div class="heading">';
			echo '<h1 class="page-heading">' . $story->headline . '</h1>';
			echo '<p class="page-opener">Posted on ' . date('l, F dS', strtotime($story->datestamp)) . '</p>';
			echo '</div>';

			echo auto_typography($story->story);
	}
	?>
</div>
