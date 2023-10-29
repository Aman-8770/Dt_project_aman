<?php
// Add this PHP code to fetch group information
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "project_management_system_db";

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$groupInfoQuery = "SELECT groupno, validate FROM submitgroupinfo";
$groupInfoResult = mysqli_query($conn, $groupInfoQuery);

if (!$groupInfoResult) {
    die("Error fetching group information: " . mysqli_error($conn));
}

$displayedGroups = array(); // Array to keep track of displayed groups
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
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"
            ><i class="fas fa-solid fa-address-card me-2"></i>Evaluation</a
          >


          <a
            href="../teacher_pages/view_evaluation.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold "
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
            <h2 class="fs-2 m-0">Evaluate</h2>
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
        <table class="table">
            <thead>
                <tr>
                    <th style="background-color: rgb(88, 88, 241)">Group Number</th>
                    
                    <th style="background-color: rgb(88, 88, 241)">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($group = mysqli_fetch_assoc($groupInfoResult)) {
                    if ($group['validate'] == 1) {
                        // Check if the group has already been displayed
                        if (!in_array($group['groupno'], $displayedGroups)) {
                            $displayedGroups[] = $group['groupno']; // Mark the group as displayed
                            ?>
                            <tr>
                                <td class="shashank" style="background-color: aliceblue">
                                    Group <?php echo $group['groupno']; ?>
                                </td>
                               
                                <td>
                                    <a
                                        href="does_evaluation.php?groupno=<?php echo $group['groupno']; ?>"
                                        class="btn btn-primary"
                                    >
                                        Evaluate
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>



      </div>
    </div>
  </body>
</html>






