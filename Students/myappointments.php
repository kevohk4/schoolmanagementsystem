<?php
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
    <title>Appointment | SIMS</title>
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

  <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap pb-1 shadow navbar-expand-lg">
    <a class="avbar-brand col-md-6 col-lg-6 mr-1 px-3 mb-3 text-white" href="../Dashboard.php" style="font-size:30px;text-decoration:none">BEHAVIOUR MS</a>
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
          <h3 class="h3"> All my appointments</h3>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="py-2" style="display: flex;align-content: center;">
                                 
            </div>
            
          </div>
        </div>

        <div class="container">
        <div class="table-responsive pb-0">
                    <table class="table table-light table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Appointment Id</th>
                                <th>Appointment With</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Appointment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php

                            $sql = "SELECT a.*, t.first_name, t.last_name, t.email, t.phone, t.gender
                            FROM appointments a
                            LEFT JOIN teachers t ON a.counsellor_id = t.user_ID
                            WHERE a.student_id = " . intval($user_id);

                            $result = mysqli_query($db, $sql);

                            if (!$result) {
                            echo "<tr><td colspan='7'>Error executing the SQL query: " . mysqli_error($db) . "</td></tr>";
                            } else {
                            if (mysqli_num_rows($result) > 0) {
                            $rowNumber = 1;


                            $lastDisplayedName = null;
                            $lastDisplayedEmail = null;
                            $lastDisplayedContact = null;

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $rowNumber . "</td>"; 
                                echo "<td>" . $row["id"] . "</td>";

                                if ($lastDisplayedName !== $row["first_name"] . " " . $row["last_name"]) {
                                
                                    echo "<td><a href='' style='text-decoration:none'>" . $row["first_name"] . " " . $row["last_name"] . "</a></td>";
                                    // Update the last displayed name with the current one
                                    $lastDisplayedName = $row["first_name"] . " " . $row["last_name"];
                                } else {
                                    // Display an empty cell if the name is the same as the last one
                                    echo "<td></td>";
                                }

                            
                                if ($lastDisplayedEmail !== $row["email"]) {
                                
                                    echo "<td>" . $row["email"] . "</td>";
                                    // Update the last displayed email with the current one
                                    $lastDisplayedEmail = $row["email"];
                                } else {
                                    // Display an empty cell if the email is the same as the last one
                                    echo "<td></td>";
                                }

                                // Check if the current row's contact is the same as the last one
                                if ($lastDisplayedContact !== $row["phone"]) {
                                    // Display the contact if it's different from the last one
                                    echo "<td>" . $row["phone"] . "</td>";
                                    // Update the last displayed contact with the current one
                                    $lastDisplayedContact = $row["phone"];
                                } else {
                                    // Display an empty cell if the contact is the same as the last one
                                    echo "<td></td>";
                                }
                            
                                echo "<td>" . $row["appointment_date"] . "</td>";
                                echo "<td>" . ($row["is_attended"] ? "Attended" : "Not Attended") . "</td>";

                                echo "</tr>";

                                // Increment the row number for the next iteration
                                $rowNumber++;


                            }


                            } else {
                            echo "<tr><td colspan='7' style='font-size:20px;color:green'>You have no appointments </td></tr>";
                            }
                        }

                        // Close the database connection (optional, as PHP automatically closes the connection at the end of the script)
                        mysqli_close($db);
                        ?>
                </tbody>
            </table>
        </div>
            

          
