<?php
      include("includes/db_connection.php");
      include("includes/functions.php");
      session_start();
  
      if(!$_SESSION){
          header("location:login.php?log");
      }

   
// $file_id = $_SESSION['file_id'];


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
        
            <?php
                if(isset($_GET['file'])){
$folder_id = $_SESSION['folder_id'];

                    $id = $_GET['file'];

                    echo '<a href="files.php?files='.$folder_id.'"  class="ml-2 mt-3  btn btn-dark btn-sm"><h4>&times;</h4></a>
                    <a href="delete.php?files='.$id.'"  class="ml-5 mt-3 btn-sm"><h4 style="color:white;margin-left:70%;"><i class="fa fa-trash"></i></h4></a>';

                    // $_SESSION['file_id'] = $id;
                    $sql = "SELECT * FROM otherfiles WHERE id ='$id'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $file = $row['file'];
                        $file_type = $row['file_type'];

                        if($file_type == "audio/mpeg"){
                            echo '<audio class="col-md-12" controls autoplay src="'.$file.'"></audio>';
                        }elseif($file_type == "video/mp4"){
                            echo '<video class="col-md-12 "  controls autoplay src="'.$file.'"></video>';
                        }elseif($file_type == "image/jpeg"){
                            echo '<img class="col-md-12 mt-3" height="550px" src="'.$file.'" alt="">';
                        }
                    }

                }

                //RECEIVED_FILE_DISPLAY

                if(isset($_GET['received_file'])){
                    $id = $_GET['received_file'];

                    echo '<a href="receive.php"  class="ml-2 mt-3  btn btn-dark btn-sm"><h4>&times;</h4></a>
                    <a href="delete.php?received_files='.$id.'"  class="ml-5 mt-3 btn-sm"><h4 style="color:white;margin-left:70%;"><i class="fa fa-trash"></i></h4></a>';

                    // $_SESSION['file_id'] = $id;
                    $sql = "SELECT * FROM `receive` WHERE id ='$id'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $file = $row['file'];
                        $file_type = $row['file_type'];

                        if($file_type == "audio/mpeg"){
                            echo '<audio class="col-md-12" controls autoplay src="'.$file.'"></audio>';
                        }elseif($file_type == "video/mp4"){
                            echo '<video class="col-md-12 "  controls autoplay src="'.$file.'"></video>';
                        }elseif($file_type == "image/jpeg"){
                            echo '<img class="col-md-12 mt-3" height="550px" src="'.$file.'" alt="">';
                        }
                    }

                }
            ?>
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.js"></script>
</body>
</html>