<?php
    if(isset($_SESSION['uid']))
    {
            header("Location: home.php"); 
    }
 ?>
 <?php
    function mailUser($email,$hash)
    {
        $to=$email;
        $subject="Your confirmation link is here :";
        $header="From:";
        $message="Click the link below to activate your account\n\n http://localhost/EHealthC/confirmMail.php?email=$email&hash=$hash";
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail){
            $error = "Your Activation link Has Been Sent To Your Email Address.";
        }
        else {
            $error =  "Cannot send Activation link to your E-mail address";
        }
        return $error;
    }
  ?>
<?php
    $error = "";      
    if (array_key_exists("submit", $_POST)) {
        include("includes/connection.php");
        if (!$_POST['email']) {        
            $error .= "*An Email is required<br>";            
        }        
        if (!$_POST['password']) {           
            $error .= "*A Password is required<br>";           
        }        
        if ($error == "") {                           
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $error = "User with that Email already exists.";
                } 
                else {
                    $hash = md5( rand(0,1000) );
                    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
                    {
                        $target = "images/avatars/".basename($_FILES['image']['name']);
                        $image = $_FILES['image']['name'];
                    }
                    else
                    {
                        $image = '0';
                    }
                    $query = "INSERT INTO `users` (`username`,`email`, `password`,`hash`,`avatar`) VALUES ('".mysqli_real_escape_string($conn, $_POST['username'])."','".mysqli_real_escape_string($conn, $_POST['email'])."', '".mysqli_real_escape_string($conn, $_POST['password'])."','".mysqli_real_escape_string($conn, $hash)."','$image')";
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                        $error = "Failed to upload image";
                    }
                    if (!mysqli_query($conn, $query)) {
                        $error = "<p>Could not sign you up - please try again later.</p>";
                    } 
                    else {
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($conn)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($conn)." LIMIT 1";                        
                        $id = mysqli_insert_id($conn);                   
                        mysqli_query($conn, $query);                     
                        //session_start();
                        //$_SESSION['uid'] = $id;
                        //header("Location: index.php");
                        $error = mailUser($_POST['email'],$hash);
                        
                    }
                }                 
        }        
    }
?>
<!DOCTYPE html>
<head>
<title>EHealth | Sign Up</title>
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
<div class="reg-w3">
<div class="w3layouts-main">
	<h2>Register Now</h2>
		<div id="error">
            <?php if ($error!="") {
                echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
            } ?>  
        </div>
		<form action="signup.php" method="post"  enctype="multipart/form-data">
			<input type="text" class="ggg" name="username" placeholder="NAME" required="">
			<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<label for="image">Choose your Profile pic :</label>
            <input type="file" name="image" class="form-control-file">
            <br>
			<h4><input type="checkbox" required="" />I agree to the Terms of Service and Privacy Policy</h4>
			<div class="clearfix"></div>
			<input type="submit" value="submit" name="submit">
		</form>
		<p>Already Registered ? <a href="login.php">Login</a></p>
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
