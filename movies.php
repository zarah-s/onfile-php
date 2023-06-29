<?php
    include("includes/db_connection.php");
    $success="";
    $total = $id ="";

    session_start();
    if(!$_SESSION){
        header("location:login.php");
    }
    if(isset($_POST['btnUpload'])){
        $file_name = $_FILES['movie']['name'];
        $file_size = $_FILES['movie']['size'];
        $file_type = $_FILES['movie']['type'];
        $file_location = $_FILES['movie']['tmp_name'];
        $path = "movies/";
        $auth_id = $_SESSION['logged_in'];

        // print_r($_FILES);
        // exit();

        $test ="SELECT * from `space` WHERE author_id ='$auth_id'";
        $testresult = mysqli_query($conn,$test);
        while($row = mysqli_fetch_assoc($testresult)){
            $total = $row['total'];
            $id = $row['id'];
        }

        if($total >= 1000000000){
            exit("space");
        }else{
            
            $file_extension = explode(".",$file_name);
            $permitted_extension = ['jpg','jpeg','mp3','gif','png','html','css','php','js','docx'];
            if(in_array($file_extension[1],$permitted_extension)){
                exit("unsupported file type");
            }else{
                // $size = 8388608 / $file_size;

                $new_file_name = $path.$file_name.".".($file_extension[1]);
                move_uploaded_file($file_location,$new_file_name);

            }
            
        $query = "INSERT INTO videos (`name`,video,size,author_id,`type`) VALUES('$file_name','$new_file_name','$file_size','$auth_id','$file_type')";
        $query_result = mysqli_query($conn,$query);
        if(!$query_result){
            exit("errorhhkjk: " .mysqli_error($conn));
        }else{
            $v = "select * from space where author_id ='$auth_id'";
            $i = mysqli_query($conn,$v);
            $ct = mysqli_num_rows($i);
            if($ct == 0){
                $good = "INSERT into `space`  VALUES(null,$file_size + 0,$auth_id) ";
                $goodresult = mysqli_query($conn,$good);
            }
            else{
                $good = "UPDATE `space` SET total = $total + $file_size WHERE id ='$id'";
                $goodresult = mysqli_query($conn,$good);
        
                // $yep = "delete from space where id='$id'";
                // $yepre = mysqli_query($conn,$yep);
                if(!$goodresult){
                    echo 'error'.mysqli_error($conn);
                }else{
                    echo 'success';
                }}
            $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <h3 aria-hidden="true">&times;</h3>
        <span class="sr-only">Close</span>
    </button>
    <strong>upload successful</strong>
</div>
';
        }
    }}




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
<body>
    <?=$success?>
    <div class="container-fluid mt-3">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">vicki</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
                    <li class="nav-item active ">
                        <a class="nav-link text-danger" href="index.php"><h3 title="home"><i class="fa fa-home"></i></h3> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="movies.php"><h3 title="film"><i class="fa fa-film"></i></h3></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="music.php"><h3 title="musics"><i class="fa fa-music"></i></h3></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="image.php"><h3 title="images"><i class="fa fa-image"></i></h3></a>
                    </li>
                    <li class="nav-item">
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
                <form action="movies.php" method="post" class="mr-5"  enctype = "multipart/form-data">
                    <input type="file" name="movie" id="" required>
                    <button type="submit" name="btnUpload" class="btn btn-info btn-sm">upload</button>
                </form>
                <!-- <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                </form> -->
               
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row mt-5">
            <?php
                $auth_id = $_SESSION['logged_in'];
                $sql ="SELECT * FROM videos WHERE author_id ='$auth_id'";
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $video = $row['video'];
                    $name = $row['name'];
                    $id = $row['id'];

                    echo '<a href ="single_movie.php?video='.$id.'" class="col-md-3"><video width="100%" height="200px" controls src="'.$video.'"></video></a>
';
                }
                
            ?>
            <!-- <video class="col-md-3 mt-2" controls src="movie/Birdman_-_Y.U._MAD_ft._Nicki_Minaj,_Lil_Wayne(360p).mp4"></video>
            <video class="col-md-3 mt-2" controls src="movie/Birdman_-_Y.U._MAD_ft._Nicki_Minaj,_Lil_Wayne(360p).mp4"></video>
            <video class="col-md-3 mt-2" controls src="movie/Birdman_-_Y.U._MAD_ft._Nicki_Minaj,_Lil_Wayne(360p).mp4"></video>
            <video class="col-md-3 mt-2" controls src="movie/Birdman_-_Y.U._MAD_ft._Nicki_Minaj,_Lil_Wayne(360p).mp4"></video> -->
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>