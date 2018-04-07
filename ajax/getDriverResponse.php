<?php
    function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 )
     {  
          $earth_radius = 6371;
          $dLat = deg2rad( $latitude2 - $latitude1 );  
          $dLon = deg2rad( $longitude2 - $longitude1 );  
          $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
          $c = 2 * asin(sqrt($a));  
          $d = $earth_radius * $c;  
          return $d;  
      }
 ?>
 <?php include('../includes/connection.php');
		$emer_id = $_POST['emer_id'];
		$query = "SELECT * FROM `emergency` WHERE emer_id = $emer_id";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		if($row['approval']!=1)
		{
			$driver_query = "SELECT * FROM `driver`";
			$driver_result = mysqli_query($conn,$driver_query);
			$dmin =1000000000;
			$dr_id=-1;
			while($driver_row = mysqli_fetch_array($driver_result))
			{
					$d = getDistance($row['elat'],$row['elng'],$driver_row['lat'],$driver_row['lng']);
					if($driver_row['avail']==1 && $d<$dmin)
					{
						$dmin = $d;
						$dr_id = $driver_row['dr_id'];
					}
			}
			if($dr_id==-1)
			{
				echo "0";
			}
			else
			{
				$update_query = "UPDATE `driver` SET avail = 0 WHERE dr_id = $dr_id LIMIT 1";
				mysqli_query($conn,$update_query);
				$update_query = "UPDATE `emergency` SET dr_id = $dr_id,approval=1 WHERE emer_id = $emer_id LIMIT 1";
				mysqli_query($conn,$update_query);

				$query = "SELECT * FROM `driver` WHERE dr_id = $dr_id";
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_array($result);
				$uid = $row['uid'];
				$user_query = "SELECT * FROM `users` WHERE id = $uid";
				$user_result = mysqli_query($conn,$user_query);
				$user_row = mysqli_fetch_array($user_result);
				echo '<br><h3>The Driver Available :'.$user_row['username'].' </h3>' ;
	            echo '<p>Vehicle No :'.$row['vehicle_no'].' </p>';
	            echo '<p>Phone No :'.$user_row['phone'].' </p>';
			}
		}
		else {
			$dr_id = $row['dr_id'];
			$query = "SELECT * FROM `driver` WHERE dr_id = $dr_id";
				$result = mysqli_query($conn,$query);
				$row = mysqli_fetch_array($result);
				$uid = $row['uid'];
				$user_query = "SELECT * FROM `users` WHERE id = $uid";
				$user_result = mysqli_query($conn,$user_query);
				$user_row = mysqli_fetch_array($user_result);
				echo '<br><h3>The Driver Available :'.$user_row['username'].' </h3>' ;
	            echo '<p>Vehicle No :'.$row['vehicle_no'].' </p>';
	            echo '<p>Phone No :'.$user_row['phone'].' </p>';
			echo "<p>Driver On the Way</p>";
		}	
 ?>