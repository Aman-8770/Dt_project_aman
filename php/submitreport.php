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

    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $githublink = mysqli_real_escape_string($conn, $_POST['githublink']);
    $jiralink = mysqli_real_escape_string($conn, $_POST['jiralink']);
    $s1_cont = mysqli_real_escape_string($conn, $_POST['s1_cont']);
    $s2_cont = mysqli_real_escape_string($conn, $_POST['s2_cont']);
    $s3_cont = mysqli_real_escape_string($conn, $_POST['s3_cont']);
    $s4_cont = mysqli_real_escape_string($conn, $_POST['s4_cont']);

    $pname = rand(1000,1000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["files"]["tmp_name"];
    $uploads_dir = '/uploads';

    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

    $groupno = 2 ;
    $sql = "INSERT INTO submitreport (groupno, title, githublink, jiralink, s1_cont, s2_cont, s3_cont, s4_cont, pdf_file) 
                            VALUES ('$groupno', '$title', '$githublink', '$jiralink', '$s1_cont', '$s2_cont', '$s3_cont', '$s4_cont', '$pname')";


if (mysqli_query($conn, $sql)) {
    header("Location: ../pages/alert.html?notify=success");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// else {
//     echo "Error uploading file.";
mysqli_close($conn);
    
    }
?>


