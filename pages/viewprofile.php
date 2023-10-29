<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS -->
    <title>View groups</title>
  </head>

  <body>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
            <h2 class="fs-2 m-0">View profile</h2>
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
                  <label for="group-select">Select enrollment:</label>
                  <select id="group-select">
                    <option value="1"> enrollment 123</option>
                    <!-- Add more groups as needed -->
                  </select>
                  <button onclick="filterTable()">Filter</button>
                </div>

                

                <table>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Enrollment Number</th>
                      <th>email</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    // Replace this code with your database connection setup
                    $dbHost = "localhost";
                    $dbUsername = "root";
                    $dbPassword = "";
                    $dbName = "test";

                    // Create a database connection
                    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

                    // Check the connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch data from the database
                    $query = "SELECT * FROM student"; // Modify the table name if needed

                    $result = mysqli_query($conn, $query);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Output the data in the table row format
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['enrollment'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
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

    <script src="../teacher_pages/ViewGroups.js"></script>

  </body>
</html>

