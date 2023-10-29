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
      .validation-container {
  width: 200px;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 18px;
  font-weight: bold;
  border-radius: 5px;
  transition: background-color 0.3s;
  margin: 20px;
}
    </style>
    <title>Dashboard</title>
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
            href="../teacher_pages/ViewGroups.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-brands fa-wpforms me-2"></i>View groups </a
          >

          <a
            href="../teacher_pages/Uploadrubrics.html"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-scroll me-2"></i>Upload rubrics</a
          >

          <a
            href="../teacher_pages/evaluation.php"
            class="list-group-item list-group-item-action bg-transparent second-text fw-bold"
            ><i class="fas fa-solid fa-address-card me-2"></i>Evaluation</a
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
            <h2 class="fs-2 m-0">Teacher's Areas of Interest</h2>
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
            
          
          <form action="../teacher_php/teacher_interest.php" method="POST">
    <form id="interestForm">
        <label for="inte1">Area of Interest 1:</label>
        <input type="text" id="inte1" name="inte1" required><br>
        <br/>
        <label for="inte2">Area of Interest 2:</label>
        <input type="text" id="inte2" name="inte2" required><br>
        <br/>
        <label for="inte3">Area of Interest 3:</label>
        <input type="text" id="inte3" name="inte3" required><br>
        <br/>
        <button type="submit">Submit</button>
    </form>

    <div id="result"></div>

    <script>
        document.getElementById("interestForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            // Get the values of the input fields
            var interest1 = document.getElementById("interest1").value;
            var interest2 = document.getElementById("interest2").value;
            var interest3 = document.getElementById("interest3").value;

            // Display the results
            var resultDiv = document.getElementById("result");
            resultDiv.innerHTML = "<h2>Teacher's Areas of Interest:</h2>";
            resultDiv.innerHTML += "<p>1. " + interest1 + "</p>";
            resultDiv.innerHTML += "<p>2. " + interest2 + "</p>";
            resultDiv.innerHTML += "<p>3. " + interest3 + "</p>";
        });
    </script>



          <!-- MAKE CHANGES ABOVE THIS -->
        </div>
      </div>
    </div>

    <!-- /#page-content-wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      var el = document.getElementById("wrapper");
      var toggleButton = document.getElementById("menu-toggle");

      toggleButton.onclick = function () {
        el.classList.toggle("toggled");
      };
    </script>

    <script>
      // Function to open Google Calendar
      function openGoogleCalendar() {
        // Replace 'YOUR_GOOGLE_CALENDAR_URL' with your actual Google Calendar URL
        var googleCalendarUrl = "https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FKolkata&src=YW1hbmFncmF3YWw3MDg5QGdtYWlsLmNvbQ&src=MzQzM2Q0NjY2Zjg0ZGI3MTBhYzlmNmViZmY2MjFkMTZlMmU5OTE2ZDVkNGFlZjE1ZjdhYWU0ZmExOTRlYTc0MkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTE3NDExMjAyMTE4ODQ2MzM3MDkxQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTAyNDM2MDY8NTEwNTAzNzc5NTM3QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTE2NzU2NTI1OTU1MjQ3NzE4NjU3QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=ZW4uaW5kaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4tZ2IuaW5kaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTAwNDI1MDk5MDI2NTczNDQ1OTQwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20";


        // Open the URL in a new tab or window
        window.open(googleCalendarUrl, '_blank');
      }
    </script>

  </body>
</html>

