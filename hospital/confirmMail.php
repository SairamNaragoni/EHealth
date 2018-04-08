<?php
	include("includes/connection.php");
	$email = $_GET['email'];
	$hash = $_GET['hash'];
	$query = "SELECT * FROM `hospital` WHERE hmail = '".mysqli_real_escape_string($conn, $email)."' AND `hash` = '".mysqli_real_escape_string($conn, $hash)."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if (isset($row)) {
        if($row['active']==1)
        {
            echo "This link is already used up or expired.Login To Continue";
            header("Location: index.php");
        }
        else
        {
            echo "redirecting to home page";
            $update_query = "UPDATE `hospital` 
                                SET `active` = 1,
                                    `hash` = 0
                                WHERE hmail = '".mysqli_real_escape_string($conn, $email)."' ";
            $result = mysqli_query($conn, $update_query);
            session_start();
            $_SESSION['h_id'] = $row['h_id'];
            header("Location: profile.php");
        }                              
    } 
    else 
    {                        
        echo "User Doesnt exist or link expired.Try Again";                 
    }           
 ?>