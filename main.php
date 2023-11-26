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
            // display all courses in a table
            try{
                $result = $operations->retrieveCourses();
                if($result->num_rows > 0){
                    echo "<span style='font-size: 20px;margin:10px;display:block;'>Courses of the system</span>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>course_name</th>";
                    echo "<th>course_description</th>";
                    echo "<th>credits</th>";
                    echo "</tr>";
                    echo "<tr>";
                    while($row = $result->fetch_assoc() ){
                        echo "<td>".$row['course_name']."</td>";
                        echo "<td>".$row["course_description"]."</td>";
                        echo "<td>".$row["course_credits"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<style>table, th, td {border: 1px solid black;}</style>
                    <style>table {border-collapse: collapse;}</style>
                    <style>th, td {padding: 5px;}</style>
                    <style>th {text-align: left;}</style>
                    <style>table {width: 100%;}</style>
                    <style>th,tr,td {background-color: #f1f1f1;color: black;}</style>
                    ";
                }else{
                    echo "No courses found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }


                // display registered courses based on the user account 
                if(isset($_SESSION['user_id'])){
                    $user_id = $_SESSION['user_id'];
                    try{
                        $result = $operations->displayRegisteredCourses($user_id);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                // display courses in a table
                                echo "<span style='font-size: 20px;margin:10px;display:block;'>Registered courses</span>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>course_name</th>";
                                echo "<th>credits</th>";
                                echo "<th>semester</th>";
                                echo "<th>year</th>";
                                echo "<th>grade</th>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>".$row['course_name']."</td>";
                                echo "<td>".$row["course_credits"]."</td>";
                                echo "<td>".$row["enrollment_semester"]."</td>";
                                echo "<td>".$row["enrollment_year"]."</td>";
                                echo "<td>".$row["enrollment_grade"]."</td>";
                                echo "</tr>";
                                echo "</table>";
                                echo "<style>table, th, td {border: 1px solid black;}</style>
                                <style>table {border-collapse: collapse;}</style>
                                <style>th, td {padding: 5px;}</style>
                                <style>th {text-align: left;}</style>
                                <style>table {width: 100%;}</style>
                                <style>th,tr,td {background-color: #f1f1f1;color: black;}</style>
                                ";
                            }
                        }else{
                            echo "No courses registered found";
                        }
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }else{
                    echo "No courses registered found";
                }
            ?>
    </div>
</body>
</html>