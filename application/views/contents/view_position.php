<div class="container box">
	<div class="row">
		<div class="col-lg-12">
			<h2>Position</h2>
		</div>
	</div>

	<div class="row text-right">		
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'c_employee/add_position'; ?>" class="btn btn-primary btn-lg">Add Position</a>
		</div>		
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered" id="positionData">
				<thead>
				<tr>
					<th>No</th>
					<th>Position Name</th>
					<th>Department</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ( $positions as $position ): ?>
						<tr>
							<td><?php echo $no + 1; ?></td>
							<td><?php echo $position->positiondesc; ?></td>
							<td><?php echo $position->deptdesc; ?></td>
							<td>
								<a href="<?php echo base_url() . 'c_employee/modify_position/' . $position->idposition; ?>"<i class="fa fa-edit fa-2x"></i></a>
								<a href="<?php echo base_url() . 'c_employee/delete_position/' . $position->idposition; ?>"<i class="fa fa-minus-circle fa-2x"></i></a>
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
        $('#positionData').DataTable();
    });
</script>