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
            require 'operations.php';
            $operations = new Operations();
            $operations->dbConnect();
            session_start();
            if(isset($_SESSION['user_id'])){
                echo "<li><a href='logout.php'>Logout</a></li>";
                if($_SESSION['user_role'] == 'admin'){
                    $result  = $operations->retrieveUsers();
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "  <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>password</th>
                                <th>role</th>
                                </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['user_name'] . "</td>";
                            echo "<td>" . $row['user_email'] . "</td>";
                            echo "<td>" . $row['user_password'] . "</td>";
                            echo "<td>" . $row['user_role'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No users found.";
                    }
                }
            } else {
                echo "";
            }
        ?>

    </ul>
</body>
</html>