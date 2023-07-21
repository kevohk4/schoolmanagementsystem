<?php
    include '../includes/config.php';
   // session_start();
    include '../includes/dbh.inc.php';
    include '../includes/functions.php';
    include '../includes/disp.php';
?>


<?php
session_start();

// Redirect to the login page for users who are not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teachers | SIMS</title>
    <link rel="canonical" href="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootsrap.min.grid.css">
    <link rel="stylesheet" href="../fontawesome-free-5.13.0-web/css/all.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap pb-1 shadow navbar-expand-lg">
    <a class="avbar-brand col-md-6 col-lg-6 mr-1 px-3 mb-3 text-white" href="../Dashboard.php" style="font-size:30px;text-decoration:none">SIMS</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed mt-2" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <?php
        include 'asidenavigation.php';
      ?>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h6 class="h3">Mark students attendance</h6>
          <div class="btn-toolbar mb-2 mb-md-0">
            
          </div>
        </div>
        <p class="mb-0" style="font-size:17px">Search student using Student Id </p>

        <div>
            <form action="" method="POST">
                <div class="py-2" style="display: flex;align-content: center;">
                <input type="search" placeholder="Seach Using Student ID" class="form-control" name="search" style="width:250px" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>  
                <button type="submit"  class="btn btn-primary ml-1">
                    <i class="fas fa-search " id="search"></i>
                </button>                    
                </div>
            </form>

            <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $studentId = $_POST['search'];

    // Execute the SQL query to retrieve the student with the given student_ID
    $sql_students = "SELECT * FROM student WHERE student_ID = '$studentId'";
    $result_students = mysqli_query($db, $sql_students);

    if ($result_students) {
        // Check if any result is returned from the query
        if (mysqli_num_rows($result_students) > 0) {
            // Student found, display the input field for entering marks

            $studentData = mysqli_fetch_assoc($result_students);

             // Display the student name and student ID
             echo '<h4 class="ml-3">Student Name: ' . $studentData["first_name"] . ' '. $studentData["last_name"] . '</h4>';
             echo '<h4 class="ml-3">Student ID: ' . $studentData["student_ID"] . '</h4>';


            echo '

            <div class="container">
            <form name="createattendance" method="POST" action="../createattendance.php">
            <div class="row">
                <div class="col-md-4">
                    <select name="attendance" class="form-control" required>
                        <option value="">Select Attendance</option>
                        <option value="1">Present</option>
                        <option value="0">Absent</option>
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="hidden" class="form-control" name="id" value="' . $studentId . '">                
                    </div>
                </div>

                <div class="row">
                <div class="col-md-2 mt-3 mb-2">
                    <input type="submit" class="btn btn-primary form-control" >
                </div>
            </form>';
        } else {
            echo '<h4 class="text-danger">Student not found.</h4>';
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }

    echo '</div>';

    // Close the database connection
    mysqli_close($db);
}

?>


                
           
            </div>       
        
      </main>
    </div>
  </div>

    <footer class="py-3 bg-dark fixed-bottom mt-2">
        <div class="container">
            <p class="mb-0 text-center text-white">All rights reserved School Information Management System &copy;2023</p>
        </div>
    </footer>

    <script src="../js/bootstrap.bundles.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>