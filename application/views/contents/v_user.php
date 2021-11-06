<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>User</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">			
			<a href="<?php echo base_url() . 'c_user/add_user' ?>" class="btn btn-primary my-1">Add User</a>
		</div>
	</div>	
	
	<div class="row">
		<div class="col-lg-12">
		<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Username</td>
			<td>Email</td>
			<td colspan="2">Action</td>
		</tr>

		<?php
				$no = 1;
				foreach ($users as $user): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $user->username; ?></td>
					<td><?php echo $user->name; ?></td>
					<td><?php echo $user->email; ?></td>
					<td><a href="<?=base_url() . "c_user/modify_user/" . $user->id; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a> | <a href="<?=base_url() . "c_user/change_password/" . $user->id; ?>"><span class="glyphicon glyphicon-edit"></span> Change Password</a> | <a href="<?=base_url() . "c_user/delete_user/" . $user->id; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>	
				</tr>
				<?php $no++; ?>
				<?php endforeach ?>
	</table>
	<?php echo $this->pagination->create_links(); ?>
	</div>
	</div>		
</div>	