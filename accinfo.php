<?php
    $error = "";
    session_start();
    $id = $_SESSION['uid'];
    include("includes/connection.php");
    $query = "SELECT infoUpdated FROM `users` WHERE id = $id";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    if($row['infoUpdated']==1)
        header("Location: home.php");
    if (array_key_exists("submit", $_POST)) {
        if ($error == "") {
                $query = "SELECT id FROM `users` WHERE id = $id LIMIT 1";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $query = "UPDATE `users` SET
                                `phone` = '".mysqli_real_escape_string($conn, $_POST['phone'])."',
                                `emer1` = '".mysqli_real_escape_string($conn, $_POST['emer1'])."',
                                `emer2` = '".mysqli_real_escape_string($conn, $_POST['emer2'])."',
                                `addr` =  '".mysqli_real_escape_string($conn, $_POST['address'])."',
                                `dob` =  '".mysqli_real_escape_string($conn, $_POST['dob'])."',
                                `aadhar` = '".mysqli_real_escape_string($conn, $_POST['aadhar'])."',
                                `user_type` = '".mysqli_real_escape_string($conn, $_POST['accType'])."',
                                `pincode` = '".mysqli_real_escape_string($conn, $_POST['pincode'])."',
                                `bloodgroup` = '".mysqli_real_escape_string($conn, $_POST['bloodGroup'])."',
                                `medicalHis` = '".mysqli_real_escape_string($conn, $_POST['medicalHis'])."'
                                WHERE `id` = $id ";
                    if (!mysqli_query($conn, $query)) {
                        $error = "<p>Could not Update Info, Try again later.</p>";
                    } 
                    else {
                    	$info_query =  "SELECT user_type FROM `users` WHERE id = $id LIMIT 1";
                    	$info_result = mysqli_query($conn, $info_query);
                    	 while($row=mysqli_fetch_array($info_result))
                           {   
	                         $usertype = $row['user_type'];
                           }
                           if($usertype == 0) {
                             //user
                           	  $update_query = "UPDATE `users` 
                                SET infoUpdated = 1
		                                WHERE `id` = $id ";
		                        $result = mysqli_query($conn, $update_query);
		                        $error = "table Updated";
		                        header("Location: home.php");
                            }
                           elseif ($usertype == 1) {
                           	// driver
                            $_SESSION['drid'] = 1;
                           	header("Location: adv_info_driver.php");
                           }
                           else{
                           	//doctor
                            $_SESSION['did'] = 1;
                           	header("Location: adv_info_doc.php");
                           }                                  
                    }
                    
                } 
                else {
                    $error = "Sign Up For More";
                    header("Location: index.php");
                }                                          
        }        
    }
?>
<?php  
     	if(!isset($_SESSION['uid']))
        {
            header("Location: index.php"); 
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
		<form action="accinfo.php" method="post">
			<input type="number" class="ggg" name="phone" placeholder="PHONE" required="">
            <input type="number" class="ggg" name="emer1" placeholder="EMERGENCY CONTACT - 1" required="">
            <input type="number" class="ggg" name="emer2" placeholder="EMERGENCY CONTACT - 2" required="">
            <textarea class="form-control" rows="3" name="address">Enter Your Full Address</textarea>
            <input type="number" class="ggg" name="pincode" placeholder="PINCODE" required="">
            <input type="date" class="ggg" name="dob" placeholder="DOB" required="">
            <input type="number" class="ggg" name="aadhar" placeholder="AADHAR NO" required="">
            <div class="form-group">
              <label for="bloodGroup"><h4>Blood Group</h4></label>
                <select class="form-control" id="bloodGroup" name="bloodGroup">
                  <option value="NA">NA</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="form-group">
              <label for="type"><h4>Acc Type</h4></label>
                <select class="form-control" id="accType" name="accType">
                  <option value="0">User/Patient</option>
                  <option value="1">Driver</option>
                  <option value="2">Doctor</option>
                </select>
            </div>
            <textarea class="form-control" rows="3" name="medicalHis">Enter Your Previous Medical history</textarea>
			<div class="clearfix"></div>
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