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
			if ($_GET['type']==1) {
				if(isset($_GET['uid'])){
					include('includes/hospital_user.php');
				}
				else{
					include('includes/data.php');
				}		
			}
			else if($_GET['type']==0){
				include('includes/pastAppointments.php');
			}
		}

		?>
        </div>
        <?php include('includes/footer.php') ?>
</section>
