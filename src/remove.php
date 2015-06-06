<?php
session_start();
	
if(!isset($_SESSION['username']))
{
	header("Location: login.php");
}

$uname = $_SESSION["username"];

echo "alert($uname)";

$mysqli = new mysqli("localhost", "root", "", "testdb");
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