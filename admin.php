<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <li><a href="logout.php" >Log out</a></li>
    </ul>
    <span class="span-style">Users of the system</span>
    <?php
            include_once 'operations.php';
            $operations = new Operations();
            $operations->dbConnect();
            // check credintials
            session_start();
            try{
                $result = $operations->retrieveUsers();
                if($result->num_rows > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>user_id</th>";
                    echo "<th>user_name</th>";
                    echo "<th>user_password</th>";
                    echo "<th>user_role</th>";
                    echo "</tr>";
                    echo "<tr>";
                    while($row = $result->fetch_assoc() ){
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['user_name']."</td>";
                        echo "<td>".$row["user_password"]."</td>";
                        echo "<td>".$row["user_role"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<style>table, th, td {border: 1px solid black;}</style>
                    <style>table {border-collapse: collapse;}</style>
                    <style>th, td {padding: 5px;}</style>
                    <style>th {text-align: left;}</style>
                    <style>table {width: 75%;}</style>
                    <style>th,tr,td {background-color: #f1f1f1;color: black;}</style>
                    ";
                }else{
                    echo "No users found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        ?>
        <span class="span-style">Courses of the system</span>
            <ul>
                <li><a href="add.php">Add courses</a></li>
            </ul>
        <?php
            try{
                $result = $operations->retrieveCourses();
                if($result->num_rows > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>course_id</th>";
                    echo "<th>course_name</th>";
                    echo "<th>course_description</th>";
                    echo "<th>credits</th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "</tr>";
                    echo "<tr>";
                    while($row = $result->fetch_assoc() ){
                        echo "<td>".$row['course_id']."</td>";
                        echo "<td>".$row['course_name']."</td>";
                        echo "<td>".$row["course_description"]."</td>";
                        echo "<td>".$row["course_credits"]."</td>";
                        echo "<td><a href='delete.php?course_id=".$row['course_id']."'>Delete</a></td>";
                        echo "<td><a href='update.php?course_id=".$row['course_id']."'>Update</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "No courses found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        ?>
        <span class="span-style">Students</span>
        <?php
        // retrive students from admin dashboard function for demonstration purposes in admin panel
            try{
                $result = $operations->retrieveStudents();
                if($result->num_rows > 0){
                    echo "<table>";
                    echo "<th>student_id</th>";
                    echo "<th>student_name</th>";
                    echo "<th>student_email</th>";
                    echo "<th>student_password</th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "</tr>";
                    echo "<tr>";
                    while($row = $result->fetch_assoc() ){
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['user_name']."</td>";
                        echo "<td>".$row["user_email"]."</td>";
                        echo "<td>".$row["user_password"]."</td>";
                        echo "<td> <a href='delete_user.php?user_id=".$row['user_id']."'>Delete</a></td>";
                        echo "<td> <a href='enroll.php?user_id=".$row['user_id']."'>Enroll</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "No students found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
            ?>
            <span class='span-style'>Enrolled courses</span>
            <?php
            // display ENROLLED courses with the names of the students
            try{
                $result = $operations->displayEnrolledCourses();
                if($result->num_rows > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>student_name</th>";
                    echo "<th>course_name</th>";
                    echo "<th>course_description</th>";
                    echo "<th>credits</th>";
                    echo "<th>semester</th>";
                    echo "<th>year</th>";
                    echo "<th>grade</th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "</tr>";
                    echo "<tr>";
                    while($row = $result->fetch_assoc() ){
                        echo "<td>".$row["user_name"]."</td>";
                        echo "<td>".$row['course_name']."</td>";
                        echo "<td>".$row["course_description"]."</td>";
                        echo "<td>".$row["course_credits"]."</td>";
                        echo "<td>".$row["enrollment_semester"]."</td>";
                        echo "<td>".$row["enrollment_year"]."</td>";
                        echo "<td>".$row["enrollment_grade"]."</td>";
                        echo "<td><a href='delete_enrollment.php?course_id=".$row['course_id']."&user_id=".$row['user_id']."'>Delete</a></td>";
                        echo "<td><a href='update_enrollment.php?course_id=".$row['course_id']."&user_id=".$row['user_id']."&grade=".$row['enrollment_grade']."&semester=".$row['enrollment_semester']."&year=".$row['enrollment_year']."'>Update</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<style>table, th, td {border: 1px solid black;}</style>
                    <style>table {border-collapse: collapse;}</style>
                    <style>th, td {padding: 5px;}</style>
                    <style>th {text-align: left;}</style>
                    <style>table {width: 75%;}</style>
                    <style>th,tr,td {background-color: #f1f1f1;color: black;}</style>
                    ";
                }else{
                    echo "No courses found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }

        ?>

</body>
</html>