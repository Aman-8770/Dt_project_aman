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

    // Find the maximum group number in the table
    $maxGroupNoQuery = "SELECT MAX(groupno) FROM submitgroupinfo";
    $maxGroupNoResult = mysqli_query($conn, $maxGroupNoQuery);

    if ($maxGroupNoResult) {
        $maxGroupNoRow = mysqli_fetch_array($maxGroupNoResult);
        $groupno = $maxGroupNoRow[0] + 1; // Increment the maximum group number by 1
    } else {
        // If there are no existing groups, start with group number 1
        $groupno = 2;
    }

    // Loop to insert data for each student
    for ($i = 1; $i <= 4; $i++) {
        // Modify these variables with the actual form field names
        $name = $_POST["name" . $i];
        $enrollment = $_POST["enrollment" . $i];
        $cgpa = $_POST["cgpa" . $i];
        $skills = $_POST["skills" . $i];
        $areaofinterest = $_POST["areaofinterest" . $i];

        // SQL query to insert data with group number
        $sql = "INSERT INTO submitgroupinfo (groupno, name, enrollment, cgpa, skills, areaofinterest) VALUES ('$groupno', '$name', '$enrollment', '$cgpa', '$skills', '$areaofinterest')";

        if (!mysqli_query($conn, $sql)) {
            $success = false; // Mark as unsuccessful if any insert fails
            break; // Exit the loop on the first failure
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Check if all inserts were successful
    if ($success) {
        header("Location: ../pages/alert.html?notify=success"); // Redirect to the alert page
        exit(); // Make sure to exit to prevent further script execution.
    } else {
        echo "Error: Some inserts failed. Check your data and try again.";
    }
}
?>