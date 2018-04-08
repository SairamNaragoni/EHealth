 <?php include('../includes/connection.php');
		$dr_id = $_POST['dr_id'];
		$h_id = $_POST['hid'];
		$query = "UPDATE emergency SET hid='$h_id' WHERE dr_id=$dr_id";
		$result=mysqli_query($conn,$query);
		$return_arr[] = array(
                    "hid" => $h_id);
			echo json_encode($return_arr);
 ?>