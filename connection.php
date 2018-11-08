<?php 
$servername = "localhost";
$username = "root";
$password = "";
//$username = "homestead";
//$password = "secret";
$database = "project_cereals";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>