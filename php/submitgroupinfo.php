<?php
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

    $success = true; // Variable to track success

    // Loop to insert data for each student
    for ($i = 1; $i <= 4; $i++) {
        // Modify these variables with the actual form field names
        $name = $_POST["name" . $i];
        $enrollment = $_POST["enrollment" . $i];
        $cgpa = $_POST["cgpa" . $i];
        $skills = $_POST["skills" . $i];
        $areaofinterest = $_POST["areaofinterest" . $i];

        // SQL query to insert data
        $sql = "INSERT INTO submitgroupinfo (name, enrollment, cgpa, skills, areaofinterest) VALUES ('$name', '$enrollment', '$cgpa', '$skills', '$areaofinterest')";

        if (!mysqli_query($conn, $sql)) {
            $success = false; // Mark as unsuccessful if any insert fails
            break; // Exit the loop on the first failure
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Check if all inserts were successful
    if ($success) {
        echo '<script>alert("Submission Successful!!");</script>';
        header("Location: ../pages/submitgroupinfo.html");
        exit(); // Make sure to exit to prevent further script execution.
    }else {
        echo "Error: Some inserts failed. Check your data and try again.";
    }
}
?>
