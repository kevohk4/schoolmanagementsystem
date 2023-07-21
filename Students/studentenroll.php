<?php
    include '../includes/config.php';
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
$role_id = $_SESSION['role_id'];
$user_id = $_SESSION['user_id'];

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
    <a class="avbar-brand col-md-6 col-lg-6 mr-1 px-3 mb-3 text-white" href="#" style="font-size:30px;text-decoration:none">SIMS</a>
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
          <h4 class="h3"> Student Enrollment</h4>
          <div class="btn-toolbar mb-2 mb-md-0">
            
          </div>
        </div>
                <?php

                        // Check if the form is submitted
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Retrieve form data
                    $grade = $_POST['grade'];
                    $term = $_POST['term'];
                    $remarks = 'Successfully Enrolled';

                    // Use prepared statement to insert data into the enrollment table
                    $sql_students = "INSERT INTO enrollment (student_id, grade_id, remarks, term) VALUES (?, ?, ?, ?)";
                    $stmt = $db->prepare($sql_students);
                    $stmt->bind_param("iiss", $user_id, $grade, $remarks, $term);

                    if ($stmt->execute()) {
                        echo "<p style='color:green;font-size:30px'>Enrollment successful</p>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close the prepared statement
                    $stmt->close();
                }

                // Close the database connection
                $db->close();
                ?>


        <div class="">
            
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return valid()">

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Select Enroll for Term</label>
                            <select class="form-control" name="term" required>
                                <option value="">Select Term:-</option>
                                <option value="Term 1">Term 1</option>
                                <option value="Term 2">Term 2</option>
                                <option value="Term 3">Term 3</option>
                            </select>
                        </div>
                        <input type="hidden" name="student_id" value="<?php echo $user_id; ?>"> 
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Grade</label>
                            <select class="form-control" name="grade" required>
                                <option value="">Select grade:-</option>

                                <?php
                                    $studentgrade = new display();
                                    $studentgrade->ShowGrades();
                                ?>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Enroll</button>
                        </div>
                    </div>
                </div>
                
                </form>
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