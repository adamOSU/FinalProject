<?php
//This file calculates and prints all of the statistics found on the main.php page.
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_SESSION["username"];

$output = "";
$output = "<table class=\"pure-table pure-table-horizontal\">";

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
	if ($mysqli->connect_errno)
	{
		echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
	}


	$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT movieid) from watched where movieid<11 and username=?"); //This counts how many of the top 10 movies a user has seen
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($totten);
	while ($stmt->fetch())
	{
		$topTen = $totten;
	}

	$topTen = $topTen."0%";
	$output .= "<tr><td>You've watched $topTen of the Top 10</td></tr>";


	$stmt = $mysqli->prepare("SELECT COUNT(DISTINCT movieid) from watched where username=?");  //This counts how many total unique movies a person has seen
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($total);
	while ($stmt->fetch())
	{
		$totPer = $total;
	}

	$totPer = $totPer."%";
	$output .= "<tr><td>You've watched $totPer of the Top 100</td></tr>";

	$stmt = $mysqli->prepare("SELECT MIN(top100.year) FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=?");  //This finds the oldest movie a person has watched
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$stmt->bind_result($minYear);
	while ($stmt->fetch())
	{
		$minWatch = $minYear;
	}

	
	$output .= "<tr><td>Oldest movie watched: $minWatch</td></tr>";

	$stmt = $mysqli->prepare("SELECT MAX(top100.year) FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=?");  //This finds the most recent top 100 movie a person has watched
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