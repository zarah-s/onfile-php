<?php
    include("includes/db_connection.php");
    include("includes/functions.php");
    session_start();
    $author_id="";
    
    if(isset($_GET['open'])){
        $id = $_GET['open'];
        $author_id = $_SESSION['logged_in'];
        // print_r($_SESSION);
        // exit();
        if(!$author_id){
            header("location:login.php?log");
        }else{
   echo '                 <a href="documents.php"><button  type="button" class="btn btn-dark btn-sm fixed-t">    <h3 style="float:right">&times;</h3></button></a>

';
                $sql = "SELECT * FROM documents WHERE author_id = '$author_id' AND id ='$id'";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $documents = $row['documents'];
                    $name = $row['name'];
         

                    $myfile = fopen("$documents", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("$documents"));
    fclose($myfile);
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
   </head>
   <body>
   <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
   </body>
   </html>