<h1>Pages</h1>
<p><?php echo anchor('admin_pages/add', '<i class="fa fa-plus-circle"></i> Add a New Page', array('class' => 'btn btn-default')); ?></p>

<table id="pages" class="table">
	<thead>
		<tr>
			<!--<th>Status</th>-->
			<th>Page Title</th>
			<!--<th>Section</th>-->
			<th colspan="2">Last Updated</th>
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
							<!--<td class="status">
								<?php echo ($row->status == 1) ? '<span class="published">live</span>' : '<span class="draft">draft</span>'; ?>
							</td>-->
							<td class="link">
								<b><?php echo anchor('admin_pages/edit/' . $row->id, $row->title); ?></b>
								<!--<p><?php echo word_limiter($row->description, 12); ?></p>-->
							</td>
							<!--<td>
								<?php 
								echo '<span class="menu_section">' . $row->menu_section . '</span>';
								echo '<span class="menu_label"> &gt; ' . $row->menu_label . '</span>';
								?>
							</td>-->
							<td nowrap="nowrap" valign="middle">
								<span class="updated_last text-muted">
									<?php echo date('M jS, Y', strtotime($row->datestamp)); ?>
								</span>
							</td>
							<td class="actions" valign="middle">
								<?php 
								$attributes = array('title' => 'Preview', 'target' => '_blank', 'class' => 'text-primary');
								$delete_attributes = array('title' => 'Delete', 'class' => 'text-danger', 'onclick' => 'return confirm(\'Are you SURE you want to delete this page?\');');
								
								if ($row->slug !== 'homepage') 
								{
										echo anchor('pages/' . $row->slug, '<i class="fa fa-search"></i>', $attributes);
								}
								else
								{
										echo anchor('', '<i class="fa fa-search"></i>', $attributes);
								}								
								
								echo ' ' . anchor('admin_pages/edit/' . $row->id, '<i class="fa fa-pencil"></i>', array('title' => 'Edit', 'class' => 'text-success')); 
								echo ' ' . anchor('admin_pages/delete/' . $row->id, '<i class="fa fa-minus-circle"></i>', $delete_attributes);
								?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>