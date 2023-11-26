<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-design">
    <form method="POST">
            <div class="form-grid">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
            </div>
            <div class="form-grid">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
            </div>
            <div class="form-grid">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
            </div>
            <div class="form-grid">
                <input class="Button" type="submit" value="register" name="submit"></input>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    include_once 'operations.php';
    $operations = new Operations();
    $operations->dbConnect();
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        try{
            if($operations->registerUser($username, $password, $email)){
                echo "User registered successfully";
                header("Location: login.php");
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
?>
