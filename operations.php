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
    // retrive users from admin dashboard function for demonstration purposes in admin panel
    public function retrieveUsers(){
        try{
            $sql = "SELECT * FROM users";
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

    
}
?>