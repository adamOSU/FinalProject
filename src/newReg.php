<?php
//If the user has successfully put in a unique username and matching passwords, their information is added to the user database and they are redirected to the main user page to start to use
//the actual movie database.
session_start();

if(!isset($_SESSION['username']))
{
	header("Location: index.html");
}

$uname = $_POST["username"];
$pword = $_POST["pass"];

$_SESSION["username"] = $uname;

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
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