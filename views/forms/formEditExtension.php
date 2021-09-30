<div class="container box">
		<div class="box-header">
			<h1 class="box-title">Edit Extension</h1>
		</div>
			
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<?=form_open(base_url().'cpabx1/modifyExtension/' . $getExtensionByIds->id); ?>	
			<div class="form-group">
				<?php foreach ( $pabxs as $pabx ): ?>
					<input type="hidden" name="extId" value="<?php echo $pabx->id; ?>">
				<?php endforeach; ?>
			</div>
			<div class="form-group">
				<label for="portNo">Port No :</label>
				<?php foreach ( $pabxs as $pabx ): ?>
					<input type="text" name="portNo" class="form-control" value="<?php echo $pabx->port; ?>" disabled>
				<?php endforeach; ?>			
			</div>
			
			<div class="form-group">
				<label for="extNo">Extension No :</label>
				<input type="text" name="extNo" value="<?php echo $pabx->extension; ?>" class="form-control" placeholder="Extension No" maxlength="3" autofocus>				
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="btnUpdateExtension">Save</button>
			</div>
		<?=form_close(); ?>
			</div>
		</div>
	</div>
</div>

