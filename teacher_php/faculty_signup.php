<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $facultyid = $_POST["facultyid"];
    $password = $_POST["password"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];

    // Create a database connection (you can replace these values with your database credentials)
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "project_management_system_db";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    $success = true;
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Hash the password
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into the database
    $sql = "INSERT INTO faculty (facultyid,password, fullname, email) VALUES ('$facultyid', '$password', '$fullname', '$email')";

    
    if (!mysqli_query($conn, $sql)) {
        $success = false; // Mark as unsuccessful if any insert fails
       // break; // Exit the loop on the first failure
    }


// Close the database connection
mysqli_close($conn);

// Check if all inserts were successful
if ($success) {
    header("Location: ../teacher_pages/signinTeacher.html"); // Replace "dashboard.php" with the URL of the page you want to redirect to
exit();// Make sure to exit to prevent further script execution.
}else {
    echo "Error: Some inserts failed. Check your data and try again.";
}
}
?>