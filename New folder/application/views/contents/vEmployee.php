<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>Employee Data</h1>
		</div>
	</div>
	<div class="row text-right">
		<div class="col-lg-12">			
			<a href="<?php echo base_url() . 'cemployee/addEmployee' ?>" class="btn btn-primary btn-lg">Add Employee</a>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12">
		<?=form_open(base_url() . 'cemployee/search'); ?>
		<div class="form-inline">
			<div class="form-group">
				<select name="selCategory" class="form-control">
					<option value="0">Search By</option>
					<option value="idemployee">Employee ID</option>
					<option value="employeeno">Employee No</option>
					<option value="employeename">Employee Name</option>
					<option value="deptdesc">Department</option>
					<option value="positiondesc">Position</option>
					<option value="code">Company Code</option>
					<option value="extension">Extension</option>
				</select>						
				<input type="text" class="form-control" name="txtSearch" placeholder="Search">
				<button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>Search</button>
			</div>
		</div>
		<?=form_close(); ?>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
		<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Employee ID</th>
			<th>Employee No</th>
			<th>Employee Name</th>
			<th>Department</th>
			<th>Position</th>
			<th>Extension</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>

		<?php
		foreach ($employees as $employee): ?>
		<tr>
			<td><?php echo $no + 1; ?></td>
			<td><?php echo $employee->idemployee; ?></td>
			<td><?php echo $employee->employeeno; ?></td>
			<td><?php echo $employee->employeename; ?></td>
			<td><?php echo $employee->deptdesc; ?></td>
			<td><?php echo $employee->positiondesc; ?></td>
			<td>
				<?php
					if ($employee->ext) {
						echo $employee->ext;
					}else{
			 			echo $employee->extension;
					} 
				?>
			</td>
			<td>
				<?php echo $employee->employee_status; ?></td>
			<td><a href="<?=base_url() . "cemployee/modifyEmployee/" . $employee->idemployee; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>	
			<td>
				<?php 
					if ($employee->stsactive) { ?>
						<a href="<?=base_url() . "cemployee/toggleEmployeeStatus/" . $employee->idemployee . "/" . 0; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
					<?php } else { ?>	
						<a href="<?=base_url() . "cemployee/toggleEmployeeStatus/" . $employee->idemployee . "/" . 1; ?>"><span class="glyphicon glyphicon-ok-circle"></span></a>
					<?php } ?>			
			</td>	
		
		</tr>
		<?php $no++; ?>
		<?php endforeach ?>
	</table>
	<?php echo $this->pagination->create_links(); ?>
	</div>
	</div>		
</div>	