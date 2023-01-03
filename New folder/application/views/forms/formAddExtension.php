<?=form_open(base_url().'cpabx1/saveExtension'); ?>
	<select name="portNo" required>
		<option value="">Port No</option>
		<?php for ( $i=1;$i <= 128;$i++ ): ?>
		<option value="<?php
				if ( $i < 10 ){
					echo "00" . $i;
				}
				elseif ( $i >=10 && $i < 100 ){
					echo "0" . $i;
				}
				else{
					echo $i;
				}
			?>">
			<?php
				if ( $i < 10 ){
					echo "00" . $i;
				}
				elseif ( $i >=10 && $i < 100 ){
					echo "0" . $i;
				}
				else{
					echo $i;
				}
			?>			
		</option>
		<?php endfor; ?>
	</select>
	<input type="text" name="extNo" placeholder = "Extension No" maxlength="3">
	<select name="pabxLocation" required>
		<option value="">PABX Location</option>
		<option value="1">Yard 1</option>
		<option value="2">Yard 2</option>
	</select>

	<select name="pabxNo" required>
		<option value="">PABX No</option>
		<?php foreach ($pabx_no as $no): ?>
				<option value="<?php echo $no->id_pabx; ?>"><?php echo $no->pabx_no; ?></option>
		<?php endforeach ?>	
	</select>

	<button type="submit" name="addExt">Add Extension</button>

<?=form_close(); ?>