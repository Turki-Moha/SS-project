<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
        <input class="Button" type="submit" value="login" name="submit"></button>
        </div>
    </form>
</body>
</html>
<?php
    include_once 'operations.php';
    $operations = new Operations();
    $operations->dbConnect();
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $verify_password = $_POST['password'];
        try{
            if($operations->insecureLoginUser($username, $verify_password)){
                $_SESSION['user_id'] = $row['user_id'];
                echo "User logged in successfully";
                header("Location: main.php");

            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
