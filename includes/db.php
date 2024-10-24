<?php
$host = "localhost"; // Your host
$user = "root";      // Your MySQL username
$password = "";      // Your MySQL password
$dbname = "blog";  // Databasegname

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
