<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <span class="span-style">Users of the system</span>
    <?php
            include_once 'operations.php';
            $operations = new Operations();
            $operations->dbConnect();
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
                    <style>table {width: 80%;}</style>
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
</body>
</html>