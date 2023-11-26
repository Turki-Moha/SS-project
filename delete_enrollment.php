<?php

include_once 'operations.php';
$operations = new Operations();
$operations->dbConnect();

if(isset($_GET['course_id'])&&isset($_GET['user_id'])){
    $course_id = $_GET['course_id'];
    $user_id = $_GET['user_id'];
    try{
        $result = $operations->deleteEnrollment($user_id, $course_id);
        if($result){
            echo "Course deleted successfully";
            header("Location: admin.php");
        }else{
            echo "Course deletion failed";
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
?>
