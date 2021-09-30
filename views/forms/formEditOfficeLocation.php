<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Modify Office Location</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/modifyOfficeLocation/' . $officeLocationById->office_location_id); ?>
			<div class="form-group">
				<label for="txtOfficeLocation">Office Location ID :</label>
				<input type="text" name="txtOfficeLocation" class="form-control" value="<?php echo $officeLocationById->office_location_id; ?>" disabled>
			</div>

			<div class="form-group">
				<label for="txtOfficeLocationDesc">Office Location :</label>
				<input type="text" name="txtOfficeLocationDesc" class="form-control" value="<?php echo $officeLocationById->office_location_desc; ?>" required>
			</div>

			<div class="form-group">
				<button type="submit" name="btnModifyOfficeLocation" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>