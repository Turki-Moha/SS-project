<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
        include_once 'operations.php';
        $operations = new Operations();
        $operations->dbConnect();

        if(isset($_GET['course_id'])){
            $course_id = $_GET['course_id'];
            try{
                $result = $operations->retrieveCourse($course_id);
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $course_name = $row['course_name'];
                    $course_description = $row['course_description'];
                    $credits = $row['course_credits'];
                }else{
                    echo "Course not found";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        if(isset($_POST['update'])){
            $course_id = $_POST['course_id'];
            $course_name = $_POST['course_name'];
            $course_description = $_POST['course_description'];
            $credits = $_POST['credits'];
            try{
                $result = $operations->updateCourse($course_id, $course_name, $course_description, $credits);
                if($result){
                    echo "Course updated successfully";
                }else{
                    echo "Course update failed";
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        


    ?>
</body>
</html>