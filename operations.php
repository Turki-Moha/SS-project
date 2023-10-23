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
            $sql = "SELECT * FROM users WHERE user_name = '$username'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if(password_verify($password, $row['user_password'])){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['user_role'] = $row['user_role'];
                    return true;
                }else{
                    throw new Exception("Invalid password");
                }
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
            $sql = "SELECT * FROM users WHERE user_role = 'admin'";
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
    
}
?>