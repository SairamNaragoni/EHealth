<?php
	session_start();
	session_unset();
	session_destroy();
	header("location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
</head>
<body>
</body>
</html>