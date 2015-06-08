<?php
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "dejonga-db", "KlZLMGQrHb0blbkw", "dejonga-db");
if ($mysqli->connect_errno)
{
	echo "Connection error ".$mysqli->connect_errno ." ".$mysqli->connect_error;
}
else
{
	echo "Connection worked!";
}

$createTable = "CREATE TABLE users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL
	)";

if (mysqli_query($mysqli, $createTable))
{
	echo "Table created!";
}
else
{
	echo "Error in creating table :(";
}

/*
$addMovie = "INSERT INTO Movies (name, category, length, rented)
VALUES ('Indiana Jones', 'Action', 100, 0)";

if (mysqli_query($mysqli, $addMovie)) {
    echo "Movie added";
} else {
    echo "Error: " . $addMovie . "<br>" . mysqli_error($mysqli);
}
*/
?>