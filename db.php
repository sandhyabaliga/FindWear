<?php

// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "findwear";

// Create Connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check Connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Uncomment this line to test the connection
// echo "Database Connected Successfully!";

?>