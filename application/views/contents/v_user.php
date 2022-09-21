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
	<hr>
	<div class="row">
		<div class="col-lg-12">
		<table id="users" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
			<th>No</th>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>CC Email</th>
			<th>Action</th>
            </tr>
        </thead>
        <tbody>
		<?php
			$no = 1;
			foreach ($users as $user): 
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $user->username; ?></td>
				<td><?php echo $user->name; ?></td>
				<td><?php echo $user->email; ?></td>
				<?php
					if ($user->status === '1') {
						$status = 'Yes';
						$check_icon = '<i class="fa fa-ban fa-2x tooltips"></i>';
					} else {
						$status = 'No';
						$check_icon = '<i class="fa fa-check fa-2x tooltips"></i>';
					}
				?>
				<td><?php echo $status; ?></td>
				<td>
					<a href="<?=base_url() . "c_user/modify_user/" . $user->id; ?>"><i class="fa fa-edit fa-2x tooltips"></i></a>
					<a href="<?=base_url() . "c_user/change_password/" . $user->id; ?>"><i class="fa fa-key fa-2x tooltips"></i></a>
					<a href="<?=base_url() . "c_user/delete_user/" . $user->id; ?>" data-userId="<?= $user->id ?>" id="delete_button"><i class="fa fa-trash-o fa-2x tooltips"></i></a>
					<a href="<?=base_url() . "c_user/check/" . $user->id; ?>"><?= $check_icon ?></a>
				</td>
			</tr>
			<?php $no++; ?>
			<?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
				<th>No</th>
				<th>Username</th>
				<th>Name</th>
				<th>Email</th>
				<th>CC Email</th>
				<th>Action</th>
            </tr>
        </tfoot>
    </table>
	<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>		
</div>
<script>
	const delete_button = document.getElementById('delete_button');
	delete_button.addEventListener('click', function(event) {
		if(!confirm('DELETE this user?')) {
			event.preventDefault();
		}
	});

	 $(document).ready(function(){
        $('#users').DataTable();
    });
</script>	