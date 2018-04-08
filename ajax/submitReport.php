<?php include('../includes/connection.php');
    session_start();
	if($_FILES['file']['name'] != ''){
	  	$file = rand(1000,100000)."-".$_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $folder="../images/reports/";
        // new file size in KB
        $new_size = $file_size/1024; 
        // make file name in lower case
        $new_file_name = strtolower($file);
        $final_file=str_replace(' ','-',$new_file_name);
        //move_uploaded_file($file_loc,$folder.$final_file);
        if(move_uploaded_file($file_loc,$folder.$final_file))
        {    
        	$query = "INSERT INTO `report` (`aid`,`summary`,`report`,`prescription`)
                      VALUES('".$_POST['aid']."','".$_POST['summary']."','$final_file','".$_POST['prescription']."')";
            $result = mysqli_query($conn,$query);
            if($result)
            {
                echo "Report Sent Successfully";
                 $query1 = "SELECT `uid` FROM `appointments` WHERE `aid` = '".$_POST['aid']."'";
                    $res = mysqli_query($conn,$query1);
                    $row = mysqli_fetch_array($res);
                $notify = "INSERT INTO `notifications` (`uid`,`ntype`,`notified_by`) VALUES ('".$row['uid']."','DR', '".$_SESSION['uid']."')";
                    if(!mysqli_query($conn,$notify))
                    {
                        echo "failed";
                    }
            }
            else
            {
                echo mysqli_error($conn);
            }

        }
        else
        {
            $error = "Error sending Report";
        } 
	}
	else
	{
		echo "error";
	}
?>