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

    // Initialize variables to store form data and file paths
    $titles = [];
    $descriptions = [];
    $uploadPath1 = ""; // Define the variables here and set them to empty strings
    $uploadPath2 = "";
    $uploadPath3 = "";

    for ($i = 1; $i <= 3; $i++) {
        // Check if the fields are set before accessing them
        if (isset($_POST["title$i"]) && isset($_POST["des$i"])) {
            $titles[$i] = mysqli_real_escape_string($conn, $_POST["title$i"]);
            $descriptions[$i] = mysqli_real_escape_string($conn, $_POST["des$i"]);

            // File upload handling for each file
            if (isset($_FILES["upload$i"]) && $_FILES["upload$i"]["error"] === UPLOAD_ERR_OK) {
                $fileTmpName = $_FILES["upload$i"]["tmp_name"];
                $uploadsDir = 'C:\xampp\htdocs\dt-2-master\pdf_folder'; // Change this to your desired upload directory
                ${"uploadPath$i"} = $uploadsDir . '/' . $_FILES["upload$i"]["name"];
                if (!move_uploaded_file($fileTmpName, ${"uploadPath$i"})) {
                    echo "Error uploading file for topic $i<br>";
                }
            }
        }
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
