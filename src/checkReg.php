<?php
session_start();
	
$mysqli = new mysqli("localhost", "root", "", "testdb"); //establishes connection to the database
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$uname = $_REQUEST["username"];

$stmt = $mysqli->prepare("SELECT DISTINCT username FROM users");
$stmt->execute();
$stmt->bind_result($nameRes);
while ($stmt->fetch())
{
	if ($nameRes == $uname)  //checks each result to see if it matches, if it does, it prints an error
	{
		echo "<p style=\"color:red\">Username already taken. Please try another.</p>";
	}
}

$stmt->close();


?>