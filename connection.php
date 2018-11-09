<?php 
$servername = "localhost";
$username = "id7781225_yumyumbar";
$password = "castro95";
$database = "id7781225_yumyumbar";

/* laptop
$username = "root";
$password = "";
$database = "project_cereals";
*/

/* homestead
$username = "homestead";
$password = "secret";
$database = "project_cereals";
*/

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>