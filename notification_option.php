<?php
    include("includes/db_connection.php");
    include("includes/functions.php");
    session_start();

    if(isset($_GET['accept'])){
        $id = $_GET['accept'];

        $sql = "DELETE FROM notification WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            exit("problem".mysqli_error($conn));
        }else{
            header("location:receive.php");
        }
    }

    if(isset($_GET['decline'])){
        $id = $_GET['decline'];
        $query = "SELECT * FROM notification WHERE id ='$id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $fileName = $row['file_name'];
        }
        if(!$results){
            exit("error".mysqli_error($conn));
        }else{
        $sql = "DELETE FROM notification WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            exit("problem".mysqli_error($conn));
        }else{
            $querie = "DELETE FROM receive WHERE `file_name` = '$fileName'";
            $output = mysqli_query($conn,$querie);
            if(!$output){
                exit("error".mysqli_error($conn));
            }else{
                header("location:index.php");
            }
        }
    }}

?>