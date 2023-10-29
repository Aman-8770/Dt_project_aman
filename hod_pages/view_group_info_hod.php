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

// Check if the 'groupno' parameter is present in the URL
if (isset($_GET['groupno'])) {
    $groupno = $_GET['groupno'];

    // Fetch group information from the database
    $groupInfoQuery = "SELECT * FROM submitgroupinfo WHERE groupno = $groupno";
    $groupInfoResult = mysqli_query($conn, $groupInfoQuery);

    if (!$groupInfoResult) {
        die("Error fetching group information: " . mysqli_error($conn));
    }

    // Check if a group with the specified group number exists
    if (mysqli_num_rows($groupInfoResult) > 0) {
        $group = mysqli_fetch_assoc($groupInfoResult);
        
        $validateStatus = $group['validate'];
    } else {
        // Group not found
        die("Group not found.");
    }
} else {
    // 'groupno' parameter not provided in the URL
    die("Group number not specified.");
}

// Handle group validation if the "Validate" or "Unvalidate" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($validateStatus == 1) {
        // If the group is validated, set the 'validate' field to 0 (Unvalidate)
        $updateQuery = "UPDATE submitgroupinfo SET validate = 0 WHERE groupno = $groupno";
        $validateStatus = 0; // Update the status variable
    } else {
        // If the group is not validated, set the 'validate' field to 1 (Validate)
        $updateQuery = "UPDATE submitgroupinfo SET validate = 1 WHERE groupno = $groupno";
        $validateStatus = 1; // Update the status variable
    }

    if (mysqli_query($conn, $updateQuery)) {
        // Update successful
    } else {
        // Update failed
        echo "Error updating group validation status: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
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
    <title>View groups hod</title>
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
            href="../teacher_pages/dashboard.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"
            ><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a
          >

          <a
            href="../hod_pages/View_teacher_list.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-address-card me-2"></i>View teacher list</a
          >

          <a
            href="../teacher_pages/ViewGroups.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-brands fa-wpforms me-2"></i>View groups </a
          >
          
          <a
            href="../hod_pages/validategroups_hod.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold "
            ><i class="fas fa-solid fa-scroll me-2"></i>Validate groups</a
          >

          <a
            href="../teacher_pages/view_evaluation.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-address-card me-2"></i> View Evaluation</a
          >

          <a
            href="../teacher_pages/ViewReport.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-address-card me-2"></i>View report</a
          >

          <a
            href="../teacher_pages/signinTeacher.html"
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
            <h2 class="fs-2 m-0">Project coordinator Dashboard</h2>
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
            <div class="row my-5" style="text-align: center">
              <!-- <h3 class="fs-4 mb-3">Welcome to Project Management System</h3> -->
              

            
             
    <div class="container">
        <h1>Group Information</h1>

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

        // Check if the 'groupno' parameter is present in the URL
        if (isset($_GET['groupno'])) {
            $groupno = $_GET['groupno'];

            // Fetch group information from the database
            $groupInfoQuery = "SELECT * FROM submitgroupinfo WHERE groupno = $groupno";
            $groupInfoResult = mysqli_query($conn, $groupInfoQuery);

            if (!$groupInfoResult) {
                die("Error fetching group information: " . mysqli_error($conn));
            }

            // Check if any groups with the specified group number exist
            if (mysqli_num_rows($groupInfoResult) > 0) {
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Group Number</th><th>Enrollment</th><th>Name</th><th>CGPA</th><th>Skills</th><th>Area of Interest</th></tr></thead><tbody>";

                while ($group = mysqli_fetch_assoc($groupInfoResult)) {
                    $groupNumber = $group['groupno'];
                    $enrollment = $group['enrollment'];
                    $name = $group['name'];
                    $cgpa = $group['cgpa'];
                    $skills = $group['skills'];
                    $areaofinterest = $group['areaofinterest'];

                    // Display the group information in a table row
                    echo "<tr>";
                    echo "<td>$groupNumber</td>";
                    echo "<td>$enrollment</td>";
                    echo "<td>$name</td>";
                    echo "<td>$cgpa</td>";
                    echo "<td>$skills</td>";
                    echo "<td>$areaofinterest</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                // No groups found for the specified group number
                echo "No groups found for Group Number: $groupno";
            }
        } else {
            // 'groupno' parameter not provided in the URL
            echo "Group number not specified.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>







    <p><strong>Validation Status:</strong> <?php echo ($validateStatus == 1) ? 'Validated' : 'Not Validated'; ?></p>

    <form action="" method="POST">
        <button type="submit" name="validate">
            <?php echo ($validateStatus == 1) ? 'Unvalidate Group' : 'Validate Group'; ?>
        </button>
    </form>


            </div>
          </div>

          <!-- MAKE CHANGES ABOVE THIS -->
        </div>
      </div>
    </div>

    <!-- /#page-content-wrapper -->

    
  </body>
</html>
