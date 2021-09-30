<div class="container box">	
	<div class = "row">
		<div class="col-lg-12">
			<h1>Modify Employee</h1>
		</div>	
	</div>	

	<div class="row">
		<div class="col-lg-6">	
			<?=form_open(base_url() . 'cemployee/modifyEmployee/' . $getEmployeeByIds->idemployee); ?>
				<?php foreach ( $employees as $employee ): ?>
					<div class="form-group">
							<label for="txtEmployeeId">Employee ID :</label>			
							<input type="text" name="txtEmployeeId" class="form-control" value="<?php echo $employee->idemployee; ?>" placeholder="EmployeeId" disabled>
					</div>
			
					<div class="form-group">
						<label for="selectOfficeLocation">Office Location :</label>
						<select name="selectOfficeLocation" id="selectOfficeLocation" class="form-control">
							<option value="<?= $employee->office_location_id ?>"><?= $employee->office_location_desc ?></option>
							<?php foreach ( $listOfficeLocations as $listOfficeLocation ): ?>
							<option value="<?=$listOfficeLocation->office_location_id; ?>"><?=$listOfficeLocation->office_location_desc; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="txtEmployeeNo" >Employee No :</label>
						<input type="text" name="txtEmployeeNo" class="form-control" value="<?php echo $employee->employeeno; ?>" placeholder="Employee No">
					</div>	

					<div class="form-group">
						<label for="txtEmployeeName">Employee :</label>			
							<input type="text" name="txtEmployeeName"  class="form-control" value="<?php  echo $employee->employeename; ?>" placeholder="EmployeeId" required>
					</div>

					<div class="form-group">
						<label for="selDepartment">Department :</label>
						<select name="selDepartment" class="form-control" required>
							<option value="<?php echo $employee->iddept; ?>"><?php echo $employee->deptdesc; ?></option>
							<?php foreach ( $departments as $department ): ?>
							<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
			
					

					
		</div>

		<div class="col-lg-6">
		<div class="form-group">
						<label for="selPosition">Position :</label>
						<select name="selPosition" class="form-control" required>
							<option value="<?php echo $employee->idposition; ?>"><?php echo $employee->positiondesc; ?></option>
							<?php foreach ($positions as $position): ?>
							<option value="<?=$position->idposition; ?>"><?=$position->deptdesc . " - " . $position->positiondesc; ?></option>
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
						<select name="selExtension" class="form-control" required>
							<option value="<?php echo $employee->extId; ?>"><?php echo $employee->extension; ?></option>
							<option value="">Extension No</option>
							<?php foreach ( $extensions as $extension ): ?>
								<option value="<?php echo $extension->id; ?>"><?php echo $extension->extension . " " . $extension->pabxLocation; ?></option>}
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="txtprevid" id="txtprevid" value="<?php echo $employee->extId; ?>" />
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
		<?=form_close(); ?>
	<?php endforeach; ?>
</div>
<script>
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
				selExtension.required = FALSE;
			}else{
				selExtension.style.display = 'block';
				textExtensionNo.style.display = 'none';
			}
		});
	}	

	toggleExtension();
</script>		
