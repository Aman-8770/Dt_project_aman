<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_management_system_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES["resource"]) && $_FILES["resource"]["error"] == 0) {
    $uploadDir = "downloads/"; // Create a "downloads" directory in your project folder
    $resourceName = basename($_FILES["resource"]["name"]);
    $resourceDescription = $_POST["description"];
    $resourceType = $_POST["type"];
    $resourceLink = $_POST["link"];
    $resourceCode = $_POST["code"];

    // Generate a unique filename to avoid overwriting existing files
    $uniqueFileName = generateUniqueFileName($uploadDir, $resourceName);

    $targetPath = $uploadDir . $uniqueFileName;

    if (move_uploaded_file($_FILES["resource"]["tmp_name"], $targetPath)) {
        // File uploaded successfully, you can store its metadata in a database
        $sql = "INSERT INTO resources (description, type, file_name, link, code) VALUES ('$resourceDescription', '$resourceType', '$uniqueFileName', '$resourceLink', '$resourceCode')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "file" => $uniqueFileName, "link" => $resourceLink]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "File move failed."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "File upload error."]);
}

// Function to generate a unique filename
function generateUniqueFileName($directory, $filename) {
    $suffix = 0;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $baseName = pathinfo($filename, PATHINFO_FILENAME);

    while (file_exists($directory . $filename)) {
        $suffix++;
        $filename = $baseName . "_" . $suffix . "." . $extension;
    }

    return $filename;
}

// Close the database connection
$conn->close();
?>
