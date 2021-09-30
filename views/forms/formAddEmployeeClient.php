<div class="box">	
	<div class = "box-body table-responsive">
		<h1>Add New Employee</h1>
		
			<?=form_open(base_url() . 'cemployeeClient/addEmployee'); ?>
			<div class="form-group">
				<label for="txtEmployee">Employee Name :</label>
				<input type="text" name="txtEmployee" class="form-control" placeholder="Employee Name" required>
			</div>

			<div class="form-group">
				<label for="selCompany">Company :</label>
				<select name="selCompany" class="form-control" required>
				<option value="">Company</option>
				<?php foreach ( $departments as $department ): ?>
				<option value="<?=$department->iddept; ?>"><?=$department->deptdesc; ?></option>
				<?php endforeach; ?>
			</select>
			</div>
			 
			<div class="form-group">
				<label for="selPosition">Position :</label>
				<select name="selPosition" class="form-control" required>
				<option value="">Position</option>
				<?php foreach ($positions as $position): ?>
				<option value="<?=$position->idposition; ?>"><?=$position->positiondesc; ?></option>
				<?php endforeach; ?>
				</select>
			</div> 
			
			<div class="form-group">
				<label for="selExtension">Extension No :</label>
				<select name="selExtension" class="form-control">
					<option value="">Extension No</option>
					<?php foreach ( $extensions as $extension ): ?>
						<option value="<?=$extension->id; ?>"><?=$extension->extension . " Port : " . $extension->port; ?></option>}
						option
					<?php endforeach; ?>	
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="btnAdd">Save</button>
			</div>					
			<?=form_close(); ?>
		
	</div>
</div>	
