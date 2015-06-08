<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: login.php");
}

$uname = $_SESSION["username"];

$output = "";
$output = "<table class=\"pure-table pure-table-horizontal\">";

	$mysqli = new mysqli("localhost", "root", "", "testdb");
	if ($mysqli->connect_errno)
	{
		echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
	}


	$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT movieid) from watched where movieid<11 and username=?");
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($totten);
	while ($stmt->fetch())
	{
		$topTen = $totten;
	}

	$topTen = $topTen."0%";
	$output .= "<tr><td>You've watched $topTen of the Top 10</td></tr>";


	$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT movieid) from watched where username=?");
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($total);
	while ($stmt->fetch())
	{
		$totPer = $total;
	}

	$totPer = $totPer."%";
	$output .= "<tr><td>You've watched $totPer of the Top 100</td></tr>";

	$stmt = $mysqli->prepare("SELECT MIN(top100.year) FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=?");
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($minYear);
	while ($stmt->fetch())
	{
		$minWatch = $minYear;
	}

	
	$output .= "<tr><td>Oldest movie watched: $minWatch</td></tr>";

	$stmt = $mysqli->prepare("SELECT MAX(top100.year) FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=?");
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($maxYear);
	while ($stmt->fetch())
	{
		$maxWatch = $maxYear;
	}

	
	$output .= "<tr><td>Newest movie watched: $maxWatch</td></tr>";






$output .= "</table>";
echo $output;



$stmt->close();
?>