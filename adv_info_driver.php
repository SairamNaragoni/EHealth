<?php
    $error = "";
    session_start();
    $id=$_SESSION['uid'];
    include("includes/connection.php");
    if(isset($_POST['license'])){
         $query = "INSERT INTO `driver` (`uid`,`driving_license`,`vehicle_no`) VALUES ( '".$id."' , '".$_POST['license']."' , '".$_POST['vehicleno']."')";
         if (!mysqli_query($conn, $query)) {
               $error = "<p>Could not Update Info, Try again later.</p>";
          } 
        else{
           $update_query = "UPDATE `users` 
                                SET infoUpdated = 1
                                    WHERE `id` = $id ";
            $result = mysqli_query($conn, $update_query);
            $error = "table Updated";
            header("Location: home.php");
        }
    }
?>
<!DOCTYPE html>
<head>
<title>EHealth | Sign In</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
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
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h3>Complete The Account Info to proceed further</h3>
		<div id="error">
                    <?php if ($error!="") {
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    } ?>  
        </div>
		<form action="adv_info_driver.php" method="post">
			<input type="text" class="ggg" name="license" placeholder="LICENCE NO" required="">
      <input type="text" class="ggg" name="vehicleno" placeholder="VEHICLE NO" required="">
      

			<input type="submit" value="Submit" name="submit">
		</form>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>