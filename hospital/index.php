<?php
    $error = ""; 
    if (isset($_POST['submit'])) {
        include("includes/connection.php");
        if (!$_POST['email']) {
            $error .= "*An Email is required<br>";
        } 
        if (!$_POST['password']) {
            $error .= "*A Password is required<br>"; 
        } 
        if ($error == "") {
                    $query = "SELECT * FROM `hospital` WHERE hmail = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                    if (isset($row)) {
                        if($row['active']==1)
                        {
                            $hashedPassword = md5(md5($row['h_id']).$_POST['password']);
                            if ($hashedPassword == $row['hpassword']) {
                                session_start();
                                $_SESSION['h_id'] = $row['h_id'];
                                header("Location: profile.php");

                            } else {                            
                                $error = "That email/password combination could not be found.";                            
                            }
                        }
                        else
                        {
                            $error = "Activate Your Account to login.Check your registered email";     
                        }    
                    } else {                        
                        $error = "That email/password combination could not be found.";                        
                    }                                                
        }        
    }
?>
<?php
        session_start();
        if(isset($_SESSION['h_id']))
        {
            header("Location: profile.php");
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
	<h2>Sign In Now</h2>
		<div id="error">
                    <?php if ($error!="") {
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    } ?>  
        </div>
		<form action="index.php" method="post">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="submit">
		</form>
		<p>Don't Have an Account ?<a href="signup.php">Create an account</a></p>
        <p>Normal user?<a href="../">User Login</a></p>
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