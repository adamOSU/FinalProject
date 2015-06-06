<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: login.php");
}

$uname = $_SESSION["username"];

$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$output = "";
$output = "<table><tr><th>Rank</th><th>Movie</th><th>Remove?</th></tr>";

$stmt = $mysqli->prepare("SELECT top100.id, top100.title, top100.rank, top100.year FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=? order by CAST(top100.rank AS SIGNED)");
$stmt->bind_param("s", $uname);
$stmt->execute();
$stmt->bind_result($id, $title, $rank, $year);
while ($stmt->fetch())
{
	$output .= "<tr><td>$rank</td><td>$title ($year)</td><td><input type=\"checkbox\" name=\"wid\" value=$id onchange=\"wRemove(this.value)\"></td></tr>";
}

$output .= "</table>";
echo $output;

$stmt->close();

?>