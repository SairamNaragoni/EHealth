 <?php include('../includes/connection.php');
		$dr_id = $_POST['dr_id'];
		$query = "UPDATE driver SET avail=1 WHERE dr_id=$dr_id";
		$result=mysqli_query($conn,$query);
		$query = "DELETE FROM emergency WHERE dr_id=$dr_id";
		$result=mysqli_query($conn,$query);
 ?>