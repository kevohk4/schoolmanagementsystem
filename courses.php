<?php
    include 'includes/config.php';
   // session_start();
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Classes | SIMS</title>
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
          <h4 class="h3"> Classes (Streams)</h4>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="py-2" style="display: flex;align-content: center;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    + Add New Class
                </button>                   
            </div>
            
          </div>
        </div>

                         <?php
                            // Check if the form is submitted
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Retrieve form data
                                $classes = $_POST['name'];
                                $code = $_POST['code'];
                                $grade_id = $_POST['grade'];

                                // Insert data into the database
                                $sql = "INSERT INTO classes (class_name,code,grade_id)
                                VALUES ('$classes', '$code','$grade_id')";
        
                                    // Execute the query
                                    if ($result = mysqli_query($db, $sql)) {
                                    echo "<p style='color:green;font-size:30px'>Course Added successful</p>";
                                    } else {
                                    echo "Error: " . mysqli_error($db);
                                    }

                                    // Close the database connection
                                    mysqli_close($db);
                                         
                             
                            }
                        ?>

        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return valid()">

                    <div class="modal-body">
                     <div class="container-fluid">

                        <div class="row mb-1">
                            <label for="dob" class="col-md-12 col-form-label">Class Name (Stream) </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="name"  required>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="dob" class="col-md-12 col-form-label">Class Code </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="code"  required>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="dob" class="col-md-12 col-form-label">Grade</label>
                            <div class="col-md-12">
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
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script>
            $('#exampleModal').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM
                
            });
        </script>

        <div class="table-responsive pb-0">
                    <table class="table table-light table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Code</th>
                                <th>Class Name</th>
                                <th>Grade</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $classes = new display();
                                $classes->DisplayClasses();
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

    <script src="js/bootstrap.bundles.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>