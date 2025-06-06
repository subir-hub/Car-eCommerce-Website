<?php 
$host = "localhost";
$userName = "root";
$password = "";
$dbName = "projects";

$conn = new mysqli($host, $userName, $password, $dbName);

if($conn->connect_error) {
    echo "Connection failed " . $conn->connect_error;
    exit;
}
?>