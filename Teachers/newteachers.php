<?php
    include '../includes/config.php';
    include '../includes/dbh.inc.php';
    include '../includes/functions.php';
    include '../includes/disp.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Teacher | SIMS</title>
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
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-fixed">
        <div class="container px-4 px-lg-5">
            <h1><a class="navbar-brand text-white" href="../Dashboard.php">SIMS</a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link active" href="../Dashboard.php">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class='register-box'>
            <div class="register-form">
                <h3 class="text-center mt-2">Register a new Teacher</h3>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Retrieve form data
                    $email = $_POST['email'];
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $contact = $_POST['contact'];
                    $address = $_POST['address'];

                    $dob = $_POST['dob'];
                    $idnumber = $_POST['idno'];

                    $nationality = $_POST['nationality'];

                    $gender = $_POST['gender'];

                    $username = $_POST['fname'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirm'];

                    // Validate password confirmation
                    if ($password !== $confirmPassword) {
                        echo "<p style='color:red;font-size:18px;'>Password and confirm password do not match.</p>";
                        exit;
                    }

                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert data into the users table
                    $sql_users = "INSERT INTO users (email, username, password,role_id) VALUES ('$email', '$username', '$hashedPassword','3')";
                    if ($result_users = mysqli_query($db, $sql_users)) {
                        // Get the generated user ID
                        $user_id = mysqli_insert_id($db);

                        // Insert data into the teachers table
                        $sql_teachers = "INSERT INTO teachers (email, first_name, last_name, phone, dob, gender, id_number, nationality, address, user_ID)
                                        VALUES ('$email', '$fname', '$lname', '$contact', '$dob', '$gender', '$idnumber', '$nationality', '$address', '$user_id')";

                        if ($result_teachers = mysqli_query($db, $sql_teachers)) {
                            echo "<p style='color:green;font-size:30px'>Registration successful</p>";
                        } else {
                            echo "Error: " . mysqli_error($db);
                        }
                    } else {
                        echo "Error: " . mysqli_error($db);
                    }

                    // Close the database connection
                    mysqli_close($db);
                }
                ?>
                            
                <a class="nav-link" href="../Dashboard.php">
                    <h5 class="ml-3"> <i class="fa fa-home" aria-hidden="true"> Home</i></h5>
                </a>

                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return valid()">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Email">Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Enter Contact" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">Date of birth</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="">Select Gender:</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ID Number</label>
                                <input type="number" class="form-control" name="idno" placeholder="Enter ID Number" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control" name="nationality" placeholder="Nationality" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Grade</label>
                        <select class="form-control" name="grade" required>
                            <option value="">Select grade:</option>
                            <?php
                                $teachergrade = new display();
                                $teachergrade->ShowGrades();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm" placeholder="Enter Confirm Your Password" required >
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5">

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
