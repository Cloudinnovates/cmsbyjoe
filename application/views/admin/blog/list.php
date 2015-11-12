<h1>News Stories</h1></td>
<p><?php echo anchor('admin_posts/add', 'Add a New Story', array('class' => 'btn btn-default')); ?>

<table class="table">
	<thead>
		<tr>
			<th>Date</th>
			<th>Headline</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($query->num_rows() > 0 ) 
		{
				foreach($query->result() as $row) 
				{
						?>
						<tr id="<?=$row->id?>">
							<td class="date"><?php echo date('m/d/Y', strtotime($row->datestamp)); ?></td>
							<td class="link" width="65%"><?php echo anchor('admin_posts/edit/' . $row->id, $row->headline); ?></td>
							<td class="actions">
								<?php 
								$attributes = array('title' => 'Preview', 'target' => '_blank');
								$delete_attributes = array('title' => 'Delete', 'class' => 'text-danger', 'onclick' => 'return confirm(\'Are you SURE you want to delete this entry?\');');
								//$delete_attributes = array('title' => 'Delete', 'class' => 'delete_link');

								
								echo anchor('blog/' . $row->slug, '<i class="fa fa-search"></i>', $attributes);
								//echo anchor('news/detail/' . $row->id, '<img src="/assets/icons/world.png" valign="middle" alt="View">', $attributes);
								echo ' ' . anchor('admin_posts/edit/' . $row->id, '<i class="fa fa-pencil"></i>', array('title' => 'Edit', 'class' => 'text-success')); 
								echo ' ' . anchor('admin_posts/delete/' . $row->id, '<i class="fa fa-minus-circle"></i>', $delete_attributes);
								?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>