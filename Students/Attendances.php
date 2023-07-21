<?php
// Include the necessary files for the database connection and other functions
include '../includes/config.php';
include '../includes/dbh.inc.php';
include '../includes/functions.php';
include '../includes/disp.php';

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootsrap.min.grid.css">
    <link rel="stylesheet" href="../fontawesome-free-5.13.0-web/css/all.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
    <title>Attendance | SIMS</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap pb-1 shadow navbar-expand-lg">
        <a class="navbar-brand col-md-6 col-lg-6 mr-1 px-3 mb-3 text-white" href="#" style="font-size:30px;text-decoration:none">SIMS</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed mt-2" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <?php include 'asidenavigation.php'; ?>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h3">Attendance</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- ... Your existing toolbar content ... -->
                    </div>
                </div>

                <div class="table-responsive pb-0">
                    <table class="table table-light table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                
                                <th>Date</th>
                            </tr>
                        </thead>
                        <?php

                        // ... Your existing PHP code ...

                        // SQL query to fetch student information along with attendance
                        $sql = "SELECT s.*, a.attendance_date, a.status
                                FROM student s
                                LEFT JOIN attendance a ON s.student_id = a.student_id
                                WHERE a.student_id = " . intval($user_id);

                        // Execute the SQL query
                        $result = mysqli_query($db, $sql);

                        // Check for errors
                        if (!$result) {
                            // If there's an error, display the error message and terminate the script
                            echo "<tr><td colspan='5'>Error executing the SQL query: " . mysqli_error($db) . "</td></tr>";
                        } else {
                            // Check if any attendance record is found
                            if (mysqli_num_rows($result) > 0) {
                                // Loop through each attendance record and display them in table rows
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row["student_ID"] . "</td>";
                                  //  echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";

                                    // Display attendance information (if available)
                                    if (!empty($row["attendance_date"])) {
                                        echo "<td>" . $row["attendance_date"] . "</td>";
                               //         echo "<td>" . $row["status"] . "</td>";
                                    } else {
                                        echo "<td colspan='2'>No attendance record found.</td>";
                                    }

                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No attendance record found.</td></tr>";
                            }
                        }

                        // Close the database connection (optional, as PHP automatically closes the connection at the end of the script)
                        mysqli_close($db);
                        ?>
                        </tbody>

                    </table>
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