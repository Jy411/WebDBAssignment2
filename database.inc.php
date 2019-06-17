<?php

$server = "localhost";
$user = "root";
$password = "root";
$myDB = "classDB";

global $conn;
$conn = new mysqli($server, $user, $password, $myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo '<script>console.log("Successfully Connected to DB")</script>';