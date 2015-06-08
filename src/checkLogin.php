<?php
//This file takes the login username and password and checks it against the users database.  If they match, it redirects them to the main user page.  If it doesn't match, it alerts then and they are 
//auto-redirected to the login page to try again.
session_start();

$uname = $_POST["username"];
$pword = $_POST["pass"];



$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
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