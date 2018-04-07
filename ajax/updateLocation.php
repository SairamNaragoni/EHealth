 <?php include('../includes/connection.php');
		$dr_id = $_POST['dr_id'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$dr_query = "UPDATE `driver` SET lat = $lat,lng = $lng WHERE dr_id = $dr_id";
		$dr_result = mysqli_query($conn,$dr_query);
 ?>