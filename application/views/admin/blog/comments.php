<table width="100%" class="heading">
	<tr>
		<td><h1>Comments</h1></td>
		<td width="100%" align="right">
			<div class="button-right">
				<div class="btn-inner">
					<?php echo anchor('admin_posts', '<em><img src="/application/assets/icons/comments.png">Blog Posts</em>'); ?>
				</div>
			</div>
			<div class="button-right">
				<div class="btn-inner">
					<?php echo anchor('admin_posts/categories', '<em><img src="/application/assets/icons/book_edit.png">Categories</em>'); ?>
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
			<th>Article</th>
			<th>Who</th>
			<th>What</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($comments->num_rows() > 0 ) 
		{
				foreach($comments->result() as $comment) 
				{
						?>
						<tr id="<?=$comment->id?>">
							<td><?php echo anchor('articles/detail/' . $comment->article_id, $comment->article_id); ?></td>
							<td><?php echo anchor($comment->url, $comment->name) . ' | ' . $comment->email . ' | ' . $comment->ip_address; ?></td>
							<td width="65%"><?php echo $comment->comment; ?></td>
							<td width="40">
								<?php 
								$attributes = array('title' => 'Preview', 'target' => '_blank');
								$delete_attributes = array('title' => 'Delete', 'onclick' => 'return confirm(\'Are you SURE you want to delete this comment?\');');
								
								echo ' ' . anchor('admin_posts/delete_comment/' . $comment->id, '<img src="/application/assets/icons/delete.png" alt="Delete">', $delete_attributes);
								/*
								if ($row->slug != 'homepage') 
								{
										echo anchor('articles/detail/' . $row->id, '<img src="/assets/icons/world.png" valign="middle" alt="View">', $attributes);
								}
								else
								{
										echo anchor('', '<img src="/assets/icons/world.png" valign="middle" alt="View">', $attributes);
								}								
								
								echo ' ' . anchor('admin_posts/edit/' . $row->id, '<img src="/assets/icons/pencil.png" alt="Edit">', array('title' => 'Edit')); 
								echo ' ' . anchor('admin_posts/delete/' . $row->id, '<img src="/assets/icons/delete.png" alt="Delete">', $delete_attributes);
								*/
								?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>