<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_management_system_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['submit']))
{
$enrollment=$_POST['enrollment'];
$password=$_POST['password'];

$sql ="SELECT * FROM student WHERE enrollment='$enrollment' AND password='$password'";
$result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['enrollment'] == $enrollment && $row['password'] == $password) {


                header("Location: ../pages/dashboard.html?message:Login Successfully!!");

                
            }
}
else
{
header("location:../pages/signup.html?message:Login Fails!!");
}
}

mysqli_close($conn);
?>