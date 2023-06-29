<?php
$total="";
include("./includes/db_connection.php");
include("./includes/functions.php");
        session_start();
        $author_id = $_SESSION['logged_in'];
        $user = $_SESSION['user_identity'];


        if(!$author_id){
            header("location:login.php?log");
        }else{
            $success='<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <h2 aria-hidden="true">&times;</h2>
                <span class="sr-only">Close</span>
            </button>
            <strong>login successful</strong>
        </div>';
        }
        $success="";
        if(isset($_GET['login']) == "successful"){
            $success='<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <h2 aria-hidden="true">&times;</h2>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>login successful</strong>
                </div>';
        }
$counter="";
        $sql = "SELECT * FROM notification WHERE `to` ='$author_id'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count == 0){
            $counter;
            $class ="";
        }else{
            $counter = $count;
            $class = "notification";
        }
            // print_r($_SESSION);
            // exit();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file manager</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?=$success?>



    <div class="container-fluid p-5">
        
        <div class="row">
            <div class="i col-md-6"></div>
            <div class="c ml-5">
                <a href="logout.php" style="float:right" class="btn btn-danger btn-sm mt-3 ml-5"> <h5><i class="fa fa-sign-out">sign out</i></h5></a>
                <a href="#" style="float:right" class="btn btn-light btn-sm mt-3 mr-5"> <h4><i class="fa fa-user"></i><?=$user?></h4></a>
                <a href="notifications.php" style="float:right" class="btn btn-light btn-sm mt-3 mr-5 "><h3> <i class="fa fa-bell-o"></i><sup class="<?=$class?>"><?=$counter?></sup></h3></a>
 
            </div><br><br><br><br>
           
            <a href="music.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-music i"></i><span >musics</span></h1></a>
            <a href="movies.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-film i"></i><span class="responsive">movies</span></h1></a>
            <a href="image.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-image i"></i><span class="responsive">images</span></h1></a>
            <a href="others.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-folder-open-o i"></i><span class="responsive">others</span></h1></a>
            <a href="receive.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-download i"></i><span class="responsive">received</span></h1></a>
            <a href="downloads.php" class="folders col-md-6 w-100"><h1 class="bg-danger "><i class="fa fa-download i"></i><span class="responsive">downloads</span></h1></a>
                
            
            <div class="folders col-md-12 w-100"></div>
            <?php
                $sql =  "SELECT * FROM `space` WHERE author_id = '$author_id'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) == 0){
                    $total = 0;
                }else{
                while($row = mysqli_fetch_assoc($result)){
                    $total = $row['total'];
                }}
                // $progress = $total / 100 * 100 .'%';
                $progres = 'width:' . $total / 1717986918 * 100 .'%';
                $progress =  $total / 1717986918 * 100 .'%';
                // echo $progress;
                echo '<div class="progress w-50">
              
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="'.$progres.'" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">space: '.$progress.'</div>
            </div>';
            ?>
            
        </div>
    </div>
       







    <!-- <div class="container ">
        <div class="row">
            <div class="folders col-md-4">
                <a href="image.php" title="size: 2kb  type: folder;"><h1 class= "mt-5"><i class="fa fa-folder-open-o"></i> images </h1></a>
                <a href="videos.php" title="size: 2kb  type: folder;"><h1 class= "mt-5"><i class="fa fa-folder-open-o"></i> videos </h1></a>
                <a href="music.php" title="size: 2kb  type: folder;"><h1 class= "mt-5"><i class="fa fa-folder-open-o"></i> music </h1></a>
                <a href="documents.php" title="size: 2kb  type: folder;"><h1 class= "mt-5"><i class="fa fa-folder-open-o"></i> documents </h1></a>
            </div>
             <div class="empty col-md-5"></div> 
            <div class="about col-md-8 text-light  mt-5">
                <h1 class="abtContent ">about</h1>
                <p id="para">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis eligendi sunt, dolores inventore, natus quasi minima ducimus pariatur quisquam incidunt suscipit eveniet odio? Eaque officiis nesciunt repellendus recusandae in reprehenderit.l</p>
            
            </div>
        </div>
    </div>
     -->
</body>
</html>