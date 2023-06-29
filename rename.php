<?php

    include("./includes/db_connection.php");
    include("./includes/functions.php");
    session_start();
    if(isset($_GET['rename'])){
        $id = $_GET['rename'];
        
        $sql = "SELECT * FROM others WHERE id = '$id'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['folder'];
            $fol_id = $row['id'];
            $_SESSION['fol_id'] = $fol_id;
        }
    }

    if(isset($_POST['btnRename'])){
        $id  = $_SESSION['fol_id'];
        // print_r($_SESSION);
        // exit();
        $new_name = $_POST['newName'];
        $sql = "UPDATE others SET folder ='$new_name' WHERE id ='$id'";
        $result= mysqli_query($conn,$sql);
        if(!$result){
            exit("error".mysqli_error($conn));
        }else{
            header("location:others.php");
        }
    }
         
    if(isset($_POST['cancel'])){
        header("location:others.php");
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
    <div class="container mt-5">
        <div class="row">
            <form action="rename.php" method="post">
                <input type="text" class="form-control" name="newName" value="<?=$name?>">
                <button type="submit" class="btn btn-success btn-sm mt-1" name="btnRename">rename</button>
                <button type="submit" class="btn btn-danger btn-sm mt-1 ml-4" name="cancel">cancel</button>
            </form>
        </div>
    </div>

    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.js"></script>
</body>
</html>
