<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // retrive user data from the database
    include_once 'operations.php';
    $operations = new Operations();
    $operations->dbConnect();
    
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        try{
            $result = $operations->displayUser($user_id);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<div class='form-design'>";
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
                    echo "Update user: <a href='update_user.php?user_id=".$row['user_id']."'>Update</a>";
                    echo "</div>";
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