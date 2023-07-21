<?php
    include 'includes/config.php';
    include 'includes/dbh.inc.php';
    include 'includes/functions.php';
    include 'includes/disp.php';
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
    <title>Dashboard | SIMS</title>
    <link rel="canonical" href="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootsrap.min.grid.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
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
          <h3 class="h3">Dashboard</h3>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="py-2" style="display: flex;align-content: center;">
                                 
            </div>
            
          </div>
        </div>

        <?php
    

        //Administrator role
        if($role_id == 1){

          echo '<h3> Administrator </h3> 
              <div class="row">';
                //display roles and permissions
                echo '<div class="col-md-2 col-lg-2 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> User Roles</h5>
                      <p class="card-text mt-2 mb-0"><a href="Roles.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                //View all students / Add new Student
                echo '<div class="col-md-3 col-lg-3 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> <i class="fas fa-user-friends "></i> All Students</h5>';
                      
                        $totalstudents = new display();
                        $totalstudents->showTotalStudents();

                      echo '<p class="card-text mt-0 mb-0"><a href="students.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                //Count all Courses
                echo '<div class="col-md-3 col-lg-3 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"> <i class="fa fa-book" aria-hidden="true"></i> Classes</h5>';
                      
                        $classes = new display();
                        $classes->showAllClasses();
            
                      echo '
                    </div>
                  </div>
                </div>';

                //Count all Courses
                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                    <h5 class="card-title mb-0"> Attendances</h5>
                    <p class="card-text mt-2 mb-0"><a href="allattendaces.php" class="btn btn-primary btn-sm">  Open </a></p>
                
                     
                    </div>
                  </div>
              </div>';

                  //display Add Courses
                  echo '
                 
                      <div class="col-md-2 col-lg-2 mb-3">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title"> <i class="fas"> + Add New Stream</i></h5>
                            <p class="card-text"><a href="courses.php" class="btn btn-primary btn-sm">  Open </a></p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2 col-lg-2 mb-3">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title"> <i class="fas"> + Add New Student</i></h5>
                            <p class="card-text"><a href="Students/newstudent.php" class="btn btn-primary btn-sm">  Open </a></p>
    
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2 col-lg-2 mb-3">
                        <div class="card-body">
                          <h5 class="card-title mb-0"> <i class="fas fa-user-friends "></i> Teachers</h5>';
                            $countteachers = new display();
                            $countteachers->showTotalTeachers();
                          echo '<p class="card-text mt-0 mb-0"><a href="Teachers/allteachers.php" class="btn btn-primary btn-sm">  Open </a></p>
                        </div>
                      </div>';

                      echo'<div class="col-md-2 col-lg-2 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"> <i class="fas"> + Add Subjects</i></h5>
                          <p class="card-text"><a href="Units.php" class="btn btn-primary btn-sm">  Open </a></p>
                        </div>
                      </div>
                    </div>';

                    //View all enrolled students
                    echo '<div class="col-md-3 col-lg-3 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-0"> <i class="fas fa-user-friends "></i> Enrollment</h5>';
                            $enrolledstudents = new display();
                            $enrolledstudents->showTotalEnrolledstudents();
                          echo '<p class="card-text mt-0 mb-0"><a href="enrollment.php" class="btn btn-primary btn-sm">  Open </a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>';

        }
        else if ($role_id == 2){



        }

        else if($role_id == 3){

          echo '<h3> Teachers Dashboard </h3>';
        
              $staffprofile = new display();
              $staffprofile->showUStaffprofile($user_id);
        
          echo '<div class="row">';
                //display roles and permissions
                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> Enrollment Status</h5>
                      <p class="card-text mt-2 mb-0"><a href="Teachers/studentenrolment.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> Upload Marks</h5>
                      <p class="card-text mt-2 mb-0"><a href="Teachers/uploadmarks.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0">Class Attendance</h5>
                      <p class="card-text mt-2 mb-0"><a href="Teachers/attendance.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>
              </div>';
            echo'
            ';


        }
        else if($role_id == 4){

          echo '<h3> Student Dashboard </h3>';

            $userprofile = new display();
            $userprofile->showUserprofile($user_id);

          echo '<div class="row">';
                //display roles and permissions
                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> Enrollment Status</h5>
                      <p class="card-text mt-2 mb-0"><a href="Students/studentenroll.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> Transcript</h5>
                      <p class="card-text mt-2 mb-0"><a href="Students/Transcripts.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>';

                echo '<div class="col-md-4 col-lg-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-0"> Attendances</h5>
                      <p class="card-text mt-2 mb-0"><a href="Students/Attendances.php" class="btn btn-primary btn-sm">  Open </a></p>
                    </div>
                  </div>
                </div>
              </div>';




            
            echo'
            
            
            
            
            ';
        }
        
        else{


        }
        
        
        
        ?>  
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

    <script src="js/bootstrap.bundles.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
