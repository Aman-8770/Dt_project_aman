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
    $facultyid = $_POST['facultyid'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE facultyid=? AND password=?");
    $stmt->bind_param("ss", $facultyid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($row['facultyid'] == $facultyid && $row['password'] == $password) {
            $_SESSION['facultyid'] = $row['facultyid'];
            header("Location: ../teacher_pages/dashboardTeacher.html?message=Login+Successfully!!");
            exit();
        }
    } else {
        header("Location: ../teacher_pages/teacher_login_alert.html?notify=success");
        exit();
    }
    $stmt->close();
}

mysqli_close($conn);
?>