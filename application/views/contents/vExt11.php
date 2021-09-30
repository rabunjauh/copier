<div class="container box">
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">
			<h3>YARD 1</h3>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
			<a href="<?php echo base_url() . 'cpabx1' ?>" class="btn btn-default btn-flat">Yard 1</a>
		<a href="<?php echo base_url() . 'cpabx1/yard2' ?>" class="btn btn-default btn-flat">Yard 2</a>
		</div>
	</div>

	<div class="row">
		<?php if ($yard1_pabx1_desc->pabxNo): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">							
				<h4>PABX 1</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">1</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx1_row01 as $yard1_pabx1_row1 ): ?>					
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx1_row1->id;?>"><?php echo $yard1_pabx1_row1->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx1_row01 as $yard1_pabx1_row1 ): ?>
							<?php if ( $yard1_pabx1_row1->status == 0 ){ ?>					
								<td><strong><?php echo $yard1_pabx1_row1->extension; ?></strong></td>
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx1_row1->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>					
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">2</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx1_row02 as $yard1_pabx1_row2 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx1_row2->id;?>"><?php echo $yard1_pabx1_row2->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx1_row02 as $yard1_pabx1_row2 ): ?>
							<?php if ( $yard1_pabx1_row2->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx1_row2->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx1_row2->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">3</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx1_row03 as $yard1_pabx1_row3 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx1_row3->id;?>"><?php echo $yard1_pabx1_row3->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx1_row03 as $yard1_pabx1_row3 ): ?>
							<?php if ( $yard1_pabx1_row3->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx1_row3->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx1_row3->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">4</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx1_row04 as $yard1_pabx1_row4 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx1_row4->id;?>"><?php echo $yard1_pabx1_row4->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx1_row04 as $yard1_pabx1_row4 ): ?>
							<?php if ( $yard1_pabx1_row4->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx1_row4->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx1_row4->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>
				</table>							
			</div>
		<?php endif; ?>	

		<?php if ($yard1_pabx2_desc->pabxNo): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h4>PABX 2</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">1</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx2_row01 as $yard1_pabx2_row1 ): ?>					
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx2_row1->id;?>"><?php echo $yard1_pabx2_row1->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx2_row01 as $yard1_pabx2_row1 ): ?>
							<?php if ( $yard1_pabx2_row1->status == 0 ){ ?>					
								<td><strong><?php echo $yard1_pabx2_row1->extension; ?></strong></td>
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx2_row1->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>					
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">2</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx2_row02 as $yard1_pabx2_row2 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx2_row2->id;?>"><?php echo $yard1_pabx2_row2->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx2_row02 as $yard1_pabx2_row2 ): ?>
							<?php if ( $yard1_pabx2_row2->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx2_row2->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx2_row2->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">3</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx2_row03 as $yard1_pabx2_row3 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx2_row3->id;?>"><?php echo $yard1_pabx2_row3->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx2_row03 as $yard1_pabx2_row3 ): ?>
							<?php if ( $yard1_pabx2_row3->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx2_row3->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx2_row3->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">4</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx2_row04 as $yard1_pabx2_row4 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx2_row4->id;?>"><?php echo $yard1_pabx2_row4->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx2_row04 as $yard1_pabx2_row4 ): ?>
							<?php if ( $yard1_pabx2_row4->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx2_row4->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx2_row4->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>
				</table>
			</div>	
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if(isset($yard1_pabx3_desc->pabxNo)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<h4>PABX 3</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">1</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx3_row01 as $yard1_pabx3_row1 ): ?>					
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx3_row1->id;?>"><?php echo $yard1_pabx3_row1->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx3_row01 as $yard1_pabx3_row1 ): ?>
							<?php if ( $yard1_pabx3_row1->status == 0 ){ ?>					
								<td><strong><?php echo $yard1_pabx3_row1->extension; ?></strong></td>
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx3_row1->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>					
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">2</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx3_row02 as $yard1_pabx3_row2 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx3_row2->id;?>"><?php echo $yard1_pabx3_row2->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx3_row02 as $yard1_pabx3_row2 ): ?>
							<?php if ( $yard1_pabx3_row2->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx3_row2->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx3_row2->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">3</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx3_row03 as $yard1_pabx3_row3 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx3_row3->id;?>"><?php echo $yard1_pabx3_row3->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx3_row03 as $yard1_pabx3_row3 ): ?>
							<?php if ( $yard1_pabx3_row3->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx3_row3->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx3_row3->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">4</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx3_row04 as $yard1_pabx3_row4 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx3_row4->id;?>"><?php echo $yard1_pabx3_row4->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx3_row04 as $yard1_pabx3_row4 ): ?>
							<?php if ( $yard1_pabx3_row4->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx3_row4->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx3_row4->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>
				</table>			
			</div>
		<?php endif; ?>	

		<?php if(isset($yard1_pabx4_desc->pabxNo)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h4>PABX 4</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">1</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx4_row01 as $yard1_pabx4_row1 ): ?>					
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx4_row1->id;?>"><?php echo $yard1_pabx4_row1->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx4_row01 as $yard1_pabx4_row1 ): ?>
							<?php if ( $yard1_pabx4_row1->status == 0 ){ ?>					
								<td><strong><?php echo $yard1_pabx4_row1->extension; ?></st></a></td>
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx4_row1->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>					
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">2</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx4_row02 as $yard1_pabx4_row2 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx4_row2->id;?>"><?php echo $yard1_pabx4_row2->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx4_row02 as $yard1_pabx4_row2 ): ?>
							<?php if ( $yard1_pabx4_row2->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx4_row2->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx4_row2->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">3</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx4_row03 as $yard1_pabx4_row3 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx4_row3->id;?>"><?php echo $yard1_pabx4_row3->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx4_row03 as $yard1_pabx4_row3 ): ?>
							<?php if ( $yard1_pabx4_row3->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx4_row3->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx4_row3->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">4</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx4_row04 as $yard1_pabx4_row4 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx4_row4->id;?>"><?php echo $yard1_pabx4_row4->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx4_row04 as $yard1_pabx4_row4 ): ?>
							<?php if ( $yard1_pabx4_row4->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx4_row4->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx4_row4->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>
				</table>
			</div>
		<?php endif; ?>				
	</div>

	<div class="row">
		<?php if(isset($yard1_pabx5_desc->pabxNo)): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">			
				<h4>PABX 5</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">1</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx5_row01 as $yard1_pabx5_row1 ): ?>					
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx5_row1->id;?>"><?php echo $yard1_pabx5_row1->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx5_row01 as $yard1_pabx5_row1 ): ?>
							<?php if ( $yard1_pabx5_row1->status == 0 ){ ?>					
								<td><strong><?php echo $yard1_pabx5_row1->extension; ?></strong></td>
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx5_row1->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>					
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">2</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx5_row02 as $yard1_pabx5_row2 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx5_row2->id;?>"><?php echo $yard1_pabx5_row2->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx5_row02 as $yard1_pabx5_row2 ): ?>
							<?php if ( $yard1_pabx5_row2->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx5_row2->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx5_row2->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">3</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx5_row03 as $yard1_pabx5_row3 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx5_row3->id;?>"><?php echo $yard1_pabx5_row3->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx5_row03 as $yard1_pabx5_row3 ): ?>
							<?php if ( $yard1_pabx5_row3->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx5_row3->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx5_row3->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>

					<thead>
						<tr>
							<th>Row</th>
							<th colspan="8" class="text-center">4</th>
						</tr>
						<tr>
							<th>Column</th>
							<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Port</td>
							<?php foreach ( $yard1_pabx5_row04 as $yard1_pabx5_row4 ): ?>						
								<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx5_row4->id;?>"><?php echo $yard1_pabx5_row4->port; ?></a></td>
							<?php endforeach ?>
						</tr>
						<tr>
							<td>Extension</td>
							<?php foreach ( $yard1_pabx5_row04 as $yard1_pabx5_row4 ): ?>
							<?php if ( $yard1_pabx5_row4->status == 0 ){ ?>
								<td><strong><?php echo $yard1_pabx5_row4->extension; ?></strong></td>					
								
								<?php } else { ?>
									<td class="danger"><strong><?php echo $yard1_pabx5_row4->extension; ?></strong></td>
								<?php } ?>
							<?php endforeach ?>								
						</tr>						
					</tbody>
				</table>			
			</div>	
		<?php endif; ?>

	<?php if(isset($yard1_pabx6_desc)): ?>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4>PABX 6</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Row</th>
						<th colspan="8" class="text-center">1</th>
					</tr>
					<tr>
						<th>Column</th>
						<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
					</tr>
				</thead>
				<tbody>						
					<tr>
						<td>Port</td>
						<?php foreach ( $yard1_pabx6_row01 as $yard1_pabx6_row1 ): ?>					
							<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx6_row1->id;?>"><?php echo $yard1_pabx6_row1->port; ?></a></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td>Extension</td>
						<?php foreach ( $yard1_pabx6_row01 as $yard1_pabx6_row1 ): ?>
						<?php if ( $yard1_pabx6_row1->status == 0 ){ ?>					
							<td><strong><?php echo $yard1_pabx6_row1->extension; ?></st></a></td>
							<?php } else { ?>
								<td class="danger"><strong><?php echo $yard1_pabx6_row1->extension; ?></strong></td>
							<?php } ?>
						<?php endforeach ?>								
					</tr>					
				</tbody>

				<thead>
					<tr>
						<th>Row</th>
						<th colspan="8" class="text-center">2</th>
					</tr>
					<tr>
						<th>Column</th>
						<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Port</td>
						<?php foreach ( $yard1_pabx6_row02 as $yard1_pabx6_row2 ): ?>						
							<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx6_row2->id;?>"><?php echo $yard1_pabx6_row2->port; ?></a></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td>Extension</td>
						<?php foreach ( $yard1_pabx6_row02 as $yard1_pabx6_row2 ): ?>
						<?php if ( $yard1_pabx6_row2->status == 0 ){ ?>
							<td><strong><?php echo $yard1_pabx6_row2->extension; ?></strong></td>					
							
							<?php } else { ?>
								<td class="danger"><strong><?php echo $yard1_pabx6_row2->extension; ?></strong></td>
							<?php } ?>
						<?php endforeach ?>								
					</tr>						
				</tbody>

				<thead>
					<tr>
						<th>Row</th>
						<th colspan="8" class="text-center">3</th>
					</tr>
					<tr>
						<th>Column</th>
						<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Port</td>
						<?php foreach ( $yard1_pabx6_row03 as $yard1_pabx6_row3 ): ?>						
							<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx6_row3->id;?>"><?php echo $yard1_pabx6_row3->port; ?></a></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td>Extension</td>
						<?php foreach ( $yard1_pabx6_row03 as $yard1_pabx6_row3 ): ?>
						<?php if ( $yard1_pabx6_row3->status == 0 ){ ?>
							<td><strong><?php echo $yard1_pabx6_row3->extension; ?></strong></td>					
							
							<?php } else { ?>
								<td class="danger"><strong><?php echo $yard1_pabx6_row3->extension; ?></strong></td>
							<?php } ?>
						<?php endforeach ?>								
					</tr>						
				</tbody>

				<thead>
					<tr>
						<th>Row</th>
						<th colspan="8" class="text-center">4</th>
					</tr>
					<tr>
						<th>Column</th>
						<th>8</th><th>7</th><th>6</th><th>5</th><th>4</th><th>3</th><th>2</th><th>1</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Port</td>
						<?php foreach ( $yard1_pabx6_row04 as $yard1_pabx6_row4 ): ?>						
							<td><a href="<?=base_url() . "cpabx1/modifyExtension/" . $yard1_pabx6_row4->id;?>"><?php echo $yard1_pabx6_row4->port; ?></a></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td>Extension</td>
						<?php foreach ( $yard1_pabx6_row04 as $yard1_pabx6_row4 ): ?>
						<?php if ( $yard1_pabx6_row4->status == 0 ){ ?>
							<td><strong><?php echo $yard1_pabx6_row4->extension; ?></strong></td>					
							
							<?php } else { ?>
								<td class="danger"><strong><?php echo $yard1_pabx6_row4->extension; ?></strong></td>
							<?php } ?>
						<?php endforeach ?>								
					</tr>						
				</tbody>
			</table>
		</div>
		<?php endif; ?>			
	</div>
</div>			
