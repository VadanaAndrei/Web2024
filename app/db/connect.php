<?php
$host = "localhost";
$dbname = "FePA";
$username = "root";
$password = "1234";

$mysqli = new mysqli(hostname: $host,
    username: $username,
    password: $password,
    database: $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>
