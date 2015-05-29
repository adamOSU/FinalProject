<?php
session_start();

$uname = $_POST["username"];
$pword = $_POST["pass"];

$_SESSION["username"] = $uname;

$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $uname, $pword);
$stmt->execute();
$stmt->close();

header("Location: main.php");




?>