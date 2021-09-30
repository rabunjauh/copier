<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Add Office Location</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/addOfficeLocation'); ?>
			<div class="form-group">
				<label for="txtOfficeLocation">Office Location :</label>
				<input type="text" name="txtOfficeLocation" class="form-control" placeholder="Office Location" required>
			</div>

			<div class="form-group">
				<button type="submit" name="btnAddOfficeLocation" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>