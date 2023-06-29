<?php
    include("includes/db_connection.php");
    session_start();
    
    $video_id = $_SESSION['video_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="row">
        <a href="movies.php"><button  type="button" class="btn btn-dark btn-sm"><h3 >&times;</h3></button></a>
        <a href="delete.php?video=<?=$video_id?>"><button  type="button" class="btn btn-dark btn-sm"><h3><i class="fa fa-trash"></i></h3></button></a>
        <a href="share.php?share_video=<?=$video_id?>"><button  type="button" class="btn btn-dark btn-sm"><h4 ><i class="fa fa-share"></i></h4></button></a>

        <?php

            if(isset($_GET['video'])){
                $id = $_GET['video'];
                $_SESSION['video_id'] = $id;
                $sql = "SELECT * FROM videos WHERE id ='$id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $video = $row['video'];
                    $id = $row['id'];

                    echo '<video src="'.$video.'" class="col-md-12" controls autoplay></video>';
                }
            }

        ?>
        </div>
    </div>
</body>
</html>