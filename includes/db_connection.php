<?php

    $db = [
        "hostName" => "localhost",
        "username" => "root",
        "password" => "",
        "name" => "onfile"
    ];

    $conn = mysqli_connect($db["hostName"],$db["username"],$db["password"],$db["name"]);

    if(!$conn){
        die("error occured". mysqli_error($conn));
    }else{
        // echo "successfully connected";
    }




?>