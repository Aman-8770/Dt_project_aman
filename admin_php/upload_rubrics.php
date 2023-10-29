<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "project_management_system_db";

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get faculty ID from session
    $facultyid = $_SESSION['facultyid'];

    // Check if a file was uploaded
    if (isset($_FILES['pdf1']) && $_FILES['pdf1']['error'] === UPLOAD_ERR_OK) {
        // File upload handling
        $uploadName = $_FILES['pdf1']['name'];
        $uploadTmpName = $_FILES['pdf1']['tmp_name'];
        $uploadsDir = 'C:\xampp\htdocs\dt-2-master\pdf_folder'; // Change this to the correct server path

        $uploadPath = $uploadsDir . '/' . $uploadName;

        if (move_uploaded_file($uploadTmpName, $uploadPath)) {
            // File uploaded successfully

            // Insert data into the database
            $sql = "INSERT INTO upload_rubrics (facultyid, pdf1) VALUES ('$facultyid', '$uploadPath')";



            if (mysqli_query($conn, $sql)) {
                header("Location: ../admin_pages/alert_admin.html?notify=success"); // Redirect to the alert page
                exit();
                
            } else {
                echo "Error: " . mysqli_error($conn) . "<br>";
            }
        } else {
            echo "Error uploading the file<br>";
        }
    } else {
        echo "No file uploaded or an error occurred<br>";
    }

    mysqli_close($conn);
}
?>