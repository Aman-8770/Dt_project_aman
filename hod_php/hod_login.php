<?php

session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_management_system_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM hod WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($row['username'] == $username && $row['password'] == $password) {
            $_SESSION['username'] = $row['username'];
            header("Location: ../hod_pages/dashboard_hod.html?message=Login+Successfully!!");
            exit();
        }
    } else {
        header("Location: ../hod_pages/hod_login_alert.html?notify=success");
        exit();
    }
    $stmt->close();
}

mysqli_close($conn);
?>