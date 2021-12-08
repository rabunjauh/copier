<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Add Position</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'c_employee/add_position'); ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="txtPosition">Position :</label>
						<input type="text" name="txtPosition" class="form-control" placeholder="Position" required>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="selDepartment">Department :</label>
						<select name="selDepartment" class="form-control" required>
						<option value="">Department</option>
						<?php foreach ( $departments as $department ): ?>
						<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
						<?php endforeach; ?>
					</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" name="btnAddPosition" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>