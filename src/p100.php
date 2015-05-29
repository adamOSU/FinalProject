<?php
session_start();

	$output = "";
	$output = "<table><tr><th>Rank</th><th>Movie</th></tr>";

	$mysqli = new mysqli("localhost", "root", "", "testdb");
	if ($mysqli->connect_errno)
	{
		echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
	}


	$stmt = $mysqli->prepare("SELECT title, rank, year FROM top100");
	$stmt->execute();
	$stmt->bind_result($title, $rank, $year);
	while ($stmt->fetch())
	{
		$output .= "<tr><td>$rank</td><td>$title ($year)</td></tr>";
	}
	$stmt->close();

	$output .= "</table>";
	echo $output;

?>