
<div class="row">
	<div class="login-form form-signin">
		<h1 class="text-center login-title">Sign in</h1>
		<img class="profile-img" src="<?=base_url('assets/images/photo.jpg'); ?>">
		<?= form_open(base_url() . 'login'); 
		$username_data = array(
			'type' => 'text',
			'name' => 'txt_username',
			'class' => 'form-control',
			'placeholder' => 'Username',
			'autofocus' => 'autofocus'
		);
		$password_data = array(
			'type' => 'password',
			'name' => 'txt_password',
			'class' => 'form-control',
			'placeholder' => 'Password',
		);
		echo form_input($username_data);
		echo form_input($password_data);

		?>
		<button class="btn btn-primary btn-lg btn-block" type="submit" name="btn_login">Login</button>
		<?php form_close(); ?>
		<?php echo validation_errors(); ?>
	</div>
</div>