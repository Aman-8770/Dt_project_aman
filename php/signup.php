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

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Hash the password
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into the database
    $sql = "INSERT INTO student (enrollment,password, name, email) VALUES ('$enrollment', '$password', '$name', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>