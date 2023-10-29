<?php

session_start(); 

if (!isset($_SESSION['enrollment'])) {
    header("Location: ../pages/signin.html");
    exit();
}

$enrollment = $_SESSION['enrollment'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details (modify with your own)
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "project_management_system_db";

    // Create a database connection
    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the GitHub link and Jira link have been provided
    // $enrollment = 100;
    $note = $_POST["note"];

    // SQL query to insert data
    $sql = "INSERT INTO selfnote (`enrollment`, `note`) VALUES ('$enrollment', '$note')";

    if (mysqli_query($conn, $sql)) {
        // Data inserted successfully
        mysqli_close($conn);
        header("Location: ../pages/alert.html?notify=success"); // Redirect to the alert page
        exit(); // Make sure to exit to prevent further script execution.
    } else {
        // Error occurred while inserting data
        mysqli_close($conn);
        echo "Error: " . mysqli_error($conn);
    }
}
?>
