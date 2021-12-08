<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Modify Department</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'c_employee/update_department/'); ?>
			<div class="form-group">
				<label for="txtDepartmentName">Department Name :</label>
				<input type="text" name="txtDepartmentName" class="form-control" value="<?php echo $getDepartmentByIds->deptdesc; ?>" required>
				<input type="hidden" name="txtDepartmentId" class="form-control" value="<?php echo $getDepartmentByIds->iddept; ?>">
			</div>

			<div class="form-group">
				<label for="selectStatus">Status</label>
				<select name="selectStatus" class="form-control">
					<?php 
						if ($departmentId->stsactive == 0) {
							$status = "NOT ACTIVE";
						} else {
							$status = "ACTIVE";
						}
					?>	
					<option value="<?= $getDepartmentByIds->stsactive; ?>"><?= $status ?></option>
					<option value="0">NOT ACTIVE</option>
					<option value="1">ACTIVE</option>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnModifyDepartment" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>