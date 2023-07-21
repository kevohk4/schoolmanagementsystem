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

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Validate and sanitize the form data (you can add validation as needed)

    // Prepare and execute the database update query
    $sql = "UPDATE student 
            SET first_name = '$fname', 
                last_name = '$lname', 
                email = '$email', 
                contact = '$contact', 
                Date_of_birth = '$dob', 
                gender = '$gender'
            WHERE student_id = " . intval($user_id);

    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if ($result) {
        // Redirect to Profile.php after a successful update
        header("Location: ../Profile.php");
        exit();
    } else {
        // Handle the case when the update query fails
        echo "Error updating student information: " . mysqli_error($db);
    }
}

// Close the database connection (optional, as PHP automatically closes the connection at the end of the script)
mysqli_close($db);
?>