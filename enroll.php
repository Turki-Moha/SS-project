<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include_once 'operations.php';
        $operations = new Operations();
        $operations->dbConnect();
        session_start();
        // check credintials
        if(isset($_SESSION['user_id'])){
            if($_SESSION['user_role'] == 'admin'){
                echo "<form action='enroll.php' method='post'>";
                // fetch user id
                echo "<label for='user_id'>User name</label>";
                $result = $operations->retrieveUsers();
                    if($result->num_rows > 0){
                        echo "<select name
                        ='user_id' id='user_id'>";
                        while($row = $result->fetch_assoc() ){
                            echo "<option value=".$row['user_id'].">".$row['user_name']."</option>";
                        }
                        echo "</select>";
                    }

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
                    
                    echo "<label for='grade'>grade</label>";
                    // insert grade in a dropdown list
                    echo "<select name='grade' id='grade'>";
                    echo "<option value='A'>A</option>";
                    echo "<option value='B'>B</option>";
                    echo "<option value='C'>C</option>";
                    echo "<option value='D'>D</option>";
                    echo "</select>";
                
                echo "<input type='submit' value='Enroll'>";
                echo "</form>";
                if(isset($_POST['user_id']) && isset($_POST['course_id']) && isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['grade'])){
                    // check if the user is already enrolled in the course
                    $user_id = $_POST['user_id'];
                    $course_id = $_POST['course_id'];
                    $semester = $_POST['semester'];
                    $year = $_POST['year'];
                    $grade = $_POST['grade'];
                    try{
                        $result = $operations->checkEnrollment($user_id, $course_id);
                        if($result->num_rows > 0){
                            echo "The user is already enrolled in the course";
                        }else{
                            $result = $operations->enroll($user_id, $course_id, $semester, $year, $grade);
                            if($result){
                                echo "Enrollment successful";
                                header("Location: admin.php");
                            }else{
                                echo "Enrollment failed";
                            }
                        }
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                }
            }else{
                echo "<ul>";
                echo "<li><a href='main.php'>Main page</a></li>";
                echo "<li><a href='logout.php'>Log out</a></li>";
                echo "</ul>";
                echo "<span class='span-style'>Enroll students</span>";
                echo "<form action='enroll.php' method='post'>";
                echo "<label for='user_id'>User id</label>";
                echo "<input type='text' name='user_id' id='user_id'>";
                echo "<label for='course_id'>Course id</label>";
                echo "<input type='text' name='course_id' id='course_id'>";
                echo "<input type='submit' value='Enroll'>";
                echo "</form>";
                if(isset($_POST['user_id']) && isset($_POST['course_id'])){
                    $user_id = $_POST['user_id'];
                    $course_id = $_POST['course_id'];                
                }
            }
        }else{
            echo "<ul>";
            echo "<li><a href='index.html'>Home</a></li>";
            echo "<li><a href='login.php'>Login</a></li>";

            echo "</ul>";
            echo "<span class='span-style'>Enroll students</span>";
            echo "<form action='enroll.php' method='post'>";
            echo "<label for='user_id'>User id</label>";
            echo "<input type='text' name='user_id' id='user_id'>";
            echo "<label for='course_id'>Course id</label>";
            echo "<input type='text' name='course_id' id='course_id'>";
            echo "<input type='submit' value='Enroll'>";
            echo "</form>";
            if(isset($_POST['user_id']) && isset($_POST['course_id'])){
                $user_id = $_POST['user_id'];
                $course_id = $_POST['course_id'];
                            
            }
        }
    ?>
</body>
</html>