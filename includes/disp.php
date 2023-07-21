<?php
class display extends funct{
    
    //User Authentication
    public function showPassword($username,$password){
        $datas = $this->getpassword($username,$password);
        
    }

    //Search user email in the database for password reset
    public function searchemail($email){
        $datas = $this->getemail($email);   
    }

    public function Dispartypes(){
        $datas = $this->getcourses();
        $counter = 1; // Define and initialize the counter variable
        foreach ($datas as $data ){
            $course = $data['course_name'];
            $course_code = $data['code'];
    
            echo "
                <tr>
                    <td>$counter</td>
                    <td>$course_code</td>
                    <td><a href='' style='text-decoration:none'>$course</a></td>
                </tr>
            ";
            $counter++; // Increment the counter
        }
    }
    
    //Count all students
    public function showTotalStudents(){
        $totalStudents = $this->countstudents();
        echo "<p class='card-text text-success mt-0 mb-0' style='font-size:30px'>" .$totalStudents. "</p>";
    }

    //Count all Teachers
    public function showTotalTeachers(){
        $totalTeachers = $this->countTeachers();
        echo "<p class='card-text text-success mt-0 mb-0' style='font-size:30px'>" .$totalTeachers. "</p>";
    }

    

    //Count all enrolled students
    public function showTotalEnrolledstudents(){
        $totalenrolled = $this->countEnrolled();
        echo "<p class='card-text text-success mt-0 mb-0' style='font-size:30px'>" .$totalenrolled. "</p>";
    }

    //Count all Courses
    public function showAllClasses(){
        $allclasses = $this->countClasses();
        echo "<p class='card-text text-success mt-0 mb-0' style='font-size:30px'>" .$allclasses. "</p>";
    }

    //Display all grades
    public function ShowGrades(){
        $datas = $this->getGrades();
        foreach ($datas as $data ){
            $grade_name = $data['grade_name'];
            $grade_id = $data['id'];
            echo "
                <option value='$grade_id'>$grade_name</option>
            ";
        }
    }


    //Displays Students

    public function DisplayStudents() {
        $datas = $this->getStudents();
        $counter = 1; // Define and initialize the counter variable
     
        foreach ($datas as $data) {
           $fname = $data['first_name'];
           $lname = $data['last_name'];
           $student_id = $data['student_ID'];
           $grade = $data['grade_name'];
           $dob = $data['Date_of_birth'];
           $gender = $data['gender'];
           $email = $data['email'];
           $contact = $data['contact'];
     
           echo "
              <tr>
                 <td>$counter</td>
                 <td><a href='' style='text-decoration:none'>$fname $lname</a></td>
                 <td>$student_id</td>
                 <td>$grade</td>
                 <td>$email</td>
                 <td>$contact</td>
                 <td>
                    <form method='POST'>
                       <button type='submit' class='btn btn-outline-success btn-sm' name='deleteUser' onclick=\"return confirm('Are you sure you want to delete the student?');\">Delete</button>
                       <input type='hidden' name='userId' value='$student_id'>
                    </form>
                 </td>
              </tr>
           ";
     
           $counter++; // Increment the counter
        }
     
        // Check if the form is submitted and the 'deleteUser' button is clicked
        if (isset($_POST['deleteUser'])) {
           $userId = $_POST['userId'];
     
           // Perform the student deletion operation in the database
           $sql_student = "DELETE FROM student WHERE student_ID = '$userId'";
           $sql_users = "DELETE FROM users WHERE id = '$userId'";
     
           if (mysqli_query($this->connect(), $sql_student) && mysqli_query($this->connect(), $sql_users)) {
              // Student and user deleted successfully
              echo "<p>Student and user deleted successfully.</p>";
           } else {
              // Error occurred while deleting the student or user
              echo "Error: " . mysqli_error($this->connect());
           }
        }
     }
     
     
     


