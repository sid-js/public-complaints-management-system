<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Resolved Successfully</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      text-align: center;
      padding-top: 100px;
    }

    .container {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 40px;
      max-width: 600px;
      margin: 0 auto;
    }

    h2 {
      color: #2ecc71;
    }

    p {
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #f58634;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #e57520;
    }
  </style>
</head>

<body>

  <?php
  session_start();

  // Check if user is logged in
  if (empty($_SESSION['username'])) {
    header("Location: login");
    exit;
  }

  // Include database connection
  include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');

  // Check if complaint id is provided
  if (isset($_GET['id'])) {
    $complaint_id = $_GET['id'];

    // Update status to 'Resolved'
    $sql = "UPDATE complaints SET status = 'Resolved' WHERE id = $complaint_id";
    if (mysqli_query($conn, $sql)) {
      // Check if any rows were affected
      if (mysqli_affected_rows($conn) > 0) {
        echo "<div class='container'>
                    <h2>Complaint Resolved Successfully</h2>
                    <p>The complaint has been marked as resolved.</p>
                    <a href='/public-complaints/admin/dashboard' class='btn'>Back to Dashboard</a>
                  </div>";
      } else {
        echo "<div class='container'>
                    <h2>No Changes Made</h2>
                    <p>No complaint was found with the provided ID, or it was already resolved.</p>
                    <a href='dashboard.php' class='btn'>Back to Dashboard</a>
                  </div>";
      }
    } else {
      // Query failed
      echo "Error updating record: " . mysqli_error($conn);
    }
  } else {
    echo "Complaint ID not provided.";
  }
  ?>
</body>

</html>