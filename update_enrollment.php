<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update enrollment</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php

    include_once 'operations.php';
    $operations = new Operations();
    $operations->dbConnect();

    // retrive details of the course to be updated
    if(isset($_GET['course_id'])&&isset($_GET['user_id'])&&isset($_GET['grade'])&&isset($_GET['year'])&&isset($_GET['semester'])){
        $course_id = $_GET['course_id'];
        $user_id = $_GET['user_id'];
        $grade = $_GET['grade'];
        $year = $_GET['year'];
        $semester = $_GET['semester'];

        try{
            
            $result = $operations->retrieveEnrollment($user_id, $course_id);
            if($result->num_rows > 0){
                echo "<form action='update_enrollment.php' method='post'>";
                // fetch courses from database and display them in a dropdown list
                echo "<label for='course_id'>course name</label>";
                $result = $operations->retrieveCourses();
                if($result->num_rows > 0){
                    echo "<select name='course_id'
                    id='course_id'>";
                    while($row = $result->fetch_assoc() ){
                        echo "<option value=".$row['course_id'].">".$row['course_name']."</option>";
                    }
                    echo "</select>";
                }
                // instert semester 
                echo "<label for='semester'>semester</label>";
                echo "<select  name='semester' id='semester'>";
                echo "<option value='first'>first</option>";
                echo "<option value='second'>second</option>";
                echo "</select>";
                // insert only year with the beginning of the semester
                echo "<label for='year'>year</label>";
                echo "<select id='year' name='year'>";
                $current_year = date("Y");
                $start_year = 2000;
                $end_year = $current_year + 7;
                for($i=$start_year;$i<=$end_year;$i++){
                    echo "<option value=".$i.">".$i."</option>";
                }
                echo "</select>";
                // insert grade
                echo "<label for='grade'>grade</label>";
                echo "<select id='grade' name='grade'>";
                echo "<option value='A'>A</option>";
                echo "<option value='B'>B</option>";
                echo "<option value='C'>C</option>";

                // insert user_id and course_id as hidden inputs
                echo "<input type='hidden' name='user_id' value=".$user_id.">";
                echo "<input type='hidden' name='course_id' value=".$course_id.">";
                echo "<input type='submit' name='update' value='Update'>";
                echo "</form>";
            }else{
                echo "No enrollment found";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // update enrollment
    if(isset($_POST['update'])){
        $user_id = $_POST['user_id'];
        $course_id = $_POST['course_id'];
        $semester = $_POST['semester'];
        $year = $_POST['year'];
        $grade = $_POST['grade'];
        try{
            $result = $operations->updateEnrollment($user_id, $course_id, $semester, $year, $grade);
            if($result){
                echo "Enrollment updated successfully";
                header("Location: admin.php");
            }else{
                echo "Enrollment not updated";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    ?>
</body>
</html>