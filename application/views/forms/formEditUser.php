<div class="container box">
	<div class="row">
		<div class="col-lg-6">
			<h2>Add User</h2>
		</div>
	</div>
	<?php 
		echo validation_errors();
	?>
	<div class="row">
		<div class="col-lg-6">
			<?php echo form_open(base_url() . 'c_user/modify_user/' . $user->id); ?>
			<div class="form-group">
				<label for="txt_username">Username :</label>
				<input type="text" name="txt_username" class="form-control" value="<?= $user->username; ?>" disabled>
			</div>
			
			<div class="form-group">
				<label for="txt_name">Name :</label>
				<input type="text" name="txt_name" class="form-control" placeholder="Employee Name" value="<?= $user->name; ?>" required>
			</div>


			<div class="form-group">
				<label for="txt_email">Email :</label>
				<input type="text" name="txt_email" id="txt_email" class="form-control" value="<?= $user->email; ?>" placeholder="Email" required>
			</div>

			<div class="form-group">
				<button type="submit" name="btn_add_user" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
		</div>
	</div>
</div>