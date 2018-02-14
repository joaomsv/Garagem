<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$db = "garagem";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
