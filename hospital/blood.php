<?php include('includes/header.php') ?>
<section id="main-content">
	<section class="wrapper">
		<div class="bg-agile">
			<div class="book-appointment">
				<h2>Notify for emergency blood</h2>
				<form action="notification.php" method="get">
					<div class="full-agileinfo same">
						<div class="gaps">
							<p>Type of Blood</p>
							<input type="hidden" name="hid" value="<?php echo $_SESSION['h_id'];?>">	
							<select class="form-control" name="bg">
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
							</select>
						</div>
					</div>
					<div class="clear"></div>
					<input type="submit" value="Make a call">
				</form>
			</div>
			<?php
			if (isset($_GET['sent']) && $_GET['sent']==1) {
		    ?>
				<div class=" bg-agile btn btn-success"  style="margin:20px 80px 80px 140px;">All the People with Same Blood Group Notified.
			    </div>
			<?php
			}
			

			?>
		</div>
	</section>
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>