<?php
    include("./includes/db_connection.php");
    include("./includes/functions.php");
    session_start();
   
    $author_id=$success=$documents="";
    //  print_r($_SESSION);
    //     exit();
$total = $id ="";

    if(isset($_POST['btnUpload'])){
        $file_name = $_FILES['documents']['name'];
        $file_size = $_FILES['documents']['size'];
        $file_location = $_FILES['documents']['tmp_name'];
        $file_error = $_FILES['documents']['error'];
        $file_type = $_FILES['documents']['type'];
        $upload_path = "path/";
        $author_id = $_SESSION['logged_in'];


        $test ="SELECT * from `space` WHERE author_id ='$author_id'";
        $testresult = mysqli_query($conn,$test);
        while($row = mysqli_fetch_assoc($testresult)){
            $total = $row['total'];
            $id = $row['id'];
        }

        if($total >= 1000000000){
            exit("space");
        }else{
            $file_extension = explode(".",$file_name);
            $permitted_extension = ['html'];

            if(!in_array(strtolower($file_extension[1]),$permitted_extension)){
                exit("unsupported file type only html files are allowed");
            }else{
                // $size = 8388608 / $file_size;
                $new_file_name = $upload_path.$file_name.".".strtolower($file_extension[1]);
                move_uploaded_file($file_location,$new_file_name);
            }
        

        $sql = "INSERT INTO documents (`name`,`documents`,author_id,size) VALUE('$file_name','$new_file_name','$author_id','$file_size')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            exit("error".mysqli_error($conn));
    }else{
        $v = "select * from space where author_id ='$author_id'";
        $i = mysqli_query($conn,$v);
        $ct = mysqli_num_rows($i);
        if($ct == 0){
            $good = "INSERT into `space`  VALUES(null,$file_size + 0,$author_id) ";
            $goodresult = mysqli_query($conn,$good);
        }else{
            $good = "UPDATE `space` SET total = $total + $file_size WHERE id ='$id'";
            $goodresult = mysqli_query($conn,$good);
    
            // $yep = "delete from space where id='$id'";
            // $yepre = mysqli_query($conn,$yep);
            if(!$goodresult){
                echo 'error'.mysqli_error($conn);
            }else{
                echo 'success';
            }}
        $success = '<div class="alert alert-success" role="alert">
    <strong>upload successfull</strong>
</div>';
    }
    }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>documentss</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?=$success?>
    <div class="pt-3 container-fluid">
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
                <form action="documents.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="documents" required>
                    <button type="submit" class="btn btn-info btn-sm" name="btnUpload">upload</button>
                </form>
                <!-- <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                </form> -->
               
            </div>
        </nav>       
    </div><br>
    <div style="clear:both" class="container-fluid">
        <div class="row">

            <?php
        $author_id = $_SESSION['logged_in'];
        // print_r($_SESSION);
        // exit();
        if(!$author_id){
            header("location:login.php?log");
        }else{

                $sql = "SELECT * FROM documents WHERE author_id = '$author_id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $documents = $row['documents'];
                    $name = $row['name'];
                    $id = $row['id'];

                    echo '<h2 class="col-md-10"><i style="color:red;" class="fa fa-html5"></i> '.$name.'</h2><a class="col-md-1" href ="document.php?open='.$id.'"><i class="fa fa-check">open</i></a><a class="col-md-1" href ="delete.php?doc='.$id.'"><i class="fa fa-trash">delete</i></a>';
                }
            }

 
                ?>
           
           
        </div>
    </div>
    
   
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
    <!-- fa <i class="fa fa-html5" aria-hidden="true"></i> -->
</body>
</html>