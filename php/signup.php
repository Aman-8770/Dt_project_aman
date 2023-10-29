<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $enrollment = $_POST["enrollment"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    
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

    
    $sql = "INSERT INTO student (enrollment,password, name, email) VALUES ('$enrollment', '$password', '$name', '$email')";

    
    if (!mysqli_query($conn, $sql)) {
        $success = false; 


        mysqli_close($conn);

        
        if ($success) {
            header("Location: ../pages/signin.html"); 
        }else {
            echo "Error: Some inserts failed. Check your data and try again.";
        }
    }
}
?>