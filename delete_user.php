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

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        try{
            $result = $operations->deleteUser($user_id);
            if($result){
                echo "User deleted successfully";
                header("Location: admin.php");
            }else{
                echo "User deletion failed";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    

    ?>
</body>
</html>