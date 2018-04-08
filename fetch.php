<?php
session_start();

if(isset($_POST["view"]))
{   $error = "false";
    include("includes/connection.php");
    if($_POST["view"] != '')
    {
	  $update_query = "UPDATE `notifications` SET `notify_read`=1 WHERE `uid` = '".$_SESSION['uid']."' AND `notify_read`= 0 ";
	  mysqli_query($conn, $update_query);
    }
    $query = "SELECT * FROM `notifications` WHERE `uid` = '".$_SESSION['uid']."'
              ORDER BY `notify_time` DESC LIMIT 5";
	 $result = mysqli_query($conn, $query);
	 $output = "";
	 if(mysqli_num_rows($result) > 0)
	 {
	  while($row = mysqli_fetch_array($result))
	  {    
	        if($row['ntype'] == "EB")
	        {  
	        	$query1 = "SELECT * FROM `hospital` WHERE 	`h_id` = '".$row['notified_by']."' ";
	        	$result1 = mysqli_query($conn,$query1);
                $error="ok";
	        	$query2 = "SELECT `bloodgroup` FROM `users` WHERE id= '".$row['uid']."' ";
	        	$result2 = mysqli_query($conn,$query2);
	        	$row2 = mysqli_fetch_array($result2);

	        	if($row1 = mysqli_fetch_array($result1))
	        	{   
	        		
	        		$hospital_name = $row1['hname'];
	        		$phno = $row1['hphone'];

	        		$output .=
		        	 '<li>
	                  <div class="alert alert-info clearfix">
	                      <span class="alert-icon"><i class="fa fa-bolt"></i></span>
	                         <div class="noti-info">
	                           <a href="#">Need '.$row2['bloodgroup'].'Blood Urgently<br/>Hospital:'.$hospital_name.'<br/>Contact: '.$phno.'</a>
	                        </div>
	                   </div>
	                 </li>' ;

	        	}
	        	else
	        	{
	        		echo "Error";
	        	}
	        	
             }
             elseif($row['ntype'] == "DA")
             {
                 $query1 = "SELECT * FROM `users` WHERE `id` = '".$row['notified_by']."' ";
                 $result1 = mysqli_query($conn,$query1);
                 if($row1 = mysqli_fetch_array($result1))
	        	{   
	        		
	        		$doctor = $row1['username'];
	        		$phno = $row1['phone'];

	        		$output .=
		        	 '<li>
	                  <div class="alert alert-info clearfix">
	                      <span class="alert-icon"><i class="fa fa-bolt"></i></span>
	                         <div class="noti-info">
	                           <a href="#">Appointment Confirmed:<br/>Doctor:'.$doctor.'<br/>Phno.'.$phno.'</a>
	                        </div>
	                   </div>
	                 </li>' ;

	        	}
	        	else
	        	{
	        		echo "Error";
	        	}
                 
                 
             }
             elseif($row['ntype'] == "DR")
             {
                
                  $query1 = "SELECT * FROM `users` WHERE `id` = '".$row['notified_by']."' ";
                 $result1 = mysqli_query($conn,$query1);
                 if($row1 = mysqli_fetch_array($result1))
	        	{   
	        		
	        		$doctor = $row1['username'];
	        		$phno = $row1['phone'];

	        		$output .=
		        	 '<li>
	                  <div class="alert alert-info clearfix">
	                      <span class="alert-icon"><i class="fa fa-bolt"></i></span>
	                         <div class="noti-info">
	                           <a href="#">Report Sent:<br/>Doctor:'.$doctor.'<br/>Phno.'.$phno.'</a>
	                        </div>
	                   </div>
	                 </li>' ;

	        	}
	        	else
	        	{
	        		echo "Error";
	        	}
             }
      }  
    $output .= '<li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="allnotifications.php">See All Notifications</a>
                        </div>
                    </div>
                </li>';
 }
 else
 {

  $output .=  '<li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#">No Notification....</a>
                        </div>
                    </div>
                </li>';
 }

 $query_1 = "SELECT * FROM `notifications` WHERE  `uid` = '".$_SESSION['uid']."' AND `notify_read`=0 ";
 $result_1 = mysqli_query($conn, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count,
  'error' => $error
 );
 echo json_encode($data);
}
?>
