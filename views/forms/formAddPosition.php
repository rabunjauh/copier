<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Add Department</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/addPosition'); ?>
			<div class="form-group">
				<label for="txtPosition">Position :</label>
				<input type="text" name="txtPosition" class="form-control" placeholder="Position" required>
			</div>

			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select name="selDepartment" class="form-control" required>
				<option value="">Department</option>
				<?php foreach ( $departments as $department ): ?>
				<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
				<?php endforeach; ?>
			</select>
			</div>

			<div class="form-group">
				<label for="selLevel">Level :</label>
				<select name="selLevel" class="form-control" required>
				<option value="">Level</option>
				<?php for ( $i = 1; $i <= 30; $i++ ){ ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnAddPosition" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>