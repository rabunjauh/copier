<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Modify Position</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'c_employee/update_position/'); ?>
			<div class="form-group">
					<label for="txtPositionName">Position Name :</label>
					<input type="text" name="txtPositionName" class="form-control" value="<?php echo $getPositionById->positiondesc; ?>" required>
					<input type="hidden" name="txtPositionID" class="form-control" value="<?php echo $getPositionById->idposition; ?>">
			</div>

			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select name="selDepartment" class="form-control" required>
				<option value="<?php echo $getPositionById->iddept; ?>"><?php echo $getPositionById->deptdesc; ?></option>
				<?php foreach ( $departments as $department ): ?>
				<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
				<?php endforeach; ?>
			</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnModifyPosition" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>