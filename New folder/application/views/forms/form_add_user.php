<div class="container box">
	<div class="row">
		<div class="col-lg-6">
			<h2>Add User</h2>
		</div>
	</div>
	<?php 
	if ( isset($konfirmasi_password_error) ){
		echo $konfirmasi_password_error;
	}

	?>
	<div class="row">
		<div class="col-lg-6">
			<?php echo form_open(base_url() . 'c_user/add_user'); ?>
			<div class="form-group">
				<label for="txt_username">Username :</label>
				<input type="text" name="txt_username" class="form-control" placeholder="Username" required>
			</div>

			<div class="form-group">
				<label for="txt_password">Password :</label>
				<input type="password" name="txt_password" class="form-control" placeholder="Password" required>
			</div>

			<div class="form-group">
				<label for="txt_confirm_password">Confirm Password :</label>
				<input type="password" name="txt_confirm_password" class="form-control" placeholder="Confirm Password" required>
			</div>

			<div class="form-group">
				<button type="submit" name="btn_add_user" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
		</div>
	</div>
</div>