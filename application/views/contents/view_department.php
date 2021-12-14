<div class="container box">
	<div class="row">
		<div class="col-lg-6">
			<h2>Department</h2>
		</div>
	</div>

	<div class="row text-right">
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'c_employee/add_department'; ?>" class="btn btn-primary btn-lg">Add Department</a>
		</div>
	</div>	
	<br>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered" id="deptData">
				<thead>
				<tr>
					<th>No</th>
					<th>Department Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php $no = 1; ?>
				<?php foreach ( $departments as $department ): ?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $department->deptdesc; ?></td>
						<td>
							<?php 
								if ($department->stsactive == 1) {
									echo "ACTIVE";
								} else {
									echo "NOT ACTIVE";
								}
							?>
						</td>
						<td>
							<a href="<?php echo base_url('c_employee/modify_department/' . $department->iddept); ?>"><i class="fa fa-edit fa-2x"></i></a>
							<a href="<?php echo base_url('c_employee/delete_department/' . $department->iddept); ?>"><i class="fa fa-minus-circle fa-2x"></i></a>
						</td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
				</tbody>	
			</table>
		</div>	
	</div>
</div>
<script>
	$(document).ready(function(){
        $('#deptData').DataTable();
    });
</script>