<?php
session_start();
if(isset($_POST["view"]))
{
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
	        	$output .=
	        	 '<li>
                  <div class="alert alert-info clearfix">
                      <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                         <div class="noti-info">
                           <a href="#">Need Blood Urgently</a>
                        </div>
                   </div>
                 </li>' ;
             }
      }  
    $output .= '<li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#">See All Notifications</a>
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
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>
