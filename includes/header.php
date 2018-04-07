<?php
        session_start();
        if(!isset($_SESSION['uid']))
        {
            header("Location: index.php");
        }

 ?>
<?php include("includes/connection.php"); ?>
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
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script type="text/javascript">



    $(document).ready(function()
    {
         function load_unseen_notification(view = '')
         { 
           $.ajax({
           url:"fetch.php",
           method:"POST",
           data:{view:view},
           dataType:"json",
           success:function(data)
            {
                $('#result').html(data.notification);
                if(data.unseen_notification > 0)
                {
                 $('.count').html(data.unseen_notification);
                }
            }
          });
    }
   load_unseen_notification();
 $(document).on('click', '.dropdown-toggle', function(){
 $('.count').html('');
 load_unseen_notification('yes');
 });

 setInterval(function(){ 
  load_unseen_notification();
 }, 5000);

});
</script>
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
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" id="dropdownMenuButton" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning count"></span>
            </a>
            <ul class="dropdown-menu extended notification drop">
                <li>
                    <p>Notifications</p>
                </li>
                <div id="result">

                </div>
               
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
        <?php 
            $uid = $_SESSION['uid'];
            $query = "SELECT * FROM users WHERE id={$uid}";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
        ?>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/avatars/<?php echo $row['avatar']?>" width='30px' height='30px'>
                <span class="username"><?php echo $row['username']?></span>
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
						<li><a href="appointments.php?type=0">Previous Appointments</a></li>
						<li><a href="appointments.php?type=1">Pending Appointments</a></li>
                        <?php if(!isset($_SESSION['did'])) : ?>
                            <li><a href="map.php">Book Appointment</a></li>
                        <?php endif; ?>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bullhorn"></i>
                        <span>Emergency</span>
                    </a>
                    <ul class="sub">
                        <li><a href="emergency.php?forme=1">For Me</a></li>
                        <li><a href="emergency.php?forme=0">For Other</a></li>
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
                <?php if(isset($_SESSION['drid'])) : ?>
                    <li>
                        <a href="receive.php">
                            <i class="fa fa-bullhorn"></i>
                            <span>Receive</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="allnotifications.php">
                        <i class="fa fa-user"></i>
                        <span>All Notifications</span>
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