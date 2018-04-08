<?php include('../includes/connection.php'); 
include('way2sms_api.php');
?>

<?php
	$dr_id = $_POST['dr_id'];
	$query = "SELECT * FROM `emergency` WHERE dr_id = $dr_id ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result);
	$uid = $row['uid'];
	$uquery = "SELECT * FROM `users` WHERE id = $uid ";
	$uresult = mysqli_query($conn,$uquery);
	$urow = mysqli_fetch_array($uresult);
	$emer1 = $urow['emer1'];
	$emer2 = $urow['emer2'];
	$name = $urow['username'];
	
	//sms those two members

	$drquery = "SELECT * FROM `driver` WHERE `dr_id` = '".$dr_id."' ";
	$dr_result = mysqli_query($conn,$drquery);
	$dr_row = mysqli_fetch_array($dr_result);
	$userid = $dr_row['uid'];

	$userquery = "SELECT * FROM `users` WHERE `id` = '".$userid."' ";
	$user_result = mysqli_query($conn,$userquery);
	$user_row = mysqli_fetch_array($user_result);
	$driverno = $user_row['phone'];
	$drivername = $user_row['username'];



    $uid = 8332977980;
	$pwd   = "N8632C";
    
	$msg = "Your Relative ".$name." Is in Emergency Condition . Contact:".$drivername." Mobile:".$driverno." ";
	
    
    $res = sendWay2SMS($uid, $pwd, $emer1, $msg);
	if (is_array($res))
	echo $res[0]['result'] ? 'Message sent successfully!!!' : 'Try Again Later !! Sorry';


    $res = sendWay2SMS($uid, $pwd, $emer2, $msg);
	if (is_array($res))
	echo $res[0]['result'] ? 'Message sent successfully!!!' : 'Try Again Later !! Sorry';
	

?>