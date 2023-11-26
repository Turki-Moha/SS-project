<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div >
        <ul>
            <li><a href="index.html">Home</a></li>

            <?php
                require 'operations.php';
                $operations = new Operations();
                $operations->dbConnect();
                session_start();
                // display login or logout based on the user account
                if(isset($_SESSION['user_id'])){
                    echo "<li><a href='logout.php'>Logout</a></li>";
                }else{
                    echo "";
                }
                if(isset($_SESSION['user_id'])){
                    echo "<li><a href='view_profile.php?user_id=".$_SESSION['user_id']."'>View profile</a></li>";
                }
            ?>
        </ul>
        <?php 
                // display registered courses based on the user account 
                if(isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
                    try{
                        $result = $operations->displayRegisteredCourses($user_id);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<li><a href='course.php?course_id=".$row['course_id']."'>".$row['course_name']."</a></li>";
                            }
                        }else{
                            echo "No courses found";
                        }
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }else{
                    echo "No courses found";
                }
            ?>
    </div>
</body>
</html>