<h1 class="page-heading">Client Testimonials</h1>
<p class="page-opener">See what customers say about Mark!</p>

<div class="reviews">
<?php
foreach ($reviews->result() as $review)
{
		// review goes here
		echo '<div class="testimonial">';
		echo auto_typography($review->review);
		echo '<p class="from">-- ' . $review->name . '</p>';
		echo '</div>';
		echo '<hr>';
}
?>
</div>