<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Modify Department</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/modifyDepartment/' . $getDepartmentByIds->iddept); ?>
			<?php foreach ( $departmentIds as $departmentId ): ?>
			<div class="form-group">
				<label for="txtDepartmentID">Department ID :</label>
				<input type="text" name="txtDepartmentID" class="form-control" value="<?php echo $departmentId->iddept; ?>" disabled>
			</div>

			<div class="form-group">
				<label for="txtDepartmentName">Department Name :</label>
				<input type="text" name="txtDepartmentName" class="form-control" value="<?php echo $departmentId->deptdesc; ?>" required>
			</div>

			<div class="form-group">
				<label for="selectGroup">Code :</label>
				<select name="selectGroup" class="form-control">
				<option value="<?= $departmentId->group_id ?>"><?= $departmentId->group_desc ?></option>
					<?php 
						foreach ($groups as $group) :
					?>
							<option value="<?= $group['group_id'] ?>"><?= $group['group_desc'] ?></option>
					<?php 
						endforeach;
					?>
				</select>
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
					<option value="<?= $departmentId->stsactive; ?>"><?= $status ?></option>
					<option value="0">NOT ACTIVE</option>
					<option value="1">ACTIVE</option>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnModifyDepartment" class="btn btn-primary">Save</button>
			</div>
			<?php endforeach; ?> 
		<?php echo form_close(); ?>
	</div>
</div>