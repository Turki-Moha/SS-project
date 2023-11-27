<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
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
    <?php
        // validate input and sanitize as well as check if the user exists
        include_once 'operations.php';
        $operations = new Operations();
        $operations->dbConnect();
        if(isset($_POST['submit'])){
            // sanitize input
            $username = $operations->sanitize($_POST['username']);
            $password = $operations->sanitize($_POST['password']);
            if($operations->loginUser($username, $password)){
                echo "Login successful";
                if($operations->isAdmin($username)){
                    header("Location: admin.php");
                }else{
                    header("Location: main.php");
                }
            }else{
                echo "Login failed";
            }
        }

    ?>
</body>
</html>