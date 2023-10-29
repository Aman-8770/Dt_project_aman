<?php
session_start();
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_management_system_db"; // The name of the database you created

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$facultyid = $_SESSION['facultyid'];

// Get the areas of interest from the HTML form
$inte1 = $_POST['inte1'];
$inte2 = $_POST['inte2'];
$inte3 = $_POST['inte3'];

// Insert the data into the database using placeholders
$sql = "INSERT INTO faculty_interest (facultyid, inte1, inte2, inte3) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error: " . $conn->error);
}

$stmt->bind_param("ssss", $facultyid, $inte1, $inte2, $inte3);

if ($stmt->execute()) {
    header("Location: ../teacher_pages/alert_teacher.html?notify=success"); // Redirect to the alert page
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
