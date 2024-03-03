<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Complaint Submitted Successfully</title>
  <style>
    body {
      font-family: Inter, sans-serif;
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

    a {
      color: #3498db;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php
  $title = $_POST["title"];
  $description = $_POST["description"];
  $complaint_name = $_POST["name"];
  $phone = $_POST["phone"];
  $area = $_POST["area"];
  $latitude = $_POST["latitude"];
  $longitude = $_POST["longitude"];

  //id	title	description	complainant_name	phone	date	latitude	longitude	status	area
  
  include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');

  $sql = "INSERT INTO complaints (title, description, complainant_name, phone, latitude, longitude, status, area) VALUES ('$title', '$description', '$complaint_name', '$phone', $latitude, $longitude, 'Pending', '$area')";
  $res = $conn->query($sql);
  $last_inserted = $conn->insert_id;
  if ($res === TRUE) {
    echo "<div class='container'>
      <h2>Complaint No. $last_inserted  Submitted Successfully</h2>
      <p>Your complaint has been successfully submitted.</p>
      <p>Thank you for your feedback.</p>
      <a href='/public-complaints/'>Return to Home</a>
    </div>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  ?>

</body>


</html>