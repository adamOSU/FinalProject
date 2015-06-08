<?php
//This php function takes the username and ID of the movie and adds it to the watched movie database to track what a user has watched.
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_SESSION["username"];

$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$id = $_REQUEST["id"];

$stmt = $mysqli->prepare("INSERT INTO watched (username, movieid) VALUES (?, ?)");
$stmt->bind_param("ss", $uname, $id);
$stmt->execute();


$stmt->close();


?>