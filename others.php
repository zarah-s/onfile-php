<?php
    include("includes/db_connection.php");
    include("includes/functions.php");
    session_start();


    if(!$_SESSION){
        header("location:login.php?log");
    }else{
        $auth_id = $_SESSION['logged_in'];
    }
    if(isset($_POST['btnCreate'])){
        $folder_name = sanitize_data($_POST['folderName']);

        $sql = "INSERT INTO others (folder,author_id) VALUES('$folder_name','$auth_id')";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            exit("error " .mysqli_error($conn));
        }else{
            echo 'success';
        }
    }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>others</title>
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
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li> -->
                    
                </ul>
                <button type="button" class="btn btn-primary btn-sm mr-5 " data-toggle="modal" data-target="#modelId">
                    create folder
                </button>
                <form action="image.php" method="post" class="mr-5"  enctype = "multipart/form-data">
                    <input type="file" name="image" id="" required>
                    <button type="submit" name="btnUpload" class="btn btn-info btn-sm">upload</button>
                </form>
                <!-- <form action="music.php" style="float:right"  class="form-inline my-2 my-lg-0" method="post">
                    <input type="search" class="form form-control mr-sm-2"   name="search" id="" aria-describedby="helpId" placeholder=" search"  style="border-radius:10px" required>
                    <button type="submit" name="btnSearch"  class="btn btn-outline-success my-2 my-sm-0">search</button>
                </form> -->
               
            </div>
        </nav>
        <div class="row mt-3">
        <!-- Button trigger modal -->
     
        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-folder-open-o">folder</i></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="others.php" method="post">
                            <div class="form-group">
                              <input type="text" class="form-control" name="folderName" id="" placeholder="name" required autofocus>
                            </div>
                      
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" name="btnCreate" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php

                    
            $sql = "SELECT * FROM others WHERE author_id ='$auth_id'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $folder = $row['folder'];
                $id = $row['id'];
                $icon = "fa fa-folder-open-o";

                $_SESSION['folder_id'] = $id;
                
                

                echo '<p class = "col-md-12"></p><p class = "col-md-12"></p><p class = "col-md-12"></p><h3 class = "col-md-6 ml-3"><a href="files.php?files='.$id.'"><i class ="'.$icon.'" > '.$folder.'</i></a></h3><h4 class = "col-md-2"><a href="rename.php?rename='.$id.'"><i class="fa fa-pencil"> rename</i></a></h4><h4 class = "col-md-2"><a href="delete.php?folder='.$id.'"><i class="fa fa-trash"> delete</i></a></h4>
';
            }
        ?>

    
        <!-- <input type="text"required autofocus> -->
            <!-- <a class="col-md-8 mt-3" href="others.php"><strong>create folder</strong> </a> --><p class = "col-md-12"></p><p class = "col-md-12"></p><p class = "col-md-12"></p><h3 class = "col-md-6 ml-3"><a href="documents.php"><i class ="fa fa-folder-open-o" > HTML</i></a></h3>
        </div>
    </div>
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.js"></script>
</body>
</html>