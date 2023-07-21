<?php

include 'includes/dbh.inc.php';
include 'includes/functions.php';
include 'includes/disp.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login | SIMS</title>
        <link rel="canonical" href="">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootsrap.min.grid.css">
        <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
                .login-box {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 70vh;
                }
                .login-form {
                    max-width: 400px;
                    width: 100%;
                    padding: 20px;
                    background-color: #f8f9fa;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
        </style>
          
    
    </head>
    <body class="antialiased">
      <body class="antialiased">  
          <!-- Navigation-->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-fixed">
             <div class="container px-4 px-lg-5">
                     <h1><a class="navbar-brand text-white" href="index.html">SIMS</a></h1>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="navbar-nav ml-auto">
                         <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
                      </div>
                       
                      </ul>   
                     </div>
             </div>
          </nav>

            <div class="container">

                <div class='login-box'>

                    <div class="login-form">

                        <?php
                            require_once("includes/config.php");
                            session_start();
                            if($_SERVER["REQUEST_METHOD"] == "POST") {
                                $username = mysqli_real_escape_string($db,$_POST['username']);
                                $password = mysqli_real_escape_string($db,$_POST['password']);
                                $login = new display();
                                $login->showPassword($username,$password);
                            }
                        ?>

                        <h1 class="text-center">Login</h1>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input type="email" class="form-control" name="username" placeholder="Enter your Email" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                            </div>
                            
                            <a href="forgotpassword.php" class="mt-1 mb-2">Forgoten You password?</a>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
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