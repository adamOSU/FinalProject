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

					var xmlhttp2 = new XMLHttpRequest();
					xmlhttp2.onreadystatechange = function() {
						if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
						{
							document.getElementById(\"watched\").innerHTML = xmlhttp2.responseText;
						}
					}
					xmlhttp2.open(\"GET\", \"pWatched.php\", true);
					xmlhttp2.send();

				}
				
				function watched(str)
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
						
						}
					}
					xmlhttp.open(\"GET\", \"addWatched.php?id=\" + str, true);
					xmlhttp.send();

					
					setTimeout(function()
					{
					var xmlhttp2 = new XMLHttpRequest();
					xmlhttp2.onreadystatechange = function() {
						if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
						{
							document.getElementById(\"watched\").innerHTML = xmlhttp2.responseText;
						}
					}
					xmlhttp2.open(\"GET\", \"pWatched.php\", true);
					xmlhttp2.send();

					var xmlhttp3 = new XMLHttpRequest();
					xmlhttp3.onreadystatechange = function() {
						if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200)
						{
							document.getElementById(\"top100\").innerHTML = xmlhttp3.responseText;
						}
					}
					xmlhttp3.open(\"GET\", \"p100.php\", true);
					xmlhttp3.send();
					}, 100);
				}

			</script>
			<script>
				window.onload = print100();
			</script>
			<script>
				function wRemove(str2)
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
						
						}
					}
					xmlhttp.open(\"GET\", \"remove.php?id=\" + str2, true);
					xmlhttp.send();

					setTimeout(function()
					{
					var xmlhttp2 = new XMLHttpRequest();
					xmlhttp2.onreadystatechange = function() {
						if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
						{
							document.getElementById(\"watched\").innerHTML = xmlhttp2.responseText;
						}
					}
					xmlhttp2.open(\"GET\", \"pWatched.php\", true);
					xmlhttp2.send();

					var xmlhttp3 = new XMLHttpRequest();
					xmlhttp3.onreadystatechange = function() {
						if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200)
						{
							document.getElementById(\"top100\").innerHTML = xmlhttp3.responseText;
						}
					}
					xmlhttp3.open(\"GET\", \"p100.php\", true);
					xmlhttp3.send();
					}, 100);
				}
			</script>

		</head>

		<body>
			<h1>Hey $uname, Look at these movies!</h1>
<br>
<table>
<tr>
<td style=\"vertical-align:top\"><div id=\"top100\"></div></td><td style=\"vertical-align:top\"><div id=\"watched\"></div></td></tr>
</table>
				</body>

	</html>";
?>
