<?php
$mysqli = new mysqli("localhost", "root", "", "testdb");
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
	if ($nameRes == $uname)
	{
		echo "Taken";
	}
}

$stmt->close();


?>