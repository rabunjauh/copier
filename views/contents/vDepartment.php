<div class="container box">
	<div class="row">
		<div class="col-lg-6">
			<h2>Department</h2>
		</div>
	</div>

	<div class="row text-right">
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'cemployee/addDepartment'; ?>" class="btn btn-primary btn-lg">Add Department</a>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Department Name</th>
					<th>Code</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php $no = 1; ?>
				<?php foreach ( $departments as $department ): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $department->deptdesc; ?></td>
						<td><?php echo $department->group_desc; ?></td>
						<td>
							<?php 
								if ($department->stsactive == 1) {
									echo "ACTIVE";
								} else {
									echo "NOT ACTIVE";
								}
							?>
						</td>
						<td><a href="<?php echo base_url() . 'cemployee/modifyDepartment/' . $department->iddept; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-edit"></li> Edit</a> | <a href="<?php echo base_url() . 'cemployee/deleteDepartment/' . $department->iddept; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-trash"></li> Delete</a></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>	
			</table>
			<?php echo $this->pagination->create_links(); ?>
		</div>	
	</div>
</div>