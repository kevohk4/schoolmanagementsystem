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
    $marks = $_POST['marks'];
    $subjectId = $_POST['subject'];

    // Execute the SQL query to retrieve the student with the given student_ID
    $sql_students = "SELECT * FROM student WHERE student_ID = '$studentId'";
    $result_students = mysqli_query($db, $sql_students);

    if ($result_students) {
        // Check if any result is returned from the query
        if (mysqli_num_rows($result_students) > 0) {
            // Student found, now insert the data into the transcripts table

            // Prepare the SQL statement
            $sql_insert = "INSERT INTO transcripts (student_id, grade_id, subject_id, marks, term, remarks)
                VALUES ('$studentId', (SELECT grade_id FROM student WHERE student_ID = '$studentId'), '$subjectId', '$marks', 'Term 1', '1')";

            // Execute the SQL statement
            if (mysqli_query($db, $sql_insert)) {
                // Marks uploaded successfully!
                echo "<h1 style='color:green'>Marks uploaded was successfull</h1>";
                // Redirect to uploadmarks.php after a short delay (3 seconds in this example)
                header("Refresh: 3; URL=Teachers/uploadmarks.php");
                exit();
            } else {
                
            echo "Error: " . mysqli_error($db);
    }

        } else {
            echo 'Student not found.';
        }
    } else {
        echo "Error: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>