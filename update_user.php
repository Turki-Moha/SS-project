<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include_once 'operations.php';
        $operations = new Operations();
        $operations->dbConnect();
        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
            try{
                $result = $operations->displayUser($user_id);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<form method='POST'>";
                        echo "<div class='form-grid'>";
                        echo "<label for='username'>Username:</label>";
                        echo "<input type='text' id='username' name='username' value='".$row['user_name']."' ><br>";
                        echo "</div>";
                        echo "<div class='form-grid'>";
                        echo "<label for='email'>Email:</label>";
                        echo "<input type='text' id='email' name='email' value='".$row['user_email']."' ><br>";
                        echo "</div>";
                        echo "<div class='form-grid'>";
                        echo "<label for='password'>Password:</label>";
                        echo "<input type='password' id='password' name='password' value='".$row['user_password']."' ><br>";
                        echo "</div>";
                        echo "<div class='form-grid'>";
                        echo "<input class='Button' type='submit' value='Update' name='submit'></button>";
                        echo "</div>";
                        echo "</form>";
                    }

                    if(isset($_POST['submit'])){
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        if($operations->updateUser($user_id, $username, $email, $password)){
                            echo "User updated successfully";
                            header("Location: main.php");
                        }
                    }
                    
                }else{
                    echo "No user found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    ?>
</body>
</html>