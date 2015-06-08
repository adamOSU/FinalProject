<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_SESSION["username"];

	$output = "";
	$output = "<table class=\"pure-table pure-table-horizontal\"><thead align=\"left\"><tr><th>Rank</th><th>Movie</th><th>Watched?</th></tr></thead>";

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
	if ($mysqli->connect_errno)
	{
		echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
	}


	$stmt = $mysqli->prepare("SELECT id, title, rank, year FROM top100 where id NOT IN (SELECT movieid from watched where username=?)");  //This prints out all of the top 100 movies that a user has not watched
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($id, $title, $rank, $year);
	while ($stmt->fetch())
	{
		//this formats the output in a way that makes it look nice on a table when printed
		$output .= "<tr><td><b>$rank</b></td><td>$title ($year)</td><td><a href=\"#\" name=\"id\" value=$id onclick=\"watched($id)\"><img src=\"img/Check_mark.png\" height=\"21\" width=\"21\"></a></td></tr>";
	}
	$stmt->close();

	$output .= "</table>";
	echo $output;

?>