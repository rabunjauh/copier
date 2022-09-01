<div class="container box">
	<div class="row">
		<div class="col-lg-6">
			<h2>Reset Password</h2>
		</div>
	</div>
	<?php 
		echo validation_errors();
	?>
	<div class="row">
		<div class="col-lg-6">
			<?php echo form_open(base_url() . 'c_user/change_password/' . $user->id); ?>
			<div class="form-group">
				<label for="txt_username">Username :</label>
				<input type="text" name="txt_username" class="form-control" placeholder="Username" value="<?= $user->username; ?>" disabled>
			</div>

			<div class="form-group">
				<label for="txt_email">Email :</label>
				<input type="text" name="txt_email" id="txt_email" class="form-control" value="<?= $user->email; ?>" placeholder="Email" disabled>
			</div>

			<div class="form-group">
				<label for="txt_password">New Password :</label>
				<input type="password" name="txt_password" class="form-control" placeholder="Password" required>
			</div>

			<div class="form-group">
				<label for="txt_confirm_password">Confirm Password :</label>
				<input type="password" name="txt_confirm_password" class="form-control" placeholder="Confirm Password" required>
			</div>

			<div class="form-group">
				<button type="submit" name="btn_add_user" class="btn btn-primary">Save</button>
				<a href="<?= base_url('c_user'); ?>" class="btn btn-info">Back</a>
			</div>
		<?php echo form_close(); ?>
		</div>
	</div>
</div>