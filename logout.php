<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
    // destroy the session
    session_start();
    session_destroy();
    header("Location: index.html");
    ?>

</body>
</html>