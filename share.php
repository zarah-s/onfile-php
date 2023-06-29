    <?php
      include("includes/db_connection.php");
      include("includes/functions.php");
      session_start();

      if(isset($_GET['share_music'])){
          $id = $_GET['share_music'];

          $sql = "SELECT * FROM music WHERE id ='$id'";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
              $name = $row['name'];
              $type = $row['type'];
              $size = $row['size'];
              $id = $row['id'];
              $music = $row['music'];

              $_SESSION['file_name'] = $name;
              $_SESSION['file_type'] = $type;
              $_SESSION['file_size'] = $size;
              $_SESSION['file_id'] = $id;
              $_SESSION['file'] = $music;
        //       print_r($_SESSION);
        // exit();
          }

      }

      //SHARE IMAGE

      if(isset($_GET['share_image'])){
        $id = $_GET['share_image'];

        $sql = "SELECT * FROM image WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $type = $row['type'];
            $size = $row['size'];
            $id = $row['id'];
            $music = $row['image'];

            $_SESSION['file_name'] = $name;
            $_SESSION['file_type'] = $type;
            $_SESSION['file_size'] = $size;
            $_SESSION['file_id'] = $id;
            $_SESSION['file'] = $music;
        }

    }


        //SHARE VIDEO

        if(isset($_GET['share_video'])){
            $id = $_GET['share_video'];
    
            $sql = "SELECT * FROM videos WHERE id ='$id'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['name'];
                $type = $row['type'];
                $size = $row['size'];
                $id = $row['id'];
                $music = $row['video'];
    
                $_SESSION['file_name'] = $name;
                $_SESSION['file_type'] = $type;
                $_SESSION['file_size'] = $size;
                $_SESSION['file_id'] = $id;
                $_SESSION['file'] = $music;
            }
    
        }

      if(isset($_POST['btnShare'])){
          $send_to = sanitize_data($_POST['sendto']);
          $file_name = $_SESSION['file_name'];
          $file_size = $_SESSION['file_size'];
          $file_type = $_SESSION['file_type'];
          $file_id = $_SESSION['file_id'];
          $file = $_SESSION['file'];
          $auth_id = $_SESSION['logged_in'];
        // 
          $sql = "SELECT * FROM users WHERE username ='$send_to' OR email ='$send_to'";
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) == 0){
              exit($send_to."does not exist in field list");
          }else{
              while($row = mysqli_fetch_assoc($result)){
                  $to_id = $row['id'];
                  if($to_id == $auth_id){
                      exit("connot proceed command");
                  }else{
                    $test ="SELECT * from `space` WHERE author_id ='$to_id'";
                    $testresult = mysqli_query($conn,$test);
                    while($row = mysqli_fetch_assoc($testresult)){
                        $total = $row['total'];
                        $id = $row['id'];
                    }
            
                    if($total >= 1000000000){
                        exit("space");
                    }else{
                      $query = "INSERT INTO receive (`from`,`to`,`file_name`,`file_type`,`file_size`,`file`) VALUES ('$auth_id','$to_id','$file_name','$file_type','$file_size','$file')";
                      $output = mysqli_query($conn,$query);
                      if(!$output){
                          exit("error".mysqli_error($conn));
                      }else{
                          $about = "shared a file with you";
                         $command = "INSERT INTO notification (about,`from`,`to`,`file_name`) VALUES('$about','$auth_id','$to_id','$file_name')";
                         $last_result = mysqli_query($conn,$command);
                         if(!$last_result){
                             exit("problem".mysqli_error($conn));
                         }else{
                            $v = "select * from space where author_id ='$to_id'";
                            $i = mysqli_query($conn,$v);
                            $ct = mysqli_num_rows($i);
                            if($ct == 0){
                                $good = "INSERT into `space`  VALUES(null,$file_size + 0,$to_id) ";
                                $goodresult = mysqli_query($conn,$good);
                            }
                            $good = "INSERT INTO `space` values(null,$file_size + $total,$auth_id)";
                            $goodresult = mysqli_query($conn,$good);
                    
                            $yep = "delete from space where id='$id'";
                            $yepre = mysqli_query($conn,$yep);
                            if(!$yepre){
                                echo 'error';
                            }else{
                                header("location:index.php");
                            }
                         }
                      }
                  }}
              }
          }
      }


    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>share</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="share.php" class="mt-5" method="post">
                <div class="form-group">
                  <label for=""><h4>share to:
                  <input type="text"
                    class="form-control w-100" name="sendto" id="" aria-describedby="helpId" placeholder="person's username/email"></h4>
                    </label><button type="submit" name="btnShare" class="btn btn-success btn-sm ml-3"><i class="fa fa-share"></i> share</button>
                  <small id="helpId" class="form-text text-muted">write the name of the one you want to share to</small>
                </div>
            </form>
        </div>
    </div>

    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>