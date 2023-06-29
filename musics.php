<?php
    include("includes/db_connection.php");

    session_start();
    if(!$_SESSION){
        header("location:login.php?log");
    }

    $music_id = $_SESSION['music_id'];
    $author = $_SESSION['logged_in'];
    $sql = "SELECT * FROM music WHERE id ='$author'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
              $type = $row['type'];
              $size = $row['size'];
              $id = $row['id'];
              $music = $row['music'];
        
        $_SESSION['file_name'] = $name;
        $_SESSION['file_type'] = $type;
        $_SESSION['file_size'] = $size;
        $_SESSION['file_id'] = $id;
        $_SESSION['file'] = $music;
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
        <a href="music.php"><button  type="button" class="btn btn-dark btn-sm"><h3 >&times;</h3></button></a>
        <a href="delete.php?music=<?=$music_id?>"><button  type="button" class="btn btn-dark btn-sm"><h3 ><i class="fa fa-trash"></i></h3></button></a>
        <a href="share.php?share_music=<?=$music_id?>"><button  type="button" class="btn btn-dark btn-sm"><h4 ><i class="fa fa-share"></i></h4></button></a>

            <?php

                if(isset($_GET['single'])){
                    $id = $_GET['single'];
                    $_SESSION['music_id'] = $id;
                    $sql = "SELECT * FROM music WHERE id ='$id'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $music = $row['music'];

                        echo '<img class="col-md-12 w-100" height="400px" src="image/fol.png" alt="">
            <audio autoplay class="col-md-12 mt-1" controls src="'.$music.'">dfkldfgkgdfgdfgj</audio>';
                    }
                
                }
            ?>
            
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>