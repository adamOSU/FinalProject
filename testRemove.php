<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: login.php");
}

$uname = "adam";

$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$id = '1';


$stmt = $mysqli->prepare("DELETE FROM watched WHERE movieid=? AND username=?");
$stmt->bind_param("ss", $id, $uname);
$stmt->execute();
$stmt->close();


?>