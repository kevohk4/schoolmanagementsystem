<?php
class funct extends dbh{


//Authenticate users
protected function getpassword($username, $password) {
   $sql = "SELECT * FROM users WHERE email = '$username'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;

   if ($numRows == 1) {
       $row = $result->fetch_assoc();  // Fetch the row data
       $hashedPassword = $row['password'];

       // Verify the entered password with the hashed password
       if (password_verify($password, $hashedPassword)) {
           session_start();
           $_SESSION['role_id'] = $row['role_id'];
           $_SESSION['username'] = $username;
           $_SESSION['user_id'] = $row['id'];
             // Assign the role_id value from the fetched row
          header("Location: Dashboard.php");
         exit();
       }
   }

   echo '<p style="color:red;padding: 4px;">Your email or password is invalid. Please try again or register.</p>';
}

//Authentication

//Search email from table users
protected function getemail($email){
   $sql = "SELECT * FROM users WHERE email = '$email'";
   $result = $this->connect()->query($sql);
   // Check if the query executed successfully
   if ($result) {
      $numRows = $result->num_rows;
      
      if($numRows == 1) {
         echo '<p style="color:green;padding: 4px;">Your new password will be sent to your Email</p>';
      }
      else {
         echo '<p style="color:red;padding: 4px;font-size:25px">Email not found </p>';
      }
   }
   else {
      echo '<p style="color:red;padding: 4px;font-size:25px">Error: ' . $this->connect()->error . '</p>';
   }
}

//Get Student profile
protected function getProfile($user_id) {
   $sql = "SELECT * FROM student WHERE student_ID = '$user_id'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;

   if ($numRows > 0) {
       $data = array(); // Initialize the $data array
       while ($row = $result->fetch_assoc()) {
           $data[] = $row; // Add each row to the $data array
       }
       return $data;
   } else {
       return null; // Return null if data is not found
   }
}

//Get Staff user profile
protected function getstaffProfile($user_id) {
   $sql = "SELECT * FROM teachers WHERE user_ID = '$user_id'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;

   if ($numRows > 0) {
       $data = array(); // Initialize the $data array
       while ($row = $result->fetch_assoc()) {
           $data[] = $row; // Add each row to the $data array
       }
       return $data;
   } else {
       return null; // Return null if data is not found
   }
}


//Get user profile for editing
protected function getedituserprofile($student_id) {
   $sql = "SELECT * FROM student WHERE student_ID = '$student_id'";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;

   if ($numRows > 0) {
       $data = array(); // Initialize the $data array
       while ($row = $result->fetch_assoc()) {
           $data[] = $row; // Add each row to the $data array
       }
       return $data;
   } else {
       return null; // Return null if data is not found
   }
}




//Courses
protected function getcourses(){
   $sql = "SELECT * FROM courses";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      $data = array(); // Initialize the $data array
      while($row = $result->fetch_assoc()){
         $data[] = $row; // Add each row to the $data array
      }
      return $data;
   }
}

//Count all students
protected function countstudents(){
   $sql = "SELECT COUNT(*) as total_students FROM student";
   $result = $this->connect()->query($sql);
   
   if (!$result) {
      // Display the specific error message
      echo 'Error executing the query: ' . $this->connect()->error;
      return;
   }

   $row = $result->fetch_assoc();
   $total_students = $row['total_students'];
   return $total_students;
}

// Count all Teachers
protected function countTeachers(){
   $sql = "SELECT COUNT(*) as total_teachers FROM teachers";
   $result = $this->connect()->query($sql);
   
   if (!$result) {
      // Display the specific error message
      echo 'Error executing the query: ' . $this->connect()->error;
      return;
   }

   $row = $result->fetch_assoc();
   $total_students = $row['total_teachers'];
   return $total_students;
}

//countCourses

protected function countClasses(){
   $sql = "SELECT COUNT(*) as all_classes FROM classes";
   $result = $this->connect()->query($sql);
   
   if (!$result) {
      // Display the specific error message
      echo 'Error executing the query: ' . $this->connect()->error;
      return;
   }

   $row = $result->fetch_assoc();
   $total_students = $row['all_classes'];
   return $total_students;
}


//Count Enrolled students

protected function countEnrolled(){
   $sql = "SELECT COUNT(*) as all_enrolled FROM enrollment";
   $result = $this->connect()->query($sql);
   
   if (!$result) {
      // Display the specific error message
      echo 'Error executing the query: ' . $this->connect()->error;
      return;
   }

   $row = $result->fetch_assoc();
   $total_students = $row['all_enrolled'];
   return $total_students;
}

//All students
protected function getStudents() {
   $sql = "SELECT student.*, grades.grade_name
           FROM student
           JOIN grades ON student.grade_id = grades.id";

   $result = $this->connect()->query($sql);
   
   if (!$result) {
      // Query execution failed, handle the error
      echo "Error executing query: " . $this->connect()->error;
      return false;
   }

   $numRows = $result->num_rows;

   if ($numRows > 0) {
      $data = array(); // Initialize the $data array
      while ($row = $result->fetch_assoc()) {
         $data[] = $row; // Add each row to the $data array
      }
      return $data;
   }  
      // No rows found
      echo "<h4 style='color:red'>Students not found</h4>";
      
   return array();
}

