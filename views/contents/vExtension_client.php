<div class="container box">
	<div class="row" style="margin-top: 10px">				
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<a href="<?php echo base_url() . 'cextension' ?>" class="btn btn-default btn-flat">Wasco</a>
			<a href="<?php echo base_url() . 'cextension/client' ?>" class="btn btn-default btn-flat">Client</a>
		</div>	

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
			<a href="<?= base_url('cextension/pdf_extension_client_y1'); ?>" class="btn btn-primary" target="_blank">Generate PDF</a>
		</div>		
	</div>

	<div class="row text-center">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Yard 1 Client</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<?php echo $cover; ?>
		</div>
	</div>

	<div class="row">
		<?php if (isset($clients1_desc->deptdesc)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-center"><strong>Client 1</strong></td>
						<td class="text-center"><strong><?php echo $clients1_desc->deptdesc; ?></strong></td>
						<td class="text-right"><a href="<?= base_url('cextension/pdf_client1'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
					</tr>
					<tr>
						<th class="col-md-3">Name</th>
						<th class="col-md-3">Position</th>
						<th class="col-md-1">Ext</th>
						</tr>
					<?php
					foreach ($clients1 as $client1): ?>
					<tr>
						<td class="col-md-3"><?php echo $client1->employeename; ?></td>
						<td class="col-md-3"><?php echo $client1->positiondesc; ?></td>
						<td class="col-md-1"><?php echo $client1->extension; ?></td>	
					</tr>
					<?php endforeach ?>	
				</table>			
			</div>
		<?php endif; ?>

	<?php if (isset($clients2_desc->deptdesc)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-center"><strong>Client 2</strong></td>
						<td class="text-center"><strong><?php echo $clients2_desc->deptdesc; ?></strong></td>
						<td class="text-right"><a href="<?= base_url('cextension/pdf_client2'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
					</tr>
					<tr>
						<th class="col-md-3">Name</th>
						<th class="col-md-3">Position</th>
						<th class="col-md-1">Ext</th>
						</tr>
					<?php
					foreach ($clients2 as $client2): ?>
					<tr>
						<td class="col-md-3"><?php echo $client2->employeename; ?></td>
						<td class="col-md-3"><?php echo $client2->positiondesc; ?></td>
						<td class="col-md-1"><?php echo $client2->extension; ?></td>
						</tr>
					<?php endforeach ?>	
				</table>			
			</div>
		<?php endif; ?>
	</div>	

	<div class="row">	
	<?php if (isset($clients3_desc->deptdesc)): ?>	
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">				
					<table class="table table-bordered table-striped">
						<tr>
							<td class="text-center"><strong>Client 3</strong></td>
							<td class="text-center"><strong><?php echo $clients3_desc->deptdesc; ?></strong></td>
							<td class="text-right"><a href="<?= base_url('cextension/pdf_client3'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
						</tr>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Ext</th>
						</tr>
						<?php
						foreach ($clients3 as $client3): ?>
						<tr>
							<td><?php echo $client3->employeename; ?></td>
							<td><?php echo $client3->positiondesc; ?></td>
							<td><?php echo $client3->extension; ?></td>	
						</tr>
						<?php endforeach ?>	
					</table>				
				</div>
		<?php endif; ?>

		<?php if (isset($clients4_desc->deptdesc)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-center"><strong>Client 4</strong></td>
						<td class="text-center"><strong><?php echo $clients4_desc->deptdesc; ?></strong></td>
						<td class="text-right"><a href="<?= base_url('cextension/pdf_client4'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
					</tr>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Ext</th>
					</tr>
					<?php
					foreach ($clients4 as $client4): ?>
					<tr>
						<td><?php echo $client4->employeename; ?></td>
						<td><?php echo $client4->positiondesc; ?></td>
						<td><?php echo $client4->extension; ?></td>	
					</tr>
					<?php endforeach ?>	
				</table>			
			</div>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($clients5_desc->deptdesc)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-center"><strong>Client 5</strong></td>
						<td class="text-center"><strong><?php echo $clients5_desc->deptdesc; ?></strong></td>
						<td class="text-right"><a href="<?= base_url('cextension/pdf_client5'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
					</tr>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Ext</th>
					</tr>
					<?php
					foreach ($clients5 as $client5): ?>
					<tr>
						<td><?php echo $client5->employeename; ?></td>
						<td><?php echo $client5->positiondesc; ?></td>
						<td><?php echo $client5->extension; ?></td>	
					</tr>
					<?php endforeach ?>	
				</table>			
			</div>
		<?php endif; ?>

		<?php if (isset($clients6_desc->deptdesc)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-center"><strong>Client 6</strong></td>
						<td class="text-center"><strong><?php echo $clients6_desc->deptdesc; ?></strong></td>
						<td class="text-right"><a href="<?= base_url('cextension/pdf_client6'); ?>" class="btn btn-primary" target="_blank">PDF</a></td>
					</tr>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Ext</th>
					</tr>
					<?php
					foreach ($clients6 as $client6): ?>
					<tr>
						<td><?php echo $client6->employeename; ?></td>
						<td><?php echo $client6->positiondesc; ?></td>
						<td><?php echo $client6->extension; ?></td>	
					</tr>
					<?php endforeach ?>	
				</table>			
			</div>
		<?php endif; ?>
	</div>
</div>	
