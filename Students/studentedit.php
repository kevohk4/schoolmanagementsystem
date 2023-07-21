<?php
    include '../includes/config.php';
   // session_start();
    $student_id=$_GET['user'];
    include '../includes/dbh.inc.php';
    include '../includes/functions.php';
    include '../includes/disp.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Student Edit Details| SIMS</title>
        <link rel="canonical" href="">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootsrap.min.grid.css">
        <link rel="stylesheet" href="../fontawesome-free-5.13.0-web/css/all.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    <body class="antialiased">
      <body class="antialiased">  
          <!-- Navigation-->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-fixed">
             <div class="container px-4 px-lg-5">
                     <h1><a class="navbar-brand text-white" href="../Dashboard.php">SIMS</a></h1>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav ml-auto">
                         <li class="nav-item"><a class="nav-link active" href="../Dashboard.php">Home</a></li>
                     
                      </div>
                       
                      </ul>   
                     </div>
             </div>
          </nav>

            <div class="container">

                <div class='register-box'>

                    <div class="register-form">
                        <h3 class="text-center mt-2">Edit Student Details</h3>
                        <?php 
                          
                            $edit_profile = new display();
                            $edit_profile->showusereditprofile($student_id);
                        ?>
                    </div>
              
                </div>
            </div>

          <div class="py-3">

          </div>
          
            
          <footer class="py-3 bg-dark fixed-bottom mt-2">
              <div class="container">
                  <p class="mb-0 text-center text-white">All rights reserved School Information Management System &copy;2023</p>
              </div>
          </footer>
       
    </body>
</html>
<script src="js/bootstrap.bundles.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>