<?php
	session_start();

	
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
	}

	$uname = $_SESSION["username"];


	
	echo "<!DOCTYPE html>
	<html>
		<head>
			<meta charset=\"UTF-8\">
			<title>Final Project</title>
			<script>
				function print100()
				{

					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							document.getElementById(\"top100\").innerHTML = xmlhttp.responseText;
						}
					}
					xmlhttp.open(\"GET\", \"p100.php\", true);
					xmlhttp.send();
				}

				window.onload = print100();
			</script>
		</head>

		<body>
			<h1>Hey $uname, Look at these movies!</h1>
<br>
<div id=\"top100\"></div>
				</body>

	</html>";
?>
