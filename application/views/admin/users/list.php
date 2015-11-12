<h1>Users</h1>
<p><?php echo anchor('admin_users/add', 'Add a New User', array('class' => 'btn btn-default')); ?></p>

<table id="pages" class="table">
	<thead>
		<tr>
			<th>User</th>
			<th>UserName</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($users->num_rows() > 0 ) 
		{
				foreach($users->result() as $row) 
				{
						?>
						<tr id="<?php echo $row->id; ?>">
							<td class="link"><?php echo anchor('admin_users/edit/' . $row->id, $row->first_name . ' ' . $row->last_name); ?></td>
							<td class="category"><?=$row->username?></td>
							<td class="link"><?php echo mailto($row->email, $row->email); ?></td>
							<td class="actions">
								<?php echo anchor('admin_users/edit/' . $row->id, '<i class="fa fa-pencil"></i>', array('title' => 'Edit', 'class' => 'text-success')); ?>
								<?php echo anchor('admin_users/delete/' . $row->id, '<i class="fa fa-minus-circle"></i>', array('title' => 'Delete', 'class' => 'text-danger', 'onclick' => "return confirm('Are you SURE you want to delete this user?');")); ?>
							</td>
						</tr>
						<?php
				}
		}
		?>
	</tbody>
</table>