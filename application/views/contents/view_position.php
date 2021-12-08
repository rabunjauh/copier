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
		<?=form_open(base_url() . 'cemployee/searchPosition/'); ?>
		<div class="form-inline">
			<div class="form-group">
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
					<th>Position Name</th>
					<th>Department</th>
					<th>Action</th>
				</tr>
				<?php foreach ( $positions as $position ): ?>
					<tr>
						<td><?php echo $no + 1; ?></td>
						<td><?php echo $position->positiondesc; ?></td>
						<td><?php echo $position->deptdesc; ?></td>
						<td><a href="<?php echo base_url() . 'c_employee/modify_position/' . $position->idposition; ?>"<i class="fa fa-edit fa-2x"></i></a></td>
						<td><a href="<?php echo base_url() . 'c_employee/delete_position/' . $position->idposition; ?>"<i class="fa fa-minus-circle fa-2x"></i></a></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>	
			</table>
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>