<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete course</title>
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
            $result = $operations->deleteCourse($course_id);
            if($result){
                echo "Course deleted successfully";
            }else{
                echo "Course deletion failed";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    ?>
</body>
</html>