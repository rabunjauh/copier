<div class="container box">
	<div class="row">
		<div class="col-lg-12">
			<h1>Modify Employee</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<?= form_open(base_url() . 'cemployee/modifyEmployee/' . $getEmployeeByIds->idemployee); ?>
			<?php foreach ($employees as $employee) : ?>
				<div class="form-group">
					<label for="txtEmployeeId">Employee ID :</label>
					<input type="text" name="txtEmployeeId" class="form-control" value="<?php echo $employee->idemployee; ?>" placeholder="EmployeeId" disabled>
				</div>

				<div class="form-group">
					<label for="selectOfficeLocation">Office Location :</label>
					<select name="selectOfficeLocation" id="selectOfficeLocation" class="form-control">
						<option value="<?= $employee->office_location_id ?>"><?= $employee->office_location_desc ?></option>
						<?php foreach ($listOfficeLocations as $listOfficeLocation) : ?>
							<option value="<?= $listOfficeLocation->office_location_id; ?>"><?= $listOfficeLocation->office_location_desc; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="txtEmployeeNo">Employee No :</label>
					<input type="text" name="txtEmployeeNo" class="form-control" value="<?php echo $employee->employeeno; ?>" placeholder="Employee No">
				</div>

				<div class="form-group">
					<label for="txtEmployeeName">Employee :</label>
					<input type="text" name="txtEmployeeName" class="form-control" value="<?php echo $employee->employeename; ?>" placeholder="EmployeeId" required>
				</div>

		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select id="selDepartment" name="selDepartment" class="form-control" required>
					<option value="<?php echo $employee->iddept; ?>"><?php echo $employee->deptdesc; ?></option>
					<?php foreach ($departments as $department) : ?>
						<option value="<?= $department->iddept; ?>"><?= $department->deptdesc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="selPosition">Position :</label>
				<select id="selPosition" name="selPosition" class="form-control" required>
					<option value="<?php echo $employee->idposition; ?>"><?php echo $employee->positiondesc; ?></option>
					<?php foreach ($positions as $position) : ?>
						<option value="<?= $position->idposition; ?>"><?= $position->deptdesc . " - " . $position->positiondesc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>



			<div class="form-group textExtensionNo">
				<label for="textExtension">Extension No :</label>
				<input type="text" name="textExtension" class="form-control" value="<?= $employee->ext ?>" placeholder="Extension No">
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="btnUpdateEmployee">Save</button>
		</div>
	</div>
<?php endforeach; ?>
<?= form_close(); ?>
</div>
<script>
	// dependent select department & position
	const selectDepartment = document.getElementById('selDepartment');
	selectDepartment.addEventListener('change', function(e) {
		const selectDepartmentValue = e.target.value;
		const url = '<?= base_url('cemployee/departmentPositionDependent'); ?>';
		const selectPosition = document.getElementById('selPosition');
		dependentselect("iddept=" + selectDepartmentValue, url, selectPosition);
	})

	function dependentselect(input, url, elementTarget) {
		let xhttp = new XMLHttpRequest();
		xhttp.open('POST', url, true);
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let output = JSON.parse(this.responseText);
				elementTarget.innerHTML = output;
			}
		};
		xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhttp.send(input);
	}
</script>