<?php include('../includes/connection.php'); ?>
<?php
	$dr_id = $_POST['dr_id'];
	$query = "SELECT * FROM `emergency` WHERE dr_id = $dr_id ";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result);
	$uid = $row['uid'];
	$uquery = "SELECT * FROM `users` WHERE id = $uid ";
	$uresult = mysqli_query($conn,$uquery);
	$urow = mysqli_fetch_array($ruesult);
	$emer1 = $urow['emer1'];
	$emer2 = $urow['emer2'];
	//sms those two members


	//sms done
	$uquery = "UPDATE `emergency` SET dest_reached = 1 WHERE dr_id = $dr_id";
	mysqli_query($conn,$uquery);
	// $uquery = "UPDATE `driver` SET avail = 1 WHERE dr_id = $dr_id";
	// mysqli_query($conn,$uquery);
	// $dquery = "DELETE FROM `emergency` WHERE dr_id = $dr_id ";
	// $dresult = mysqli_query($conn,$dquery);
	// $drow = mysqli_fetch_array($dresult);
?>