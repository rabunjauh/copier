<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Add Department</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'c_employee/add_department'); ?>
			
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="txtDepartment">Department :</label>
						<input type="text" name="txtDepartment" class="form-control" placeholder="Department" required>
					</div>
				</div>	

				<div class="col-lg-6">
					<div class="form-group">
						<label for="selectStatus">Status</label>
						<select name="selectStatus" class="form-control">
							<option value="0">NOT ACTIVE</option>
							<option value="1">ACTIVE</option>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<button type="submit" name="btnAddDepartment" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>