<h1>Testimonials</h1>
<p><a href="admin_reviews/add" class="btn btn-default">Add a Testimonial</a></p>

<table id="reviews" class="table">
	<thead>
		<tr>
			<th>From</th>
			<th>Review</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($reviews->num_rows() > 0 ) 
		{
				foreach($reviews->result() as $review) 
				{
						?>
						<tr id="<?=$review->id?>">
							<td class="from" valign="top" width="20%"><?php echo $review->name; ?></td>
							<td class="review" valign="top"><?php echo auto_typography($review->review); ?></td>
							<td valign="top" align="center" class="actions" nowrap="nowrap">
								<?php
								echo anchor('admin_reviews/edit/' . $review->id, '<i class="fa fa-pencil"></i>', array('title' => 'Edit', 'class' => 'text-success')) . ' ';
								echo anchor('admin_reviews/delete/' . $review->id, '<i class="fa fa-minus-circle"></i>', array('class' => 'text-danger', 'title' => 'Delete', 'onclick' => 'return confirm(\'Are you SURE you want to delete this testimonial?\');')); 
								?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>
