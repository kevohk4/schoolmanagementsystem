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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $studentId = $_POST['id'];
    $attendance = $_POST['attendance'];

    // Prepare the SQL statement
    $sql_insert = "INSERT INTO attendance (student_id, status, attendance_date)
                   VALUES ('$studentId', '$attendance', NOW())";

    // Execute the SQL statement
    if (mysqli_query($db, $sql_insert)) {
        // Attendance recorded successfully!
        echo "<h1 style='color:green'>Attendance recorded successfully</h1>";
        // Redirect to uploadmarks.php after a short delay (3 seconds in this example)
        header("Refresh: 3; URL=Teachers/attendance.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
