<table width="100%" class="heading">
	<tr>
		<td><h1>Categories</h1></td>
		<td width="100%" align="right">
			<div class="button-right">
				<div class="btn-inner">
					<?php echo anchor('admin_posts/categories', '<em><img src="/application/assets/icons/book_edit.png">Blog Posts</em>'); ?>
				</div>
			</div>
			<div class="button-right">
				<div class="btn-inner">
					<?php echo anchor('admin_posts/comments', '<em><img src="/application/assets/icons/comments.png">Comments</em>'); ?>
				</div>
			</div>
			<div class="button-right">
				<div class="btn-inner">
					<?php echo anchor('admin_posts/add', '<em><img src="/application/assets/icons/add.png">Add a New Entry</em>'); ?>
				</div>
			</div>		
		</td>
	</tr>
</table>

<hr>

<table id="pages" class="list">
	<thead>
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($categories->num_rows() > 0 ) 
		{
				foreach($categories->result() as $row) 
				{
						?>
						<tr id="<?=$row->id?>">
							<td><?php echo $row->name; ?></td>
							<td width="80">
								<?php
								$attributes = array('title' => 'Preview', 'target' => '_blank');
								$delete_attributes = array('title' => 'Delete', 'onclick' => 'return confirm(\'Are you SURE you want to delete this category?\');');
			
								echo ' ' . anchor('admin_posts/edit_category/' . $row->id, '<img src="/application/assets/icons/pencil.png" alt="Edit">', array('title' => 'Edit')); 
								echo ' ' . anchor('admin_posts/delete_category/' . $row->id, '<img src="/application/assets/icons/delete.png" alt="Delete">', $delete_attributes);
								?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>