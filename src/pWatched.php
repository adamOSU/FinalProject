<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_SESSION["username"];

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$output = "";
$output = "<table class=\"pure-table pure-table-horizontal\"><thead align=\"left\"><tr><th>Rank</th><th>Movie</th><th>Remove?</th></tr></thead>";

//The statement below pulls all of the movies a user has watched.  I join on the top100 table in order to get both the user and movie data.
$stmt = $mysqli->prepare("SELECT top100.id, top100.title, top100.rank, top100.year FROM top100 INNER JOIN watched on top100.id=watched.movieid where watched.username=? order by CAST(top100.rank AS SIGNED)");
$stmt->bind_param("s", $uname);
$stmt->execute();
$stmt->bind_result($id, $title, $rank, $year);
while ($stmt->fetch())
{
	//this formats the output in a way that makes it look nice on a table when printed
	$output .= "<tr><td><b>$rank</b></td><td>$title ($year)</td><td><a href=\"#\" name=\"id\" value=$id onclick=\"wRemove($id)\"><img src=\"img/Red_X.png\" height=\"18\" width=\"18\"></a></td></tr>";

}

$output .= "</table>";
echo $output;

$stmt->close();

?>