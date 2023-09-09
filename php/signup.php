<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $enrollment = $_POST["enrollment"];
    $password = $_POST["password"];
    $name = $_POST["name"];
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
    $sql = "INSERT INTO student (enrollment,password, name, email) VALUES ('$enrollment', '$password', '$name', '$email')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "Registration successful!";
    // } else {
    //     echo "Error: " . mysqli_error($conn);
    // }

    // Close the database connection
    if (!mysqli_query($conn, $sql)) {
        $success = false; // Mark as unsuccessful if any insert fails
       // break; // Exit the loop on the first failure
    }


// Close the database connection
mysqli_close($conn);

// Check if all inserts were successful
if ($success) {
    header("Location: ../pages/signin.html"); // Replace "dashboard.php" with the URL of the page you want to redirect to
exit();// Make sure to exit to prevent further script execution.
}else {
    echo "Error: Some inserts failed. Check your data and try again.";
}
}
?>