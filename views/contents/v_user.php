<div class="container box">	
	<div class="row">
		<div class="col-lg-6">
			<h1>Employee Data</h1>
		</div>
	</div>
	<div class="row text-right">
		<div class="col-lg-12">			
			<a href="<?php echo base_url() . 'c_user/add_user' ?>" class="btn btn-primary btn-lg">Add User</a>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12">
		<?=form_open(base_url() . 'c_user/search/'); ?>
		<div class="form-inline">
			<div class="form-group">
				<select name="selCategory" class="form-control">
					<option value="">Search By</option>
					<option value="idemployee">Employee ID</option>
					<option value="employeeno">Employee No</option>
					<option value="employeename">Employee Name</option>
					<option value="deptdesc">Department</option>
					<option value="positiondesc">Position</option>
					<option value="extension">Extension</option>
				</select>						
				<input type="text" class="form-control" name="txtSearch" placeholder="Search">
				<button type="submit" name="btnSearch" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>Search</button>
			</div>
		</div>
		<?=form_close(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Username</td>
			<td colspan="2">Action</td>
		</tr>

		<?php
				$no = 1;
				foreach ($users as $user): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $user->username; ?></td>
					<td><a href="<?=base_url() . "c_user/modify_user/" . $user->id; ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>	
				</tr>
				<?php $no++; ?>
				<?php endforeach ?>
	</table>
	<?php echo $this->pagination->create_links(); ?>
	</div>
	</div>		
</div>	