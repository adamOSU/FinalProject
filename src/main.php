<?php
	session_start();

	echo $_SESSION["username"];
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
	}

	
echo '<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Final Project</title>
	</head>

	<body>
		<h1>Look at these movies!</h1>
	</body>

</html>';
?>
