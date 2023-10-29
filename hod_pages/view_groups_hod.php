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
    <link rel="stylesheet" href="../teacher_pages/ViewGroups.css" />
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
            href="../hod_pages/dashboard_hod.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold "
            ><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a
          >

          <a
            href="../hod_pages/View_teacher_list.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-address-card me-2"></i>View teacher list</a
          >

          <a
            href="../teacher_pages/ViewGroups.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"
            ><i class="fas fa-brands fa-wpforms me-2"></i>View groups </a
          >

          <a
            href="../hod_pages/validategroups_hod.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
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
            <h2 class="fs-2 m-0">View groups</h2>
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
            <!DOCTYPE html>
            <html>
              <head>
                <style>
                  table {
                    width: 100%;
                    border-collapse: collapse;
                  }

                  table,
                  th,
                  td {
                    border: 1px solid #ddd;
                  }

                  th,
                  td {
                    padding: 8px;
                    text-align: left;
                  }

                  th {
                    background-color: #f2f2f2;
                  }

                  .group-filter {
                    margin-bottom: 20px;
                  }
                </style>
              </head>
              <body>
                <!-- Add group filter -->
                <div class="group-filter">
                  <label for="group-select">Select Group:</label>
                  <select id="group-select">
                    <option value="all">All</option>
                    <option value="1">Group 1</option>
                    <option value="2">Group 2</option>
                    <option value="3">Group 3</option>
                    <!-- Add more groups as needed -->
                  </select>
                  <button onclick="filterTable()">Filter</button>
                </div>

                

                <table>
                  <thead>
                    <tr>
                      <th>Group</th>
                      <th>Name</th>
                      <th>Enrollment Number</th>
                      <th>Skills</th>
                      <th>CGPA</th>
                      <th>Area of Interest</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Replace this code with your database connection setup
                    $dbHost = "localhost";
                    $dbUsername = "root";
                    $dbPassword = "";
                    $dbName = "project_management_system_db";

                    // Create a database connection
                    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

                    // Check the connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch data from the database
                    $query = "SELECT * FROM submitgroupinfo"; // Modify the table name if needed

                    $result = mysqli_query($conn, $query);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Output the data in the table row format
                            echo "<tr>";
                            echo "<td>" . $row['groupno'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['enrollment'] . "</td>";
                            echo "<td>" . $row['skills'] . "</td>";
                            echo "<td>" . $row['cgpa'] . "</td>";
                            echo "<td>" . $row['areaofinterest'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No data available in the database.";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                  </tbody>
                </table>

                <script>
                  function filterTable() {
                    var groupSelect = document.getElementById("group-select");
                    var selectedGroup = groupSelect.value;
                    var table = document.querySelector("table");
                    var rows = table.getElementsByTagName("tr");

                    for (var i = 1; i < rows.length; i++) {
                      var row = rows[i];
                      var groupCell = row.getElementsByTagName("td")[0];
                      if (
                        selectedGroup === "all" ||
                        groupCell.innerText === selectedGroup
                      ) {
                        row.style.display = "";
                      } else {
                        row.style.display = "none";
                      }
                    }
                  }
                </script>
              </body>
            </html>
          </div>
        </div>
      </div>
    </div>

    <script src="../hod_pages/view_groups_hod.js"></script>

  </body>
</html>



