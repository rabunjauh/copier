<div class="container box">
	<div class="row">
		<div class="col-lg-12">
			<h2>Position</h2>
		</div>
	</div>

	<div class="row text-right">		
		<div class="col-lg-12">
			<a href="<?php echo base_url() . 'cemployee/addPosition'; ?>" class="btn btn-primary btn-lg">Add Position</a>
		</div>		
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
		<?=form_open(base_url() . 'cemployee/searchPosition/'); ?>
		<div class="form-inline">
			<div class="form-group">
				<select name="search_by" id="search_by" class="form-control">
					<option value="null">Search By</option>
					<option value="positiondesc">Text</option>
					<option value="idposition">Position</option>
					<option value="iddept">Department</option>
				</select>

				<input type="text" class="form-control" name="txtSearch" id="txtSearch" placeholder="Search">

				<select name="select_position" id="select_position" class="form-control">
					<option value="null">Position</option>
					<?php foreach ($get_positions as $get_position): ?>
						<option value="<?php echo $get_position->idposition; ?>"><?php echo $get_position->deptdesc . " - " . $get_position->positiondesc; ?></option>
					<?php endforeach ?>
				</select>

				<select name="select_department" id="select_department" class="form-control">
					<option value="null">Department</option>
					<?php foreach ( $departments as $department ): ?>
						<option value="<?php echo $department->iddept; ?>"><?php echo $department->deptdesc; ?></option>
					<?php endforeach; ?>	
				</select>					
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
					<th>Level</th>
					<th>Action</th>
				</tr>
				<?php foreach ( $positions as $position ): ?>
					<tr>
						<td><?php echo $no + 1; ?></td>
						<td><?php echo $position->positiondesc; ?></td>
						<td><?php echo $position->deptdesc; ?></td>
						<td><?php echo $position->level; ?></td>
						<td><a href="<?php echo base_url() . 'cemployee/modifyPosition/' . $position->idposition; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-edit"></li> Edit</a> | <a href="<?php echo base_url() . 'cemployee/deletePosition/' . $position->idposition; ?>" class="btn btn-primary"><li class="glyphicon glyphicon-trash"></li> Delete</a></td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>	
			</table>
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>

<script>
	const search_by = document.getElementById('search_by');
	const txtSearch = document.getElementById('txtSearch');
	const select_position = document.getElementById('select_position');
	const select_department = document.getElementById('select_department');

	select_department.style.display = 'none';
	select_position.style.display = 'none';

	search_by.addEventListener('change', function(){
		
		if (this.value == 'positiondesc' || this.value == '0') {
			txtSearch.style.display = 'inline';
			select_department.style.display = 'none';
			select_position.style.display = 'none';
		} else if (this.value == 'idposition') {
			txtSearch.style.display = 'none';
			select_department.style.display = 'none';
			select_position.style.display = 'inline';
		} else if (this.value == 'iddept') {
			txtSearch.style.display = 'none';
			select_department.style.display = 'inline';
			select_position.style.display = 'none';
		}
	});
</script>