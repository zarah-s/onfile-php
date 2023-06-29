<?php

    include("includes/db_connection.php");
    session_start();
    $auth_id = $_SESSION['logged_in'];

    // print_r($_SESSION);
    // exit();

    if(!$_SESSION){
        header("location:login.php?log");
    }

    $img_id = $_SESSION['img_id'];

   
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">

           
            <a href="image.php"><button  type="button" class="btn btn-dark btn-sm"><h3 >&times;</h3></button></a>
            <a href="delete.php?img=<?=$img_id?>"><button  type="button" class="btn btn-dark btn-sm"><h3><i class="fa fa-trash"></i></h3></button></a>
            <a href="share.php?share_image=<?=$img_id?>"><button  type="button" class="btn btn-dark btn-sm"><h4 ><i class="fa fa-share"></i></h4></button></a>

            <?php
                if(isset($_GET['single'])){
                    $id = $_GET['single'];
                    

                    $sql = "SELECT * FROM image WHERE id ='$id'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $image = $row['image'];
                        $id = $row['id'];
                        $_SESSION['img_id'] = $id;


                        echo '            <img src="'.$image.'" class="col-md-12 mt-" style="width:100%;height:500px" alt="">
';
                    }
                }

            ?>
            <?php

                $sql = "SELECT * FROM image WHERE author_id='$auth_id'";
                $result = mysqli_query($conn,$sql);
                while ($row=mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];
                

                    echo '            <a href="single.php?single='.$id.'" class="col-md-3 mt-2"><img src="'.$image.'" width="100%" height="150px" alt=""></a>
                ';
                }


                ?>
                        
               
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>