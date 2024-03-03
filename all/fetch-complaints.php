<?php
// Include database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');

// Pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$resultsPerPage = isset($_GET['resultsPerPage']) ? $_GET['resultsPerPage'] : 6;
$startIndex = ($page - 1) * $resultsPerPage;

// Fetch complaints from the database
$sql = "SELECT * FROM complaints LIMIT $startIndex, $resultsPerPage";
$result = mysqli_query($conn, $sql);

// Check if there are more complaints available
$sqlCount = "SELECT COUNT(id) AS total FROM complaints";
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalComplaints = $rowCount['total'];
$hasMore = ($totalComplaints - ($startIndex + $resultsPerPage)) > 0;

// Build HTML for fetched complaints
$html = '';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<div class="box">';
  $html .= '<h3>' . $row['title'] . '</h3>';
  $html .= '<p>' . $row['description'] . '</p>';
  $html .= '<h2>Complaint ID: ' . $row['id'] . '</h2>';
  $html .= '<h2>Date: ' . $row['date'] . '</h2>';
  $html .= '<p>Status: <a href="#">' . $row['status'] . '</a></p>';
  $html .= '</div>';
}

// Prepare JSON response
$response = array(
  'html' => $html,
  'hasMore' => $hasMore
);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>