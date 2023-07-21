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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h3">Transcripts</h4>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <!-- ... Your existing toolbar content ... -->
                    </div>
                </div>

                <div class="table-responsive pb-0">
                    <table class="table table-light table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Function to assign grade based on marks
                            function get_grade_from_marks($marks) {
                                if ($marks >= 90) {
                                    return 'A';
                                } elseif ($marks >= 80) {
                                    return 'B';
                                } elseif ($marks >= 70) {
                                    return 'C';
                                } else {
                                    return 'D';
                                }
                            }

                            // SQL query to fetch data with rank and grades
                                                            // SQL query to fetch data with rank and grades for a specific student
                                $sql = "SELECT t.marks, 
                                g.grade_name,
                                s.subject_name,
                                st.first_name,
                                RANK() OVER (ORDER BY t.marks DESC) as rank
                                FROM transcripts t
                                JOIN subjects s ON t.subject_id = s.id
                                JOIN grades g ON t.grade_id = g.id
                                JOIN student st ON t.student_id = st.student_id
                                WHERE t.student_id = " . intval($user_id);


                            // Execute the SQL query
                            $result = mysqli_query($db, $sql);

                            // Check for errors
                            if (!$result) {
                                // If there's an error, display the error message and terminate the script
                                echo "Error executing the SQL query: " . mysqli_error($db);
                                exit();
                            }

                            // Check if any records were found
                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1;
                                // Output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $marks = $row["marks"];
                                    $grade_name = $row["grade_name"];
                                    $subject_name = $row["subject_name"];
                                    $fname = $row["first_name"];
                                    $rank = $row["rank"];

                                    // Determine the grade based on the marks using the get_grade_from_marks() function
                                    $grade = get_grade_from_marks($marks);

                                    ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $fname; ?></td>
                                        <td><?php echo $marks; ?></td>
                                        <td><?php echo $grade; ?></td>
                                        <td><?php echo $subject_name; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No data found.</td>
                                </tr>
                                <?php
                            }
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
