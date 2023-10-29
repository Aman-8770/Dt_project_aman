<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $enrollment = $_POST["enrollment"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "test";

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    $success = true;
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "INSERT INTO student (enrollment, name, email) VALUES ('$enrollment', '$name', '$email')";

    
    if (!mysqli_query($conn, $sql)) {
        $success = false; 


        mysqli_close($conn);

        
        if ($success) {
            echo "your profile entered successfully" ;
        }else {
            echo "enter successfully";
        }
    }
}
?>