    //Display all students enrolled
    public function DisplayStudentsenrolled(){
        $datas = $this->getStudentsEnrolled();
        $counter = 1; // Define and initialize the counter variable
        if (!empty($datas)) { // Check if $datas is not null or empty
        
        foreach ($datas as $data ){
            $fname = $data['first_name'];
            $lname = $data['last_name'];

            $remarks = $data['remarks'];

            $grade= $data['grade_name'];

            $student_id = $data['student_ID'];
            $contact = $data['contact'];


            $date = $data['enrollment_date'];
            $term = $data['term'];
            $reamarks = $data['remarks'];
            $email = $data['email'];
            $term = $data['term'];
    
            echo "
                <tr>
                    <td>$counter</td>
                    <td><a href='' style='text-decoration:none'>$fname $lname</a></td>
                    <td>$student_id</td>
                    <td>$grade</td>
                    <td>$email</td>
                    <td>$term</td>
                    <td>$date</td>
                    <td>$reamarks</td>
                </tr>
            ";
            $counter++; // Increment the counter
        } 
    }

    }


        // Display Teachers
    public function DisplayTeachers()
    {
        $datas = $this->getTeachers();
        $counter = 1; // Define and initialize the counter variable
        if (!empty($datas)) { // Check if $datas is not null or empty
            foreach ($datas as $data) {
                $fname = $data['first_name'];
                $lname = $data['last_name'];
                $dob = $data['dob'];
                $gender = $data['gender'];
                $email = $data['email'];
                $contact = $data['phone'];
                $idno = $data['id_number'];
                $idno = $data['id_number'];
                $idno = $data['id_number'];


                echo "
                    <tr>
                        <td>$counter</td>
                        <td><a href='#' style='text-decoration:none'>$fname $lname</a></td>
                        <td>$idno</td>
                        <td>$contact</td>
                        <td>$email</td>
                        <td>$dob</td>
                        <td>$gender</td>
                        
                        
                    </tr>
                ";
                $counter++; // Increment the counter
            }
        }
    }

    // Display Classes
    

    public function DisplayClasses()
    {
        $datas = $this->getClasses();
        $counter = 1; // Define and initialize the counter variable
        if (!empty($datas)) { // Check if $datas is not null or empty
            foreach ($datas as $data) {
                $classname = $data['class_name'];
                $code = $data['code'];
                $grade = $data['grade_name']; // Access the correct column 'grade_name'

                echo "
                    <tr>
                        <td>$counter</td>
                        <td>$code</td>
                        <td>$classname</td>
                        <td>$grade</td>
                    </tr>
                ";
                $counter++; // Increment the counter
            }
        }
    }
    

    //Display Subjects information

    public function DisplaySubjects()
    {
        $datas = $this->getSubjects();
        $counter = 1; // Define and initialize the counter variable
        if (!empty($datas)) { // Check if $datas is not null or empty
            foreach ($datas as $data) {
                $subject = $data['subject_name'];
                $code = $data['code'];
               
                echo "
                    <tr>
                        <td>$counter</td>
                        <td>$code</td>
                        <td>$subject</td>
                    </tr>
                ";
                $counter++; // Increment the counter
            }
        }
    }


