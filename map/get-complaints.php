<?php
// Database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');

// Fetch data from database
$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

echo json_encode($data);

$conn->close();
?>