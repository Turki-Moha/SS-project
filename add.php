<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-design">
        <form action="POST">
            <div class="form-grid">
                <label for="course_name">Course name:</label>
                <input type="text" id="course_name" name="course_name" required><br>
            </div>
            <div class="form-grid">
                <label for="course_description">Course description:</label>
                <input type="text" id="course_description" name="course_description" required><br>
            </div>
            <div class="form-grid">
                <label for="credits">Credits:</label>
                <input type="number" id="credits" name="credits" required><br>
            </div>
            <div class="form-grid">
            <input class="Button" type="submit" value="add" name="add"></button>
            </div>
        </form>
    </div>
    <?php
        include_once 'operations.php';
        $operations = new Operations();
        $operations->dbConnect();
        if(isset($_POST['submit'])){
            $course_name = $_POST['course_name'];
            $course_description = $_POST['course_description'];
            $credits = $_POST['credits'];
            try{
                if($operations->addCourse($course_name, $course_description, $credits)){
                    echo "Course added successfully";
                    header("Location: admin.php");
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    ?>

</body>
</html>