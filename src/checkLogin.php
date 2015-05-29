<?php
session_start();

$uname = $_POST["username"];
$pword = $_POST["pass"];



$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}

$uname = $_REQUEST["username"];

$stmt = $mysqli->prepare("SELECT username, password FROM users");
$stmt->execute();
$stmt->bind_result($nameRes, $pRes);
while ($stmt->fetch())
{
	if ($nameRes == $uname && $pRes == $pword)
	{
		$_SESSION["username"] = $uname;
		header("Location: main.php");
	}
}

$stmt->close();

echo '<script language="javascript">alert("That username/password combination is incorrect")</script>';
echo '<script language="javascript">window.location.assign("login.html")</script>';

?>