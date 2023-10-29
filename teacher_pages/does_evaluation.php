<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['groupno'])) {
    $groupno = $_GET['groupno'];

    // Database connection
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "project_management_system_db";

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch data based on the group number
    $query = "SELECT * FROM submitreport WHERE groupno = $groupno";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error fetching data: " . mysqli_error($conn);
        exit();
    }

    if ($row = mysqli_fetch_assoc($result)) {
        // Get data from the database
        $groupno = $row['groupno'];
        $title = $row['title'];
        $githublink = $row['githublink'];
        $jiralink = $row['jiralink'];
        $s1_cont = $row['s1_cont'];
        $s2_cont = $row['s2_cont'];
        $s3_cont = $row['s3_cont'];
        $s4_cont = $row['s4_cont'];
        $pdf_file = $row['pdf_file'];
    } else {
        echo "No data found for group number: $groupno";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />



    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        select {
            width: 100px;
        }
    </style>

    


    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/all.css" />
    <title>Group Report</title>
  </head>

  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar (if needed) -->
      <!-- ... (Sidebar code here) -->

      <!-- Page Content -->

      <div class="bg-white" id="sidebar-wrapper">
        <div
          class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"
        >
          <i class="fa-solid fa-building-columns"></i>&nbsp;UG
        </div>
        <div class="list-group list-group-flush my-3">
          <a
            href="../teacher_pages/dashboardTeacher.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a
          >

          <a
            href="../teacher_pages/ViewGroups.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-brands fa-wpforms me-2"></i>View groups
          </a>

          <a
            href="../teacher_pages/Uploadrubrics.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-scroll me-2"></i>Upload rubrics</a
          >

          <a
            href="../teacher_pages/evaluation.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"
            ><i class="fas fa-solid fa-address-card me-2"></i>Evaluation</a
          >


          <a
            href="../teacher_pages/ViewReport.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold "
            ><i class="fas fa-solid fa-address-card me-2"></i>View report</a
          >

          <a
            href="../teacher_pages/signin.html"
            class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"
            ><i class="fas fa-power-off me-2"></i>Logout</a
          >
        </div>
      </div>

      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4"
        >
          <div class="d-flex align-items-center">
            <i
              class="fas fa-solid fa-bars primary-text fs-4 me-3"
              id="menu-toggle"
            ></i>
            <h3>Does evaluation</h3>
          </div>

          <!-- ... (Rest of the navigation bar) -->
        </nav>

        <div class="container-fluid px-4">
          <div class="row g-3 my-2">
            <div class="d-flex" id="wrapper">
            <form action="../teacher_php/evaluation.php" method="POST" enctype="multipart/form-data">
            
    <table id="myTable">
        <tr>
            <th>Enrollment Number</th>
            <th>Evaluation Type</th>
            <th>Marks</th>
        </tr>
        <tr>
            <td><input type="text" id="enrollment1" name="enrollment1"></td>
            <td><select id="evaluation1" name="evaluation1"><option value="End Sem">End Sem</option><option value="Mid Sem">Mid Sem</option></select></td>
            <td><input type="text" id="marks1" name="marks1"></td>
        </tr>
        <tr>
            <td><input type="text" id="enrollment2" name="enrollment2"></td>
            <td><select id="evaluation2" name="evaluation2"><option value="End Sem">End Sem</option><option value="Mid Sem">Mid Sem</option></select></td>
            <td><input type="text" id="marks2" name="marks2"></td>
        </tr>
        <tr>
            <td><input type="text" id="enrollment3" name="enrollment3"></td>
            <td><select id="evaluation3" name="evaluation3"><option value="End Sem">End Sem</option><option value="Mid Sem">Mid Sem</option></select></td>
            <td><input type="text" id="marks3" name="marks3"></td>
        </tr>
        <tr>
            <td><input type="text" id="enrollment4" name="enrollment4"></td>
            <td><select id="evaluation4" name="evaluation4"><option value="End Sem">End Sem</option><option value="Mid Sem">Mid Sem</option></select></td>
            <td><input type="text" id="marks4" name="marks4"></td>
        </tr>
    </table>

           

            <div style="text-align: center;">
              <button style="width: 100px; background-color: green; height: 60px; width: 200px;" onclick="addRow()" name="submit" type="submit" >Submit</button>
            </div>
      </form>

      
        </div>
      </div>



  </body>
</html>






