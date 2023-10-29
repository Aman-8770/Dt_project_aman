<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_management_system_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Initialize variables to store form data
    $titles = [];
    $descriptions = [];
    $filePaths = [];

    for ($i = 1; $i <= 3; $i++) {
        // Check if the fields are set before accessing them
        if (isset($_POST["title$i"]) && isset($_POST["des$i"])) {
            $titles[$i] = mysqli_real_escape_string($conn, $_POST["title$i"]);
            $descriptions[$i] = mysqli_real_escape_string($conn, $_POST["des$i"]);

            // File upload handling
            
        }
    }

    if (isset($_FILES['upload1']) && $_FILES['upload1']['error'] === UPLOAD_ERR_OK) {
        // File upload handling
        $uploadName1 = $_FILES['upload1']['name'];
        $uploadTmpName1 = $_FILES['upload1']['tmp_name'];
        $uploadsDir1 = 'C:\xampp\htdocs\dt-2-master\pdf_folder'; // Change this to the correct server path

        $uploadPath1 = $uploadsDir1 . '/' . $uploadName1;
    }



    if (isset($_FILES['upload2']) && $_FILES['upload2']['error'] === UPLOAD_ERR_OK) {
        // File upload handling
        $uploadName2 = $_FILES['upload2']['name'];
        $uploadTmpName2 = $_FILES['upload2']['tmp_name'];
        $uploadsDir2 = 'C:\xampp\htdocs\dt-2-master\pdf_folder'; // Change this to the correct server path

        $uploadPath2 = $uploadsDir2 . '/' . $uploadName2;
    }


    if (isset($_FILES['upload3']) && $_FILES['upload3']['error'] === UPLOAD_ERR_OK) {
        // File upload handling
        $uploadName3 = $_FILES['upload3']['name'];
        $uploadTmpName3 = $_FILES['upload3']['tmp_name'];
        $uploadsDir3 = 'C:\xampp\htdocs\dt-2-master\pdf_folder'; // Change this to the correct server path

        $uploadPath3 = $uploadsDir3 . '/' . $uploadName3;
    }



    

    // Insert data into the database if at least one set of fields is filled
    if (!empty($titles[1]) || !empty($titles[2]) || !empty($titles[3])) {
        $sql = "INSERT INTO project_proposal (title1, title2, title3, des1, des2, des3, upload1, upload2, upload3) 
                VALUES ('$titles[1]', '$titles[2]', '$titles[3]', '$descriptions[1]', '$descriptions[2]', '$descriptions[3]', '$uploadPath1', '$uploadPath2', '$uploadPath3')";

        if (mysqli_query($conn, $sql)) {
            echo "Data inserted successfully<br>";
        } else {
            echo "Error: " . mysqli_error($conn) . "<br>";
        }
    }

    mysqli_close($conn);
}
?>
