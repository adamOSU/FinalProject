<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: login.php");
}

$uname = $_SESSION["username"];

	$output = "";
	$output = "<table class=\"pure-table pure-table-horizontal\"><thead align=\"left\"><tr><th>Rank</th><th>Movie</th><th>Watched?</th></tr></thead>";

	$mysqli = new mysqli("localhost", "root", "", "testdb");
	if ($mysqli->connect_errno)
	{
		echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
	}


	$stmt = $mysqli->prepare("SELECT id, title, rank, year FROM top100 where id NOT IN (SELECT movieid from watched where username=?)");
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($id, $title, $rank, $year);
	while ($stmt->fetch())
	{
		$output .= "<tr><td>$rank</td><td>$title ($year)</td><td><input type=\"checkbox\" name=\"id\" value=$id onchange=\"watched(this.value)\"></td></tr>";
	}
	$stmt->close();

	$output .= "</table>";
	echo $output;

?>