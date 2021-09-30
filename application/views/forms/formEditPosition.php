<div class="box">
	<div class="box-header">
		<div class="col-lg-6">
			<h2>Modify Position</h2>
		</div>
	</div>

	<div class="box-body">
		<?php echo form_open(base_url() . 'cemployee/modifyOfficeLocation/' . $getPositionByIds->idposition); ?>
			<?php foreach ( $positionIds as $positionId ): ?>
			<div class="form-group">
				<label for="txtPositionID">Position ID :</label>
				<input type="text" name="txtPositionID" class="form-control" value="<?php echo $positionId->idposition; ?>" disabled>
			</div>

			<div class="form-group">
				<label for="txtPositionName">Position Name :</label>
				<input type="text" name="txtPositionName" class="form-control" value="<?php echo $positionId->positiondesc; ?>" required>
			</div>

			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select name="selDepartment" class="form-control" required>
				<option value="<?php echo $positionId->iddept; ?>"><?php echo $positionId->deptdesc; ?></option>
				<?php foreach ( $departments as $department ): ?>
				<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
				<?php endforeach; ?>
			</select>
			</div>

			<div class="form-group">
				<label for="selLevel">Level :</label>
				<select name="selLevel" class="form-control" required>
				<option value="<?php echo $positionId->level; ?>"><?php echo $positionId->level; ?></option>
				<?php for ( $i = 1; $i <= 30; $i++ ){ ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="form-group">
				<button type="submit" name="btnModifyPosition" class="btn btn-primary">Save</button>
			</div>
			<?php endforeach; ?> 
		<?php echo form_close(); ?>
	</div>
</div>