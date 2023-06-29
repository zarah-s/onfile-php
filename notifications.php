<?php
    include("includes/db_connection.php");
    include("includes/functions.php");
    session_start();
    $auth_id = $_SESSION['logged_in'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>notifications</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <a href="index.php"><h3>home</h3></a>
            <?php
                $sql = "SELECT * FROM notification WHERE `to` ='$auth_id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $about = $row['about'];
                    $from = $row['from'];
                    $id = $row['id'];

                    $query = "SELECT * FROM users WHERE id ='9'";
                    $results = mysqli_query($conn,$query);
                    while($fetch = mysqli_fetch_assoc($results)){
                        $from_userName = $fetch['userName'];
                    }

                    echo '<div class="jumbotron w-100">
                    <h1 class="display-3">'.$from_userName.' '.$about.'</h1>
                    <hr class="my-2">
                    <p class="lead">
                        <a class="btn btn-success btn-lg" href="notification_option.php?accept='.$id.'" role="button">Accept</a>
                        <a class="btn btn-danger btn-lg" href="notification_option.php?decline='.$id.'" role="button">Decline</a>
                        <a class="btn btn-primary btn-lg" href="notification_option.php?view='.$id.'" role="button">View</a>
                    </p>
                </div>';

                }

            ?>
    
            
        </div>
    </div>
</body>
</html>