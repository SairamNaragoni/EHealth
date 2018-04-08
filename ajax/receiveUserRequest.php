 <?php include('../includes/connection.php');
		$dr_id = $_POST['dr_id'];
		$emer_query = "SELECT * FROM `emergency` WHERE dr_id = $dr_id";
		$emer_result = mysqli_query($conn,$emer_query);
		$emer_rows = mysqli_num_rows($emer_result);
		if($emer_rows > 0)
		{	
			$emer_row = mysqli_fetch_array($emer_result);
			$hid = $emer_row['hid'];
			$dest = $emer_row["dest_reached"];
			if($hid==null){
			$hid = -1;
			}
			$uid = $emer_row['uid'];
			$user_query = "SELECT * FROM `users` WHERE id = $uid ";
			$user_result = mysqli_query($conn,$user_query);
			$user_row = mysqli_fetch_array($user_result);
			$return_arr[] = array("lat" => $emer_row['elat'],
                    "lng" => $emer_row['elng'],
                    "username" => $user_row['username'],
                    "hid" => $hid,
                    "phone" => $user_row['phone'],
					"dest_reached" => $dest);
			echo json_encode($return_arr);
		}
		else
		{
			echo 0;
		}
		
 ?>