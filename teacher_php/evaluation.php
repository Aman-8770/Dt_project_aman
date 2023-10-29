<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_management_system_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment1 = $_POST['enrollment1'];
    $evaluation1 = $_POST['evaluation1'];
    $marks1 = $_POST['marks1'];

    $enrollment2 = $_POST['enrollment2'];
    $evaluation2 = $_POST['evaluation2'];
    $marks2 = $_POST['marks2'];

    $enrollment3 = $_POST['enrollment3'];
    $evaluation3 = $_POST['evaluation3'];
    $marks3 = $_POST['marks3'];

    $enrollment4 = $_POST['enrollment4'];
    $evaluation4 = $_POST['evaluation4'];
    $marks4 = $_POST['marks4'];

    // Query to retrieve the groupno based on enrollment1
    

    $groupno_query = "SELECT groupno FROM submitgroupinfo WHERE enrollment IN ('$enrollment1', '$enrollment2', '$enrollment3', '$enrollment4')";
    $groupno_result = $conn->query($groupno_query);

    if ($groupno_result) {
        $groupno_row = $groupno_result->fetch_assoc();
        if ($groupno_row && isset($groupno_row['groupno'])) {
            $groupno = $groupno_row['groupno'];
        } else {
            // Set a default value if groupno is not found
            $groupno = 0; // You can change this to an appropriate default value
        }
    } else {
        die("Error retrieving groupno: " . $conn->error);
    }

    // Insert data into the table
    $sql = "INSERT INTO Evaluation1 (enrollment_number, evaluation_type, marks, groupno) 
            VALUES ('$enrollment1', '$evaluation1', $marks1, $groupno),
                   ('$enrollment2', '$evaluation2', $marks2, $groupno),
                   ('$enrollment3', '$evaluation3', $marks3, $groupno),
                   ('$enrollment4', '$evaluation4', $marks4, $groupno)";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
