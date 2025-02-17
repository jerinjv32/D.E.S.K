<?php
// db.php

$servername = "localhost"; // Typically 'localhost' or your server's IP
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "login_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




