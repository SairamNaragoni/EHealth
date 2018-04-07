<?php include('includes/connection.php');
		session_start();
		$uid = $_SESSION['uid'];
		$did = $_GET['did'];
		$symptoms = $_POST['symptoms'];
		$date = $_POST['datein'];
		$query = "INSERT INTO `appointments` (`uid`,`did`,`date`,`reason`) VALUES ('".mysqli_real_escape_string($conn, $uid)."','".mysqli_real_escape_string($conn,$did)."', '".mysqli_real_escape_string($conn, $date)."','".mysqli_real_escape_string($conn, $symptoms)."')";
		mysqli_query($conn,$query);
		header("Location: appointments.php?type=1");
 ?>