    public function displayRolesPermissions() {
    $datas = $this->getRolesWithPermissions();
    $counter = 1;
    $previousRole = null;
    
    foreach ($datas as $data) {
        $roles = $data['role_name'];
        $permission = $data['permission_name'];
    
        if ($roles !== $previousRole) {
            echo "
                <tr>
                    <td>$counter</td>
                    <td><a href='' style='text-decoration:none'>$roles</a></td>
                    <td>$permission</td>
                    <td><a href='' class='btn btn-outline-success btn-sm' >Edit $roles Permission</a></td>
                </tr>
            ";
            
            $counter++;
        } else {
            echo "
                <tr>
                    <td></td>
                    <td></td>
                    
                    <td>$permission</td>
                    <td></td>
                    
                </tr>
            ";
        }
    
        $previousRole = $roles;
    }
}


public function Displaydashboard() {
    $datas = $this->getdashboardroles();
    $counter = 1;
    $previousRole = null;
    
    foreach ($datas as $data) {
        $roles = $data['role_name'];
        $permission = $data['permission_name'];
    
        if ($roles !== $previousRole) {
            echo "
                <tr>
                    <td>$counter</td>
                    <td><a href='' style='text-decoration:none'>$roles</a></td>
                    <td>$permission</td>
                    <td><a href='' class='btn btn-outline-success btn-sm' >Edit $roles Permission</a></td>
                </tr>
            ";
            
            $counter++;
        } else {
            echo "
                <tr>
                    <td></td>
                    <td></td>
                    
                    <td>$permission</td>
                    <td></td>
                    
                </tr>
            ";
        }
    
        $previousRole = $roles;
    }
}

//Show User profile
public function showUserprofile($user_id){
    $profileData = $this->getProfile($user_id);
    if ($profileData !== null) {
        foreach ($profileData as $data) {
            echo '<div class="">
            <p class="mb-0">Status <span class="badge badge-primary">Active</span></p>
            <p class="mt-0 mb-0">NAME: ' . $data['first_name'] . ' ' . $data['last_name'] . '</p>
            <p class="mt-0 mb-0">REGISTRATION NO.:  ' . $data['id'] . '</p>
            <p class="mt-0 mb-0"><i class="bx bx-calendar" style="color:black"> Date of Birth:</i> ' . $data['Date_of_birth'] . '</p>
            <p class="mt-0 mb-0">ENAIL: ' . $data['email'] . '</p>
            <p class="mt-0 mb-0">CONTACT: ' . $data['contact'] . ' </p>
            <p class="mt-0 mb-0">GENDER: ' . ($data['gender'] == '1' ? 'Male' : 'Female') . '</p>
            <a href="Students/studentedit.php?user=' . $user_id . '" class="btn btn-primary btn-sm mb-2 mt-2"><i class="fa fa-edit ml-3 mb-2" aria-hidden="true"></i> Edit</a>
            </div>';   

        }
    } else {
        echo "<h4 class='text-danger'>Profile is not found</h4>";
    }

}

//Show Teacher/ Staff User profile
public function showUStaffprofile($user_id){
    $profileData = $this->getstaffProfile($user_id);
    if ($profileData !== null) {
        foreach ($profileData as $data) {
            echo '<div class="">
            <p class="mb-0">Status <span class="badge badge-primary">Active</span></p>
            <p class="mt-0 mb-0">NAME: ' . $data['first_name'] . ' ' . $data['last_name'] . '</p>
            <p class="mt-0 mb-0">STAFF ID.:  ' . $data['user_ID'] . '</p>
            <p class="mt-0 mb-0"><i class="bx bx-calendar" style="color:black"> Date of Birth:</i> ' . $data['dob'] . '</p>
            <p class="mt-0 mb-0">EMAIL: ' . $data['email'] . '</p>
            <p class="mt-0 mb-0">CONTACT: ' . $data['phone'] . ' </p>
            <p class="mt-0 mb-0">GENDER: ' . $data['gender'] . '</p>
            </div>';   

        }
    } else {
        echo "<h4 class='text-danger'>Profile is not found</h4>";
    }

}

//Disply user profile for editting
// Display user profile for editing
public function showusereditprofile($student_id) {
    $datas = $this->getedituserprofile($student_id);
    if ($datas !== null) {
        foreach ($datas as $data) {
            echo '<form action="edited.php" method="POST" enctype="multipart/form-data" onsubmit="return valid()">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">First Name</label>
                            <input type="text" class="form-control" name="fname" value="' . $data['first_name'] . '" required>
                        </div>
                    </div>

                    <input type="hidded" value="'.$student_id.'" name="user">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Last Name</label>
                            <input type="text" class="form-control" name="lname" value="' . $data['last_name'] . '" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" name="email" value="' . $data['email'] . '" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Email">Contact</label>
                            <input type="text" class="form-control" name="contact" value="' . $data['contact'] . '" placeholder="Enter Contact">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Date of birth</label>
                            <input type="date" class="form-control" name="dob" value="' . $data['Date_of_birth'] . '" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="username">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="">Select Gender:-</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>';
        }
    } else {
        echo "<h4 class='text-danger'>Profile is not found</h4>";
    }
}


}
?>