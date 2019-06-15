<?php

$server = "localhost";
$user = "root";
$password = "root";
$myDB = "classDB";

$conn = mysqli_connect($server, $user, $password, $myDB);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo '<script>console.log("Successfully Connected to DB")</script>';