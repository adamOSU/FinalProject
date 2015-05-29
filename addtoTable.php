<?php
ini_set('display_errors', 'On');

$mysqli = new mysqli("localhost", "root", "", "testdb");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}
else
{
	echo "Connection worked!";
}


$addUser = "INSERT INTO users (username, password)
VALUES ('adam', 'password')";

if (mysqli_query($mysqli, $addUser)) {
    echo "User added";
} else {
    echo "Error: " . $addUser . "<br>" . mysqli_error($mysqli);
}

?>