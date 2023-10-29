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

    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/all.css" />

    <style>
      table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px auto; /* Center the table on the page */
      }

      table,
      th,
      td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>

    <title>Validat groups</title>
  </head>

  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
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
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold "
            ><i class="fas fa-solid fa-address-card me-2"></i>Evaluation</a
          >


          <a
            href="../teacher_pages/view_evaluation.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"
            ><i class="fas fa-solid fa-address-card me-2"></i>View Evaluation</a
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
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4"
        >
          <div class="d-flex align-items-center">
            <i
              class="fas fa-solid fa-bars primary-text fs-4 me-3"
              id="menu-toggle"
            ></i>
            <h2 class="fs-2 m-0">View Evaluate</h2>
          </div>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a
                  class="nav-link second-text fw-bold"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="fas fa-user me-2"></i>
                </a>
              </li>
            </ul>
          </div>
        </nav>


        
        <div class="container-fluid px-4">
            <div class="row g-3 my-2">
          

              <div class="container">
                <h2>View Student Marks</h2>
                <?php
                // Establish a database connection (similar to your code)
                $dbHost = "localhost";
                $dbUsername = "root";
                $dbPassword = "";
                $dbName = "project_management_system_db";
                $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
          
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
          
                // Retrieve the group number from the query parameter
                if (isset($_GET['groupno'])) {
                  $groupno = $_GET['groupno'];
          
                  // Query to fetch student marks for the selected group
                  $marksQuery = "SELECT enrollment_number, marks, evaluation_type FROM evaluation1 WHERE groupno = $groupno ORDER BY evaluation_type";
                  $marksResult = mysqli_query($conn, $marksQuery);
          
                  if (!$marksResult) {
                    echo "Error fetching student marks: " . mysqli_error($conn);
                  } else {
                    $currentEvaluationType = "";
                    // Display the student marks in a table
                    ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Enrollment Number</th>
                          <th>Evaluation Type</th>
                          <th>Marks</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($marksResult)) {
                          if ($row['evaluation_type'] != $currentEvaluationType) {
                            $currentEvaluationType = $row['evaluation_type'];
                            echo '<tr><td colspan="3"><h4>' . $currentEvaluationType . '</h4></td></tr>';
                          }
                          ?>
                          <tr>
                            <td><?php echo $row['enrollment_number']; ?></td>
                            <td><?php echo $row['evaluation_type']; ?></td>
                            <td><?php echo $row['marks']; ?></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                    <?php
                  }
                } else {
                  echo "Group number not specified.";
                }
                ?>
              </div>


      </div>
    </div>
  </body>
</html>