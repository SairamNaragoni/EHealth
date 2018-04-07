<?php
        session_start();
        if(!isset($_SESSION['uid']))
        {
            header("Location: index.php");
        }
 ?>
<!DOCTYPE html>
<head>
<title>E-Health Care</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Web Template" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="css/monthly.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/style2.css">
<link href="css/wickedpicker.css" rel="stylesheet" type='text/css' media="all" />
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">E-Health</a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username">John Doe</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="profile.php"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="signout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="home.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Appointments</span>
                    </a>
                    <ul class="sub">
						<li><a href="appointments.php?type='0'">Previous Appointments</a></li>
						<li><a href="appointments.php?type='1'">Pending Appointments</a></li>
                        <li><a href="map.php">Book Appointment</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bullhorn"></i>
                        <span>Emergency</span>
                    </a>
                    <ul class="sub">
                        <li><a href="emergency.php?forme='1'">For Me</a></li>
                        <li><a href="emergency.php?forme='0'">For Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="events.php">
                        <i class="fa fa-bullhorn"></i>
                        <span>Events</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="fa fa-bullhorn"></i>
                        <span>Profile</span>
                    </a>
                </li> 
                <li>
                    <a href="signout.php">
                        <i class="fa fa-user"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<?php include('includes/connection.php');
		if(isset($_GET['hid']))
		{
			$hid = "'".$_GET['hid']."'";
			$query = "SELECT * FROM `doctor` WHERE hid = $hid";
			$result = mysqli_query($conn,$query);
			$rows = mysqli_num_rows($result);
		}
		if(isset($_GET['did']))
		{
			$did = $_GET['did'];
		}
		
?>
<?php
 	function getUname($uid)
    {
    	include('includes/connection.php');
    	$u_query = "SELECT * FROM `users` WHERE id = $uid";
        $uresult = mysqli_query($conn,$u_query);
        $u_row = mysqli_fetch_array($uresult);
        return $u_row['username'];
    }
?>
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
 <div class="panel panel-default">
 	<?php if(isset($_GET['hid'])) : ?>
    <div class="panel-heading">
     Doctors Available In the Hospital
    </div>
    <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <thead>
          <tr>
            <th>Name</th>
            <th>Specialzation</th>
            <th data-breakpoints="xs">From</th>
            <th data-breakpoints="xs sm md" data-title="">Till</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php if($rows) : ?>
        	<?php while($row = mysqli_fetch_array($result)) : ?>
          	<tr data-expanded="true">
            <td><?php echo getUname($row['uid']); ?></td>
            <td><?php echo $row['specialArea']; ?></td>
            <td><?php echo $row['avail_from']; ?></td>
            <td><?php echo $row['avail_till']; ?></td>
            <td><a href="book.php?did=<?php echo $row['did']; ?>">Book Appointment</a></td>
          	</tr>
          	<?php endwhile; ?>
          <?php else : ?>
          	<tr>
            <td class="view-message dont-show">No Doctors registered in the hospital</td>
            </tr>
          <?php endif; ?> 
        </tbody>
      </table>
    </div>
	<?php endif; ?>
	<?php if(isset($_GET['did'])) : ?>
    <div class="panel-heading">Finish up the following details : </div>
    <div>
        <h1></h1>
    <div class="bg-agile">
    <div class="book-appointment">
    <h2>Make an appointment</h2>
            <form action="insert.php?did=<?php echo $_GET['did']?>" method="post">
            <div class="left-agileits-w3layouts same">
                <div class="gaps">
                <p>Symptoms : </p>
                        <textarea name="symptoms" rows="4" cols="50" required="" style="height: 80px;" ></textarea>
                </div>
            </div>
            <div class="right-agileinfo same">
            <div class="gaps">
                <p>Select Date : </p><input type="date" name="datein" required="">
            </div>
            </div>
            <div class="clear"></div>
            <input type="submit" value="Make an appointment">
            </form>
        </div>
   </div>
    </div>
    <?php endif; ?>
  </div>
</div>
</section>

 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->

</section>

<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="js/wickedpicker.js"></script>
<script type="text/javascript">
				$('.timepicker').wickedpicker({twentyFour: false});
			</script>
		<!-- Calendar -->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->
			</body>
</html>
