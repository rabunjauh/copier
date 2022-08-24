<nav class="nav">
	<ul>
		<?php 
			if ( $this->session->userdata('username') ){
		?>
				<li><a href="<?=base_url() . "c_employee_details/index";?>" title="">Wasco</a></li>
				<li><a href="<?=base_url() . "c_employee_details/client_subcon";?>" title="">Client & Subcon</a></li>
				<!-- <li><a href="<?=base_url() . "c_employee/department";?>" title="">Department</a></li>
				<li><a href="<?=base_url() . "c_employee/position";?>" title="">Position</a></li> -->
				<li><a href="<?=base_url() . "login/logout";?>" title="">Logout</a></li>
		<?php 
			} 
		?>
	</ul>
</nav>