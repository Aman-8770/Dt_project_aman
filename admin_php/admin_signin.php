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
    $adminid = $_POST['adminid'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE adminid=? AND password=?");
    $stmt->bind_param("ss", $adminid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($row['adminid'] == $adminid && $row['password'] == $password) {
            $_SESSION['adminid'] = $row['adminid'];
            header("Location: ../admin_pages/admindashboard.html?message=Login+Successfully!!");
            exit();
        }
    } 
    else
    {
    header("Location: ../admin_pages/admin_login_alert.html?notify=success");
    // header("location:../pages/signup.html?message:Login Fails!!");
    }
    // $stmt->close();
}

mysqli_close($conn);
?>