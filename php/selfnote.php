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
    //$groupno = 1;

    // Check if the GitHub link and Jira link have been provided
   
       
        $note = $_POST["note"];
        
        // SQL query to insert data
        $sql = "INSERT INTO selfnote (note ) VALUES ('$note')";

        if (mysqli_query($conn, $sql)) {
            echo "Links inserted successfully.<br>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
     

    // Close the database connection
    mysqli_close($conn);
}
?>