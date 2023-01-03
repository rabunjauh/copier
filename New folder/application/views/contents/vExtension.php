<div class="container box">
	<div class="row text-center">
		<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
			<h3><?= $officeLocationDesc->office_location_desc ?></h3>
			<hr>
		</div>
	</div>
	<div class="row" >
		<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">	
				
		<?php 
			if (isset($phoneBooks)){
			foreach ($phoneBooks as $key => $departmentGroups) :
		?>
			<table class="table table-bordered table-striped">
					<tr>
						<td colspan="3"><strong><?php echo $key; ?></strong></td>
					</tr>
					<tr>
						<td>Employee Name</td>
						<td>Position</td>
						<td>Ext</td>
					</tr>
		<?php	
				foreach ($departmentGroups as $assocIndex => $departmentGroup) :
					if ($departmentGroup['extension'] != 0 OR $departmentGroup['ext'] != NULL) {
						if ($departmentGroup['extension']){
							$extensionNo = $departmentGroup['extension'];
						} else {
							$extensionNo = $departmentGroup['ext'];
						}
		?>
						<tr>
							<td class="col-md-2"><?php echo $departmentGroup['employeename']; ?></td>
							<td class="col-md-3"><?php echo $departmentGroup['positiondesc']; ?></td>
							<td class="col-md-1"><?php echo $extensionNo; ?></td>	
						</tr>
		<?php	
					}	
				endforeach;
		?>		
				</table>			
		<?php
			endforeach;
			}	
		?>	
		</div>
	</div>
</div>	
<button id="topBtn">
	<li class="glyphicon glyphicon-arrow-up"></li> Top
</button>
<script>
	const topBtn = document.getElementById('topBtn');

	window.onscroll = function() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			topBtn.style.display = 'block';
		} else {
			topBtn.style.display = 'none';
		}
	}

	topBtn.onclick = function() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>
