<nav class="nav">
	<ul>
		<?php 
		if ( $this->session->userdata('username') ){ ?>
		<li><a href="<?=base_url() . "cextension/phoneBook/yard1";?>" title="">YARD 1</a></li>
		<li><a href="<?=base_url() . "cextension/phoneBook/yard2";?>" title="">YARD 2</a></li>
		<li><a href="<?=base_url() . "cextension/phoneBook/sukajadi";?>" title="">SUKAJADI</a></li>
			
		<li><a href="<?=base_url() . "cpabx1";?>" title="">PABX</a></li>
		<li><a href="<?=base_url() . "cemployee";?>" title="">Employees</a></li>
		<li><a href="<?=base_url() . "cemployee/department";?>" title="">Departments</a></li>
		<li><a href="<?=base_url() . "cemployee/position";?>" title="">Positions</a></li>
		<li><a href="<?=base_url() . "c_user";?>" title="">Users</a></li>
		<li><a href="<?=base_url() . "login/logout";?>" title="">Logout</a></li>
		<?php }else{ ?>
		<li><a href="<?=base_url() . "cextension";?>" title="">YARD 1</a></li>
		<li><a href="<?=base_url() . "cextension/yard2";?>" title="">YARD 2</a></li>
		<li><a href="<?=base_url() . "cextension/sukajadi";?>" title="">SUKAJADI</a></li>
		<?php } ?>
	</ul>
</nav>