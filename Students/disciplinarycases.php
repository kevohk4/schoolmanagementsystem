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
          <h4 class="h3">My disciplinary cases</h4>
          <div class="btn-toolbar mb-2 mb-md-0">
            
          </div>
        </div>

        <div class="table-responsive pb-0">
                    <table class="table table-light table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Case ID</th>
                                <th>Reported By</th>
                                <th>Case Involving (Accused Person)</th>
                                <th>Reported On</th>
                                <th>Charge(s)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                          <?php
                            $cases = new display();
                            $cases->DisplaymyCases($user_id);
                          ?> 

                        </tbody>
                    </table>
                </div>
           
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