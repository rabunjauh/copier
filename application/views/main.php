<!DOCTYPE html>
<html>
<head>
	<title>Wasco Engineering Indonesia - Copier Machine User</title>
	<style type="text/css">
		.box{
			font-size: 12px;
		}

		.nav{
		margin-top: 10px 10px 10px 10px;

	}
	
	</style>
	<link rel="stylesheet" type="text/css" href="style_print.css">
	<!-- Header -->
	<?php echo $header; ?>
	<!-- /Header -->

</head>
<body>
	<!-- Container -->
	<div class="container" style="width: 100%;">
		<div class="row text-center">
		</div>
		<?php 
			if ($menu == 'login'){
				echo '';
			} else {
		?>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-sx-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 text-center">
				<?php echo $cover; ?>
			</div>
		</div>
		<!-- Navigation -->
		<div class="row">
			<nav class="nav">
				<ul>
					<?php	
						if ($this->session->userdata('username')) { 
							echo $navigation;
						} 
					?>
				</ul>
			</nav>	 
		</div>
		<!-- /Navigation -->
		<?php		
			}
		?>
		<div class="row">
			<div id="note">
				<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
			</div>
		</div>

		<?php if (isset($officeLocationId)){ ?>
			<div class="row">				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left" style="margin: 0px 0px 0px 10px">
					<a href="<?= base_url('cextension/index/') . $officeLocationId . "/pdf";?>" class="btn btn-primary" target="_blank">Generate PDF</a>
				</div>		
			</div>
		<?php } ?>

		<!-- Content -->
		<div class="content">
			<?php echo $content; ?>
		</div>
		<!-- /Content -->

		<!-- Footer -->
		<div style="margin-bottom:50px;">
			<?php echo $footer; ?>
		</div>
		<!-- /Footer -->
		
	</div>
	<!-- /Container -->
	<script>
		// function will execute after window load
		window.addEventListener('load', () => {
			if(window.location.href != '<?= base_url('login') ?>'){
				// declare variable
				let idleTime = 0;
				// every 30 minute function will be execute
				let idleInterval = setInterval(function() {
					// idleTime increment
					idleTime ++;
					// to simulate increment console.log below
					// console.log(idleTime);
					// if idleTime >= 30 call ajax callback to controller login/autoLogout to destroy session
					if (idleTime >= 30) {
						let xhr = new XMLHttpRequest();
						xhr.onreadystatechange = () => {
							if (xhr.readyState === 4) {
								if(xhr.status === 200) {
									// if(window.location.href != '<?= base_url('login') ?>'){
										window.location.href = '<?= base_url('login') ?>';
										alert('your session is expired');
									// }
								}
							}
						}
						xhr.open('get', '<?= base_url('login/autoLogout')?>');
						xhr.send();
						// stop timer
						clearInterval(idleInterval);
					}
				//interval every 1 minute
				}, 60000);

				let eventAction = [
					'mousemove',
					'mousedown',
					'click',
					'keydown',
					'keypress',
					'keyup'
				];

				eventAction.forEach((action) => {
					document.addEventListener(action, () => {
						// everytime user do above event idleTime will be set to 0 so the timer will reset
						// to simulate the increment reset
						// console.log below
						// console.log(`idleTimeReset: ${idleTime}`);
						idleTime = 0;
					});
				});
			}
		});	
	</script>
</body>
</html>

