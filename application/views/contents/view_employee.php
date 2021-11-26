<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-3.2.0/css/bootstrap.css') ?>">
	<script src="<?=base_url('assets/js/jquery-2.0.3.min.js') ?>"></script>
	<script src="<?=base_url('assets/js/script.js') ?>"></script>
	<script src="<?=base_url('assets/bootstrap-3.2.0/js/bootstrap.min.js') ?>"></script>
	
</head>
<body>
	<div class="container box">	
		<div class="row">
			<div class="col-lg-6">
				<h1>Employee Data</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-4ss col-sm-4 col-xm-4">
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
				<th>Employee No</th>
				<th>Employee Name</th>
				<th>Department</th>
				<th>Position</th>
			</tr>

			<?php
			foreach ($employees as $employee): ?>
			<tr id="table_row_employee" data-id="<?= $employee->fingerid; ?>" 
										data-name="<?= $employee->employeename; ?>" 
										data-iddept="<?= $employee->iddept; ?>" 
										data-deptdesc="<?= $employee->deptdesc; ?>" 
										data-idposition="<?= $employee->idposition; ?>"
										data-positiondesc="<?= $employee->positiondesc; ?>"
										data-email="<?= $employee->email; ?>">
				<td><?= $no + 1; ?></td>
				<td><?php echo $employee->employeeno; ?></td>
				<td><?php echo $employee->employeename; ?></td>
				<td><?php echo $employee->deptdesc; ?></td>
				<td><?php echo $employee->positiondesc; ?></td>
			</tr>
			<?php $no++; ?>
			<?php endforeach ?>
		</table>
		<?php echo $this->pagination->create_links(); ?>
		</div>
		</div>		
	</div>
</body>
<?php echo $footer; ?>
</html>
<script>
	let table_row_employees = document.querySelectorAll('#table_row_employee');
    table_row_employees.forEach(table_row_employee => {
		table_row_employee.addEventListener('click', function() {
			const idemployee = this.dataset.id;
			const employeename = this.dataset.name;
			const iddept = this.dataset.iddept;
			const deptdesc = this.dataset.deptdesc;
			const idposition = this.dataset.idposition;
			const positiondesc = this.dataset.positiondesc;
			const email = this.dataset.email;
			
			const txt_idemployee = window.opener.document.getElementById('txt_idemployee');
			const txt_employee_name = window.opener.document.getElementById('txt_employee_name');
			const txt_employee_iddept = window.opener.document.getElementById('txt_employee_iddept');
			const txt_employee_department_desc = window.opener.document.getElementById('txt_employee_department_desc');
			const txt_employee_idposition = window.opener.document.getElementById('txt_employee_idposition')
			const txt_employee_positiondesc = window.opener.document.getElementById('txt_employee_positiondesc');
			const txt_employee_email = window.opener.document.getElementById('txt_employee_email');

			txt_idemployee.value = idemployee;
			txt_employee_name.value = employeename;
			txt_employee_iddept.value = iddept;
			txt_employee_department_desc.value = deptdesc;
			txt_employee_idposition.value = idposition;
			txt_employee_positiondesc.value = positiondesc;
			txt_employee_email.value = email;
			window.close()
		});
	});
</script>
