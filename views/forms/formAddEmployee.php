<div class="container box">	
	<div class = "row">
		<div class="col-lg-12">
			<h1>Add New Employee</h1>
		</div>
	</div>

	<div class="row text-right" style="margin-bottom: 10px;">
		<div class="col-lg-12">			
			<a href="<?php echo base_url() . 'cemployee' ?>" class="btn btn-primary"><li class="glyphicon glyphicon-arrow-left"></li> Back</a>
		</div>
	</div>	

	<div class="row">
		<div class="col-lg-6">
			<?=form_open(base_url() . 'cemployee/addEmployee'); ?>

			<div class="form-group">
				<label for="selectOfficeLocation">Office Location :</label>
				<select name="selectOfficeLocation" id="selectOfficeLocation" class="form-control">
					<option value="">Office Location</option>
					<?php foreach ( $listOfficeLocations as $listOfficeLocation ): ?>
					<option value="<?=$listOfficeLocation->office_location_id; ?>"><?=$listOfficeLocation->office_location_desc; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="txtEmployeeNo">Employee No  :</label>
				<input type="text" name="txtEmployeeNo" class="form-control" placeholder="Employee No">
			</div>	

			<div class="form-group">
				<label for="txtEmployee">Employee Name :</label>
				<input type="text" name="txtEmployee" class="form-control" placeholder="Employee Name" required>
			</div>

			<div class="form-group">
				<label for="selDepartment">Department :</label>
				<select name="selDepartment" id="selDepartment" class="form-control">
				<option value="">Department</option>
				<?php foreach ( $departments as $department ): ?>
				<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
				<?php endforeach; ?>
			</select>
			</div>
			 
			
		</div>
        <div class="col-lg-6">
        <div class="form-group">
				<label for="selPosition">Position :</label>
				<select name="selPosition" id="selPosition" class="form-control">
				<option value="">Position</option>
				<?php foreach ($positions as $position): ?>
				<option value="<?=$position->idposition; ?>"><?=$position->positiondesc; ?></option>
				<?php endforeach; ?>
				</select>
			</div> 
			
			<div class="form-group">
				<label for="selectExtensionInputType">Input Type</label>
				<select name="selectExtensionInputType" id="selectExtensionInputType" class="form-control">
					<option value="fromList">Select From List</option>
					<option value="manual">Manual Input</option>
				</select>
			</div>

			<div class="form-group selExtension">
				<label for="selExtension">Extension No :</label>
				<select name="selExtension" id="selExtension" class="form-control">
					<option value="">Extension No</option>
					<?php foreach ( $extensions as $extension ): ?>
						<option value="<?=$extension->id; ?>">Yard<?=$extension->pabxLocation . " - " . $extension->extension; ?></option>}
						option
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
				<button type="submit" class="btn btn-primary" name="btnAdd"><li class="glyphicon glyphicon-floppy-disk"></li> Save</button>
			</div>					
		
			<?=form_close(); ?>
		</div>
	</div>	
</div>
<script>
	// function for toggle extension input (manual or select from pabx list)
	function toggleExtension(){
		const selectExtensionInputType = document.getElementById('selectExtensionInputType');
		const selExtension = document.getElementsByClassName('selExtension')[0];
		const textExtensionNo = document.getElementsByClassName('textExtensionNo')[0];

		selExtension.style.display = 'block';
		textExtensionNo.style.display = 'none';
	
		selectExtensionInputType.addEventListener('change', function (e){
			const value = selectExtensionInputType.options[selectExtensionInputType.selectedIndex].value;
			if (value == 'manual') {
				selExtension.style.display = 'none';
				textExtensionNo.style.display = 'block';
			}else{
				selExtension.style.display = 'block';
				textExtensionNo.style.display = 'none';
			}
		});
	}	

	toggleExtension();

	// dependent select department & position
	const selectDepartment = document.getElementById('selDepartment');
	selectDepartment.addEventListener('change', function (e){
		const selectDepartmentValue = e.target.value;
		const url = '<?= base_url('cemployee/departmentPositionDependent'); ?>';
		const selectPosition = document.getElementById('selPosition');
		dependentselect("iddept="+selectDepartmentValue, url, selectPosition);
	})

	// dependent select office location ext location		
	const selectOfficeLocation = document.getElementById('selectOfficeLocation');
	selectOfficeLocation.addEventListener('change', function (e){
		const selectOfficeLocationValue = e.target.value;
		const url = '<?= base_url('cextension/officeExtensionDependent'); ?>';
		const selExtension = document.getElementById('selExtension');
		dependentselect("officeLocation="+selectOfficeLocationValue, url, selExtension);
	})

	function dependentselect(input, url, elementTarget) {
		let xhttp = new XMLHttpRequest();
		xhttp.open('POST', url, true);
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				let output = JSON.parse(this.responseText);
				elementTarget.innerHTML = output;
			}
		};
		xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhttp.send(input);
	}
</script>	
