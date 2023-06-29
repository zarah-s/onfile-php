<?php

    include("includes/db_connection.php");
    include("includes/functions.php");
    session_start();

$id=$icon="";
    if(!$_SESSION){
        header("location:login.php?log");
    }
$total = $id ="";
   
      
if(isset($_POST['btnUpload'])){
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_location = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];
    $path ="files/";
    $auth_id = $_SESSION['logged_in'];
    $folder_id = $_SESSION['folder_id'];
  
// echo $folder_id;
// exit();
//    print_r($_SESSION);
//    exit();
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
    $permitted_extension=[''];
    if(in_array(strtolower($file_extension[1]),$permitted_extension)){
        exit("unsupported file type");
    }else{
        // $size = 8388608 / $file_size;

        $new_file_name = $path.$file_name.".".strtolower($file_extension[1]);
        move_uploaded_file($file_location,$new_file_name);
        // $id = $_SESSION['folder_id'];
    }
        $sql = "INSERT INTO otherfiles (`file`,`file_name`,author_id,file_size,folder_id,file_type) VALUES('$new_file_name','$file_name','$auth_id','$file_size','$folder_id','$file_type')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            exit("error" .mysqli_error($conn));
        }else{
            $sel = "SELECT * FROM otherfiles_space WHERE author_id ='$auth_id'";
            $sel_result = mysqli_query($conn,$sel);
             
                $good = "INSERT into `otherfile_space`  VALUES(null,$file_size + 0,$auth_id) ";
                $goodresult = mysqli_query($conn,$good);
                if()
            
            else{
                $good = "UPDATE `space` SET total = $total + $file_size WHERE id ='$id'";
                $goodresult = mysqli_query($conn,$good);
        
                // $yep = "delete from space where id='$id'";
                // $yepre = mysqli_query($conn,$yep);
                if(!$goodresult){
                    echo 'error'.mysqli_error($conn);
                }else{
                    echo 'success';
                // $send = $_POST['send'];
                $sql = "SELECT * from otherfiles_size WHERE author_id = '$auth_id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $total = $row['size'];
                    $id = $row['id'];

                }
                $sam = "select * from otherfiles_size where author_id ='$auth_id'";
                $samuel = mysqli_query($conn,$sam);
                $vict = mysqli_num_rows($samuel);
                if($vict == 0){
                    $yea = "INSERT into `space`  VALUES(null,$file_size + 0,$auth_id) ";
                    $yearesult = mysqli_query($conn,$yea);
                }else{
                $query = "INSERT into `otherfiles_size` (total) VALUES($file_size + $total)";
                $results = mysqli_query($conn,$query);

                $yep = "delete from space where id='$id'";
                $good = mysqli_query($conn,$yep);
                if(!$good){
                    echo 'error';
                }else{
                    echo 'success';
                }

             header("location:files.php?files=$folder_id");
            }
            // echo 'success';
       
    }

    
}}
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
    <link rel="stylesheet" href="css/style.css">
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
                    <li class="nav-item ml-5">
                        <a class="nav-link text-danger" href="others.php"><h3 title="back"><i class="fa fa-previous">back</i></h3></a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li> -->
                </ul>
                <form action="files.php" method="post" class="ml-4" enctype="multipart/form-data">
                    <input type="file" name="file" id="" required>
                    <button type="submit" name="btnUpload" class="btn btn-info btn-sm">upload</button>
                </form>
                <!-- <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                </form> -->
               
            </div>
        </nav> 
        <div class="row mt-3 ml-">
           
            <!-- <a href="others.php" class="col-md-8 ml-5"><h4>back</h4></a> -->
            <!-- <br><br><br> -->
            <?php

if(isset($_GET['files'])){
    $id = $_GET['files'];

    $_SESSION['folder_id'] = $id;

    $sql = "SELECT * FROM otherfiles WHERE folder_id ='$id'";
    $result = mysqli_query($conn,$sql);
    
    while($row = mysqli_fetch_assoc($result)){
        $file = $row['file'];
        $id = $row['id'];
        $name = $row['file_name'];
        $type = $row['file_type'];

        if($type == "image/jpeg"){
            $icon ="fa fa-image";
        }elseif($type == "audio/mpeg"){
            $icon = "fa fa-music";
        }else{
            $icon ="fa fa-film";
        }

        echo '<h3 class = "col-md-12 ml-2"><a href="file_dp.php?file='.$id.'"><i class = "'.$icon.'"> '.$name.'</i></a></h3>';
        
    }
}

            ?>
            
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.js"></script>
</body>
</html>