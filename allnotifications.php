<?php include('includes/header.php') ?>
<!--sidebar end-->
<!--main content start-->
<?php

  $query = "SELECT * FROM `notifications` WHERE `uid` = '".$_SESSION['uid']."'
              ORDER BY `notify_time` DESC";
  $result = mysqli_query($conn, $query);



?>
<section id="main-content">
	<section class="wrapper">
		<div class="agil-info-calendar">
		<div class="col-md-2"></div>
		<div class="col-md-8 w3agile-notifications">
			<div class="notifications">
				<!--notification start-->
					<header class="panel-heading">
						Notification 
					</header>
					<?php
                       while($row = mysqli_fetch_array($result))
                       {
                       	 if($row['ntype']=="EB")
                       	 {


                       	 	$query1 = "SELECT * FROM `hospital` WHERE 	`h_id` = '".$row['notified_by']."' ";
				        	$result1 = mysqli_query($conn,$query1);
			                $error="ok";
				        	$query2 = "SELECT `bloodgroup` FROM `users` WHERE id= '".$row['uid']."' ";
				        	$result2 = mysqli_query($conn,$query2);
				        	$row2 = mysqli_fetch_array($result2);

				        	if($row1 = mysqli_fetch_array($result1))
				        	{
				        	$hospital_name = $row1['hname'];
				        	$phno = $row1['hphone'];
                            }

                            $msg = 'Need' .$row2['bloodgroup'].'Blood Urgently<br/>Hospital:'.$hospital_name.'<br/>Contact: '.$phno.' ';
                       	  
                       	 $date = date("F j,Y,g:i a",strtotime($row['notify_time']));
                       	 ?>
                           <div class="notify-w3ls">
						     <div class="alert alert-info clearfix">
							   <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							     <div class="notification-info">
								   <ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#"><?php echo $msg ?></a></span> </li>
									<li class="pull-right notification-time"><?php echo $date ?></li>
								   </ul>
										
							     </div>
						     </div>
					       </div>
                       	 <?php
                       }
                       elseif($row['ntype']=="DA")
                       {
                           $query1 = "SELECT * FROM `users` WHERE `id` = '".$row['notified_by']."' ";
				                 $result1 = mysqli_query($conn,$query1);
				                 if($row1 = mysqli_fetch_array($result1))
					        	 {   
					        		
					        		$doctor = $row1['username'];
					        		$phno = $row1['phone'];

					        		$msg = 'Appointment Confirmed:<br/>Doctor:'.$doctor.'<br/>Phno.'.$phno.' ';

					        		$date = date("F j,Y,g:i a",strtotime($row['notify_time']));
                       	 ?>
                           <div class="notify-w3ls">
						     <div class="alert alert-info clearfix">
							   <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							     <div class="notification-info">
								   <ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#"><?php echo $msg ?></a></span> </li>
									<li class="pull-right notification-time"><?php echo $date ?></li>
								   </ul>
										
							     </div>
						     </div>
					       </div>
                       	 <?php
	                     	}
	        	
                       }
                       elseif($row['ntype']=="DR")
                       {

                          
                            $query1 = "SELECT * FROM `users` WHERE `id` = '".$row['notified_by']."' ";
				                 $result1 = mysqli_query($conn,$query1);
				                 if($row1 = mysqli_fetch_array($result1))
					        	 {   
					        		
					        		$doctor = $row1['username'];
					        		$phno = $row1['phone'];

					        		$msg = 'Report Sent:<br/>Doctor:'.$doctor.'<br/>Phno.'.$phno.' ';

					        		$date = date("F j,Y,g:i a",strtotime($row['notify_time']));
                       	 ?>
                           <div class="notify-w3ls">
						     <div class="alert alert-info clearfix">
							   <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							     <div class="notification-info">
								   <ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#"><?php echo $msg ?></a></span> </li>
									<li class="pull-right notification-time"><?php echo $date ?></li>
								   </ul>
										
							     </div>
						     </div>
					       </div>
                       	 <?php

                       }
                      }
                  }
					?>	
			</div>
				<!--notification end-->
				<div class="col-md-2"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
</section>
 <!-- footer -->
		   <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2018 EHEALTH CARE. All rights reserved | Design by <a href="https://github.com/SairamNaragoni/EHealth">Rogue Nation</a></p>
			</div>
		  </div>
  <!-- / footer -->
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
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {
			$('#mycalendar').monthly({
				mode: 'event',
				
			});
			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});
		});
	</script>
	<!-- //calendar -->
</body>
</html>
