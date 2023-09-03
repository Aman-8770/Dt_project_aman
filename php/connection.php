<?php
  $db_server="localhost";
  $db_username="root";
  $db_password="";
  $database="project_management_system_db";
  $conn = mysqli_connect($db_server, $db_username, $db_password, $database);

 // Die if connection was not successful
if (!$conn){
  die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
  echo "Connection was successful";
}
?>