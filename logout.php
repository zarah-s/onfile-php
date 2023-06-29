<?php 

    session_start();

    if(!$_SESSION['logged_in']){
        header("Location: login.php");
    }else{
        $_SESSION['logged_in'] = FALSE;

        session_unset();

        session_destroy();

        header('Location: login.php');


    }




?>