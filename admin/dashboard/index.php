<?php
session_start();

// Check if user is logged in
if (empty($_SESSION['username'])) {
  header("Location: login");
  exit;
}

// Include database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');


// Pagination
$results_per_page = 10; // Number of complaints per page

if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

$start_index = ($page - 1) * $results_per_page;

// Fetch complaints
$sql = "SELECT * FROM complaints LIMIT $start_index, $results_per_page";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <div class="navbar">
    <a href="#home">Home</a>
    <a href="/public-complaints/all">All Complaints</a>
    <a href="/public-complaints/map">Map</a>
    <a href="#about">About</a>
    <div class="admin-dashboard-link">
      <a href="/public-complaints/admin/dashboard/logout.php">Logout</a>
    </div>
  </div>
  <div class="container">
    <h1>Admin Dashboard</h1>
    <table>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Area</th>
        <th>Complainant Name</th>
        <th>Phone Number</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "<td>{$row['area']}</td>";
        echo "<td>{$row['complainant_name']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['status']}</td>";
        if ($row['status'] !== 'Resolved') {
          echo "<td><a href='resolve.php?id={$row['id']}'>Resolve</a></td>";
        } else {
          echo "<td>Resolved</td>";
        }
        echo "</tr>";
      }
      ?>
    </table>

    <?php
    // Pagination links
    $sql = "SELECT COUNT(id) AS total FROM complaints";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_complaints = $row['total'];
    $total_pages = ceil($total_complaints / $results_per_page);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $page) {
        echo "<a href='?page=$i' class='current-page'>$i</a>"; // Highlight the current page
      } else {
        echo "<a href='?page=$i'>$i</a>";
      }
    }
    echo "</div>";

    ?>
  </div>
</body>

</html>