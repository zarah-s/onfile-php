<?php
    
include("./includes/db_connection.php");
include("./includes/functions.php");
$total = $id ="";
if(isset($_POST['sendbtn'])){
    $send = $_POST['send'];
    $sql = "SELECT * from `space`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $total = $row['total'];
        $id = $row['id'];

    }
    $query = "INSERT into `space` (total) VALUES($send + $total)";
    $results = mysqli_query($conn,$query);

    $yep = "delete from space where id='$id'";
    $good = mysqli_query($conn,$yep);
    if(!$good){
        echo 'error';
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
    <title>Document</title>
</head>
<body>
    <form action="space.php" method="post">
        <input type="text" name="send" id="">
        <button type="submit" name="sendbtn">send</button>
    </form>
</body>
</html>