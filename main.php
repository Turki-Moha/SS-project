<?php

require 'db.php';

// select all user data and place it in a table with edit and delete options.


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <li><a href="index.html">Home</a></li>
        <?php 
            if(isset($_SESSION['user_id'])){

                echo '<li><a href="logout.php">Logout</a></li>';
            }
        ?>
    </ul>
</body>
</html>