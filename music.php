<?php
    include("includes/db_connection.php");
    include("includes/functions.php");
    $success=$searched=$noMatch="";

    session_start();
$total = $id ="";
    
    // print_r($_SESSION);
    // exit();
    if(!$_SESSION){
        header("location:login.php?log");
    }
    if(isset($_POST['btnUpload'])){
        $file_name = $_FILES['music']['name'];
        $file_size = $_FILES['music']['size'];
        $file_type = $_FILES['music']['type'];
        $file_location = $_FILES['music']['tmp_name'];
        $path = "musics/";
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
            $permitted_extension = ['jpg','jpeg','mpk','mp4','gif','png','html','css','php','js','docx'];
            if(in_array($file_extension[1],$permitted_extension)){
                exit("unsupported file type");
            }else{
                // $size = 8388608 / $file_size;

                $new_file_name = $path.$file_name.".".($file_extension[1]);
                move_uploaded_file($file_location,$new_file_name);

            }
            
        $query = "INSERT INTO music (`name`,music,size,author_id,type) VALUES('$file_name','$new_file_name','$file_size','$auth_id','$file_type')";
        $query_result = mysqli_query($conn,$query);
        if(!$query_result){
            exit("error: " .mysqli_error($conn));
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

    

    
        if(isset($_POST['btnSearch'])){
            $auth_id = $_SESSION['logged_in'];
            $input = sanitize_data($_POST['search']);
        $query = "SELECT * FROM music WHERE author_id ='$auth_id' AND name LIKE '%$input%'";
        $query_result = mysqli_query($conn,$query);
        if(mysqli_num_rows($query_result) == 0){
            $noMatch= 'no match found';
        }else{
       
            while($row = mysqli_fetch_assoc($query_result)){
                $searched = $row['name'];
                $id = $row['id'];
                $icon = "fa fa-music";
                $line = "100%";
            }
            }
        
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
    <?=$success?>
    <div class="container-fluid mt-3 fixed">
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
                <form action="music.php" method="post" class="mr-5"  enctype = "multipart/form-data">
                    <input type="file" name="music" id="" required>
                    <button type="submit" name="btnUpload" class="btn btn-info btn-sm">upload</button>
                </form>
                <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <!-- <div class="form-group"> -->
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                    <!-- </div> -->
                </form>
               
            </div>
        </nav>
        
    </div>
    <div class="container-fluid">
        <div class="row ">
            <h4 class="col-md-12 search"><?=$noMatch?><a href="musics.php?single=<?=$id?>" ><i class=" <?= $icon?>"> <?= $searched?></i></a></h4><hr width="<?=$line?>">
            <?php
                $auth_id = $_SESSION['logged_in'];
                $sql ="SELECT * FROM music WHERE author_id ='$auth_id'";
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $music = $row['music'];
                    $name = $row['name'];
                    $id = $row['id'];

                    echo '         <a href="musics.php?single='.$id.'" class="col-md-12"><h4 ><i class="fa fa-music"> '.$name.'</i></h4></a>';
                }

            ?>

        </div>
    </div>
   
    
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>