//All Grades
protected function getGrades(){
   $sql = "SELECT * FROM grades";
   $result = $this->connect()->query($sql);
   $numRows = $result->num_rows;
   if($numRows > 0){
      $data = array(); // Initialize the $data array
      while($row = $result->fetch_assoc()){
         $data[] = $row; // Add each row to the $data array
      }
      return $data;
   }
}



//Display all students Enrolled
protected function getStudentsEnrolled(){
         $sql = "SELECT s.first_name, s.student_ID, s.last_name, s.email, s.contact, e.term, e.enrollment_date, e.remarks, g.grade_name
         FROM enrollment e
         JOIN student s ON e.student_id = s.student_ID
         JOIN grades g ON e.grade_id = g.id";

      $result = $this->connect()->query($sql);

      if (!$result) {
      // Query execution failed
      echo "Error: " . $this->connect()->error . ". Query: " . $sql;
      return []; // Return an empty array or handle the error as needed
      }

      $numRows = $result->num_rows;

      if ($numRows > 0) {
      $data = array(); // Initialize the $data array
      while ($row = $result->fetch_assoc()) {
         $data[] = $row; // Add each row to the $data array
      }
      return $data;
      }
}

// Display all teachers
protected function getTeachers() {
   $sql = "SELECT * FROM teachers";
   $result = $this->connect()->query($sql);

   if ($result === false) {
       echo "Error: " . $this->connect()->error;
       return array(); // Return an empty array on error
   }

   $data = array(); // Initialize the $data array

   while ($row = $result->fetch_assoc()) {
      $data[] = $row; // Add each row to the $data array
   }

   return $data;
}

//Display all classes

protected function getClasses() {
   $sql = "SELECT c.id, c.class_name, c.code, g.grade_name 
           FROM classes AS c
           JOIN grades AS g ON c.grade_id = g.id";

   $result = $this->connect()->query($sql);

   if ($result === false) {
       echo "Error: " . $this->connect()->error;
       return array(); // Return an empty array on error
   }

   $data = array(); // Initialize the $data array

   while ($row = $result->fetch_assoc()) {
      $data[] = $row; // Add each row to the $data array
   }

   return $data;
}



// Display all subjects
protected function getSubjects() {
   $sql = "SELECT * FROM subjects";
   $result = $this->connect()->query($sql);

   if ($result === false) {
       echo "Error: " . $this->connect()->error;
       return array(); // Return an empty array on error
   }

   $data = array(); // Initialize the $data array

   while ($row = $result->fetch_assoc()) {
      $data[] = $row; // Add each row to the $data array
   }

   return $data;
}


protected function getRolesWithPermissions() {
    $sql = "SELECT p.name AS permission_name, r.role_name
            FROM role_permissions rp
            JOIN permissions p ON rp.permission_id = p.id
            JOIN roles r ON rp.role_id = r.id";

    $result = $this->connect()->query($sql);

    if ($result && $result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    return array(); // Return an empty array if no data found
}



protected function getdashboardroles() {
   $sql = "SELECT p.name AS permission_name, r.role_name
           FROM role_permissions rp
           JOIN permissions p ON rp.permission_id = p.id
           JOIN roles r ON rp.role_id = r.id";

   $result = $this->connect()->query($sql);

   if ($result && $result->num_rows > 0) {
       $data = array();
       while ($row = $result->fetch_assoc()) {
           $data[] = $row;
       }
       return $data;
   }

   return array(); // Return an empty array if no data found
}


   /*

      $query = "SELECT p.name AS permission_name, r.role_name
               FROM role_permissions rp
               JOIN permissions p ON rp.permission_id = p.id
               JOIN roles r ON rp.role_id = r.id";
      $result = $mysqli->query($query);

      // Fetch the records
      if ($result) {
         while ($row = $result->fetch_assoc()) {
            $permissionName = $row['permission_name'];
            $roleName = $row['role_name'];
            // Process the records as needed
            // e.g., store in an array, display, etc.
         }
         $result->free();
      } else {
         // Error handling
         echo "Error: " . $mysqli->error;
      }*/

   






/*/Roles
protected function getRolesWithPermissions() {
   // Connect to the database
   $mysqli = new mysqli('localhost', 'username', 'password', 'database_name');

   // Check connection
   if ($mysqli->connect_errno) {
      echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
      exit();
   }

   // Get roles and their respective permissions
   $query = 'SELECT r.name AS role_name, p.name AS permission_name
             FROM roles r
             JOIN role_permissions rp ON r.id = rp.role_id
             JOIN permissions p ON rp.permission_id = p.id';
   $result = $mysqli->query($query);

   // Store roles and permissions in an array
   $roles = array();
   while ($row = $result->fetch_assoc()) {
      $roleName = $row['role_name'];
      $permissionName = $row['permission_name'];
      $roles[$roleName][] = $permissionName;
   }

   // Display roles and permissions
   foreach ($roles as $roleName => $permissions) {
      echo "Role: $roleName<br>";
      echo "Permissions: " . implode(', ', $permissions) . "<br><br>";
   }

   // Close the database connection
   $mysqli->close();
}*/

}
?>