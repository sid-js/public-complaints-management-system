<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "public_complaint_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo "Connection failed: " . $conn->connect_error;
  die("Connection failed: " . $conn->connect_error);
}
?>