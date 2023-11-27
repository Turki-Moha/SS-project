<?php

require 'db.php';

class Operations extends DBConfig{
    public $conn;
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;
    public function __construct(){
        $dbParam = new DBConfig();
        $this->servername = $dbParam->servername;
        $this->username = $dbParam->username;
        $this->password = $dbParam->password;
        $this->dbname = $dbParam->dbname;
        $dbParam = null;
    }
    public function dbConnect(){
        try{
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if(mysqli_connect_errno()){
                throw new Exception("Could not connect to database" . mysqli_connect_error());
            }else{
                return true;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function registerUser($username, $password, $email){
        try{
            $sql = "INSERT INTO users (user_name, user_password, user_email,user_role) VALUES ('$username', '$password', '$email','user')";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("User registration failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // insecure loginUser function for demonstration purposes
    public function insecureLoginUser($username, $password){
        try{
            $sql = "SELECT * FROM users WHERE user_name = '$username' and user_password = '$password'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_role'] = $row['user_role'];
                return true;

            }else{
                throw new Exception("Invalid username");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // secure loginUser function using prepared statements and input validation
    public function loginUser($username, $password){
        try{
            $sql = "SELECT * FROM users WHERE user_name = ? and user_password = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        if($result->num_rows > 0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_role'] = $row['user_role'];
            return true;
        }else{
            echo "Invalid username or password";
        }
    }

    // retrive users from admin dashboard function for demonstration purposes in admin panel
    public function retrieveUsers(){
        try{
            $sql = "SELECT * FROM users ";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No users found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // retrive courses and display them in a table
    public function retrieveCourses(){
        try{
            $sql = "SELECT * FROM course";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No courses found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // delete course from admin panel
    public function deleteCourse($course_id){
        try{
            $sql = "DELETE FROM course WHERE course_id = '$course_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Course deletion failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // update course
    public function updateCourse($course_id, $course_name, $course_description, $credits){
        try{
            $sql = "UPDATE course SET course_name = '$course_name', course_description = '$course_description', course_credits = '$credits' WHERE course_id = '$course_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Course update failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // retrive single course 
    public function retrieveCourse($course_id){
        try{
            $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("Course not found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // add course
    public function addCourse($course_name, $course_description, $credits){
        try{
            $sql = "INSERT INTO course (course_name, course_description, course_credits) VALUES ('$course_name', '$course_description', '$credits')";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Course addition failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // display registered courses based on the user account
    public function displayRegisteredCourses($user_id){
        try{
            $sql = "SELECT * FROM enrollment INNER JOIN course ON enrollment.course_id = course.course_id WHERE enrollment.user_id = '$user_id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No courses found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // check if user is admin
    public function isAdmin($username){
        try{
            $sql = "SELECT * FROM users WHERE user_name = '$username' and user_role = 'admin'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // retrive students 
    public function retrieveStudents(){
        try{
            $sql = "SELECT * FROM users WHERE user_role = 'user'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No students found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // retrive single student
    public function retrieveStudent($user_id){
        try{
            $sql = "SELECT * FROM users WHERE user_id = '$user_id' AND user_role = 'user'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("Student not found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // delete user from admin panel
    public function deleteUser($user_id){
        try{
            $sql = "DELETE FROM users WHERE user_id = '$user_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("User deletion failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    // retrive user data from the database
    public function displayUser($user_id){
        try{
            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No user found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    public function updateUser($user_id, $username, $email, $password){
        try{
            // add query to change the role of the user
            // $sql = "UPDATE users SET user_role='admin' WHERE user_id=12;#"
            // UPDATE `users` SET `user_role` = 'admin' WHERE `users`.`user_id` = 12;UPDATE `enrollment` SET `enrollment_grade` = 'D' WHERE `enrollment`.`enrollment_id` = 1;

            $sql = "UPDATE users SET user_name = '$username', user_email = '$email', user_password = '$password' WHERE user_id = $user_id";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("User update failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // enroll students in courses which have enrollment_id	student_id	course_id	enrollment_semester	enrollment_year	enrollment_grade	
    public function enroll($user_id, $course_id,$semester, $year, $grade){
        try{
            $sql = "INSERT INTO enrollment (user_id, course_id, enrollment_semester, enrollment_year, enrollment_grade) VALUES ('$user_id', '$course_id', '$semester', '$year', '$grade')";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Enrollment failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    //display enrolled courses with each student
    public function displayEnrolledCourses(){
        try{
            $sql = "SELECT * FROM enrollment INNER JOIN course ON enrollment.course_id = course.course_id INNER JOIN users ON enrollment.user_id = users.user_id";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("No courses found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // check if user is already enrolled in a course
    public function checkEnrollment($user_id, $course_id){
        try{
            $sql = "SELECT * FROM enrollment WHERE user_id = '$user_id' AND course_id = '$course_id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // delete enrollment
    public function deleteEnrollment($user_id, $course_id){
        try{
            $sql = "DELETE FROM enrollment WHERE user_id = '$user_id' AND course_id = '$course_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Enrollment deletion failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // update enrollment
    public function updateEnrollment($user_id, $course_id, $semester, $year, $grade){
        try{
            $sql = "UPDATE enrollment SET enrollment_semester = '$semester', enrollment_year = '$year', enrollment_grade = '$grade' WHERE user_id = '$user_id' AND course_id = '$course_id'";
            if($this->conn->query($sql)){
                return true;
            }else{
                throw new Exception("Enrollment update failed");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // retrieve enrollment
    public function retrieveEnrollment($user_id, $course_id){
        try{
            $sql = "SELECT * FROM enrollment WHERE user_id = '$user_id' AND course_id = '$course_id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                return $result;
            }else{
                throw new Exception("Enrollment not found");
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    // sanitize input
    public function sanitize($input){
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return $input;
    }
}
?>