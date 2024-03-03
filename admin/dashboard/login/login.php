<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username_input = $_POST["username"];
    $password_input = $_POST["password"];

    // Include database configuration
    include_once($_SERVER['DOCUMENT_ROOT'] . '/public-complaints/db_config.php');

    // Prepare and execute the SQL query

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username_input, $password_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        // User exists, set session variables and redirect
        session_regenerate_id();
        $_SESSION["username"] = $username_input;
        $_SESSION["authenticated"] = true;
        header("Location: /public-complaints/admin/dashboard/index.php");
        exit;
    } else {
        // User does not exist or invalid credentials
        echo "Invalid username or password";
    }

    $conn->close();
}
?>