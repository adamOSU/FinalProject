<?php
//This is the file that deletes an entry in the watched database if a user has clicked on a red x to remove an item from their watched list.
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_SESSION["username"];

echo "alert($uname)";

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$id = $_REQUEST["id"];

$sid = (string) $id;
$suname = (string) $uname;

$stmt = $mysqli->prepare("DELETE FROM watched WHERE movieid=?");
$stmt->bind_param("s", $sid);
$stmt->execute();
$stmt->close();


?>