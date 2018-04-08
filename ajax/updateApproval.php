
<?php include('../includes/connection.php');
                session_start();
		$aid = $_POST['aid'];
		$query = "UPDATE `appointments` SET approval = 1 WHERE aid=$aid";
		mysqli_query($conn,$query);
         echo $_SESSION['uid'];
        //sending notifications to user
        $query1 = "SELECT `uid` FROM `appointments` WHERE `aid` = '".$aid."'";
        $res = mysqli_query($conn,$query1);
        $row = mysqli_fetch_array($res);
        $notify = "INSERT INTO `notifications` (`uid`,`ntype`,`notified_by`) VALUES ('".$row['uid']."','DA', '".$_SESSION['uid']."')";
        if(!mysqli_query($conn,$notify))
        {
        	echo "failed";
        }
 ?>