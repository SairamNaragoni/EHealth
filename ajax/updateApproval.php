<?php include('../includes/connection.php');
		$aid = $_POST['aid'];
		$query = "UPDATE `appointments` SET approval = 1 WHERE aid=$aid";
		mysqli_query($conn,$query);
 ?>