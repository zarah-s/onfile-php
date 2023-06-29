<?php
    include("./includes/db_connection.php");
    include("./includes/functions.php");
    // include("./logout.php");

    session_start();
    $auth_id = $_SESSION['logged_in'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>receive</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">vicki</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-5">
                    <li class="nav-item active ml-5">
                        <a class="nav-link text-danger" href="index.php"><h3 title="home"><i class="fa fa-home"></i></h3> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="nav-link text-danger" href="movies.php"><h3 title="film"><i class="fa fa-film"></i></h3></a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="nav-link text-danger" href="music.php"><h3 title="musics"><i class="fa fa-music"></i></h3></a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="nav-link text-danger" href="image.php"><h3 title="images"><i class="fa fa-image"></i></h3></a>
                    </li>
                    <li class="nav-item ml-5">
                        <a class="nav-link text-danger" href="receive.php"><h3 title="received"><i class="fa fa-download"></i></h3></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="others.php"><h3 title="others"><i class="fa fa-folder-open-o"></i></h3></a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li> -->
                </ul>
                <!-- <form action="movies.php" method="post" class="mr-5"  enctype = "multipart/form-data">
                    <input type="file" name="movie" id="" required>
                    <button type="submit" name="btnUpload" class="btn btn-info btn-sm">upload</button>
                </form> -->
                <!-- <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                </form> -->
               
            </div>
        </nav>
        <div class="row">

             <?php


        $sql = "SELECT * from `receive` WHERE `to` ='$auth_id'";
        $result = mysqli_query($conn,$sql);
       
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['file_name'];
            $type = $row['file_type'];
            $id = $row['id'];
            
           
        if($type == "image/jpeg"){
            $icon ="fa fa-image";
        }elseif($type == "audio/mpeg"){
            $icon = "fa fa-music";
        }else{
            $icon ="fa fa-film";
        }

        echo '<h3 class = "col-md-10 ml-2 mt-3"><a href="file_dp.php?received_file='.$id.'"><i class = "'.$icon.'"> '.$name.'</i></a></h3>';

        }
    ?>
    
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>