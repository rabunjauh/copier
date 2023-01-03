<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Add Department</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/addDepartment'); ?>
			<div class="form-group">
				<label for="txtDepartment">Department :</label>
				<input type="text" name="txtDepartment" class="form-control" placeholder="Department" required>
			</div>

			<div class="form-group">
				<label for="selectGroup">Code :</label>
				<select name="selectGroup" class="form-control">
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
					<option value="0">NOT ACTIVE</option>
					<option value="1">ACTIVE</option>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnAddDepartment" class="btn btn-primary">Save</button>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>