<div class="container box">
	<div class="row">
		<div class="col-lg-12">
			<h1>Add New Employee</h1>
		</div>
	</div>

	<div class="row text-right" style="margin-bottom: 10px;">
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'cemployee' ?>" class="btn btn-primary">
				<li class="glyphicon glyphicon-arrow-left"></li> Back
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<?= form_open(base_url() . 'cemployee/addEmployee'); ?>

			<div class="form-group">
				<label for="selectOfficeLocation">Office Location :</label>
				<select name="selectOfficeLocation" id="selectOfficeLocation" class="form-control">
					<option value="">Office Location</option>
					<?php foreach ($listOfficeLocations as $listOfficeLocation) : ?>
						<option value="<?= $listOfficeLocation->office_location_id; ?>"><?= $listOfficeLocation->office_location_desc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="txtEmployeeNo">Employee No :</label>
				<input type="text" name="txtEmployeeNo" class="form-control" placeholder="Employee No">
			</div>

			<div class="form-group">
				<label for="txtEmployee">Employee Name :</label>
				<input type="text" name="txtEmployee" class="form-control" placeholder="Employee Name" required>
			</div>




		</div>
		<div class="col-lg-6">

			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select name="selDepartment" id="selDepartment" class="form-control">
					<option value="">Department</option>
					<?php foreach ($departments as $department) : ?>
						<option value="<?= $department->iddept; ?>"><?= $department->deptdesc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="selPosition">Position :</label>
				<select name="selPosition" id="selPosition" class="form-control">
					<option value="">Position</option>
					<?php foreach ($positions as $position) : ?>
						<option value="<?= $position->idposition; ?>"><?= $position->positiondesc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group textExtensionNo">
				<label for="textExtension">Extension No :</label>
				<input type="text" name="textExtension" class="form-control" placeholder="Extension No">
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="btnAdd">
					<li class="glyphicon glyphicon-floppy-disk"></li> Save
				</button>
			</div>

			<?= form_close(); ?>
		</div>
	</div>
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