<!--Normalize CSS -->
<link href="<?php echo base_url('assets/css/normalize.css') ?>" rel="stylesheet" media="screen,print">

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url('assets/bootstrap-3.2.0/css/bootstrap.css') ?>" rel="stylesheet" media="screen,print">

<!-- Font Awesome -->
<link href="<?php echo base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css') ?>" rel="stylesheet" media="screen,print">

<!-- DATA TABLES -->
<link href="<?php echo base_url('assets/datatable/css/dataTables.bootstrap.css') ?>" rel="stylesheet" media="screen,print">

<!-- Custom CSS  -->
<link href="<?php echo base_url('assets/css/navigation.css') ?>" rel="stylesheet" media="screen,print">
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" media="screen,print">
<!-- jQuery 2.0.3 -->
<script src="<?=base_url('assets/js/jquery-2.0.3.min.js') ?>"></script>
<script src="<?=base_url('assets/js/script.js') ?>"></script>
<script src="<?=base_url('assets/bootstrap-3.2.0/js/bootstrap.min.js') ?>"></script>

<!-- Print -->
<script type="text/javascript">
		function printDiv(){
			var divToPrint = document.getElementById('print');
			var newWin = window.open('', 'Print-Window');
			newWin.document.open();
			newWin.document.write('<html><head><link href="<?php echo base_url('assets/bootstrap-3.2.0/css/bootstrap.css') ?>" rel="stylesheet" media="screen,print"></head><body onload = "window.print()">'+divToPrint.innerHTML+'</body></html>');
			newWin.document.close();
			setTimeOut(function(){newWin.close();},10);
		}
	</script>
<!-- /Print -->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]