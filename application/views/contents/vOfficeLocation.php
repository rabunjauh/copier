<div class="container box">
	<div class="row">
		<div class="col-lg-12">
			<h2>Office Location</h2>
		</div>
	</div>

	<div class="row text-right">		
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'cemployee/addOfficeLocation'; ?>" class="btn btn-primary btn-lg" style="margin-bottom: 10px;">Add Location</a>
		</div>		
	</div>

	<div class="row">
		<div class="col-lg-12">
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Location Name</th>
					<th>Action</th>
				</tr>
				<?php foreach ( $navigation as $nav ): ?>
					<tr>
						<td><?php echo $no + 1; ?></td>
						<td><?php echo $nav->office_location_desc; ?></td>
						<td><a href="<?php echo base_url() . 'cemployee/modifyOfficeLocation/' . $nav->office_location_id; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-edit"></li> Edit</a> | <a href="<?php echo base_url() . 'cemployee/deleteOfficeLocation/' . $nav->office_location_id; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-trash"></li> Delete</a></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>	
			</table>
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>