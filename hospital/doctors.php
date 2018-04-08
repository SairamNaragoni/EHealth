<?php include('includes/header.php') ?>
<style type="text/css">
	#name {
		color: red;
		font-weight: 500;
	}
	#approve {
		color: blue;
	}
	#approve:hover {
		text-decoration: underline;
	}
</style>
<section id="main-content">
	<section class="wrapper">
		<div class="mail-w3agile">
		<?php 
		if(isset($_GET['type'])){
			if ($_GET['type']==0) {
				include('includes/pendingDoc.php');
			}
			else if($_GET['type']==1){
				include('includes/allDoc.php');
			}
		}

		?>
        </div>
        
</section>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="js/updateApprovald.js"></script>
</section>