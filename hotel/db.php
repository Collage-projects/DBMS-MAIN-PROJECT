<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotels";
$port = 3307; // Add this line to specify the port

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
