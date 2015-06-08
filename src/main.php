<?php
	session_start();  //This is used to save the username in a session.  This is how I determine if someone is logged in and how I prevent people from going to pages unless they are logged in.

	
	if(!isset($_SESSION['username']))  //redirects if no username is detected
	{
		header("Location: index.html");
	}

	$uname = $_SESSION["username"];


	
	//Below is the HTML for the main logged in page.  In contains several vital things:
	//1.  print100 is a function that is fired on pageload.  The code in the function prints the top100 movies, prints the watched movies for a user's account (if there are any)
	//and calculates and prints the statistics 
	//2. The function watched(str) is called when someone clicks on the green checkmark.  This uses AJAX to send the value of that movie to a separate php file where the movie is
	//added to a database where all watched movies are kept.  The AFI, watched list, and stats are all then updated on the page. 
	//3.  The wRemove function is called when someone clicks on a red x.  This uses AJAX to delete that movie from the database.  The lists and stats are then updated.
	//Other notes: I use the setTimeout function to create a slight delay as I found the lists were trying to print before the database was actually updated.

	echo "<!DOCTYPE html>
	<html>
		<head>
			<meta charset=\"UTF-8\">
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
		    <title>Top 100 Movie Tracker</title>
		    <link rel=\"stylesheet\" href=\"http://yui.yahooapis.com/pure/0.6.0/pure-min.css\">

		    <!--[if lte IE 8]>
		      
		        <link rel=\"stylesheet\" href=\"http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css\">
		      
		    <![endif]-->
		    <!--[if gt IE 8]><!-->
		      
		    <link rel=\"stylesheet\" href=\"http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css\">
		      
		    <!--<![endif]-->

		    <link rel=\"stylesheet\" href=\"http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\">
		      
		    <!--[if lte IE 8]>
		      <link rel=\"stylesheet\" href=\"marketing-old-ie.css\">
		    <![endif]-->
		     <!--[if gt IE 8]><!-->
		      <link rel=\"stylesheet\" href=\"marketing.css\">
		     <!--<![endif]-->
			
			
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

					var xmlhttp3 = new XMLHttpRequest();
					xmlhttp3.onreadystatechange = function() {
						if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200)
						{
							document.getElementById(\"stats\").innerHTML = xmlhttp3.responseText;
						}
					}
					xmlhttp3.open(\"GET\", \"stats.php\", true);
					xmlhttp3.send();

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

					var xmlhttp4 = new XMLHttpRequest();
					xmlhttp4.onreadystatechange = function() {
						if (xmlhttp4.readyState == 4 && xmlhttp4.status == 200)
						{
							document.getElementById(\"stats\").innerHTML = xmlhttp4.responseText;
						}
					}
					xmlhttp4.open(\"GET\", \"stats.php\", true);
					xmlhttp4.send();
					}, 200);
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

					var xmlhttp4 = new XMLHttpRequest();
					xmlhttp4.onreadystatechange = function() {
						if (xmlhttp4.readyState == 4 && xmlhttp4.status == 200)
						{
							document.getElementById(\"stats\").innerHTML = xmlhttp4.responseText;
						}
					}
					xmlhttp4.open(\"GET\", \"stats.php\", true);
					xmlhttp4.send();
					}, 200);
				}
			</script>

		</head>

<body>
	<div class=\"header\">
	    <div class=\"home-menu pure-menu pure-menu-horizontal pure-menu-fixed\">
	        <a class=\"pure-menu-heading\" href=\"index.html\">Top 100 Movie Tracker</a>
	    </div>
	</div>
	<br>
	<br>
	<br>
	
	<h2 align=\"center\">Welcome $uname! Click the green checkmark to add a movie to your watched list.</h2>

	<div class=\"pure-g-r\">
		<div class=\"pure-u-3-3\">
			<table align=\"center\">
				<thead align=\"center\"><tr><th>Unwatched AFI Top 100 Movies</th><th></th><th>Movies You've Watched</th><th></th><th>Stats</th></tr></thead>
				<tr>
					<td style=\"vertical-align:top\"><div id=\"top100\"></div></td>
					<td>&nbsp;</td>
					<td style=\"vertical-align:top\"><div id=\"watched\"></div></td>
					<td>&nbsp;</td>
					<td style=\"vertical-align:top\"><div id=\"stats\"></div></td>
				</tr>
			</table>
			
		</div>

	</div>

</body>

</html>";
?>
