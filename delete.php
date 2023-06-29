<?php
    include("./includes/db_connection.php");
    include("./includes/functions.php");
    session_start();
    $auth_id = $_SESSION['logged_in'];
    $size ="";
    // print_r($_SESSION);
    // exit();
    //DELETE FILE
    $folder_id = $_SESSION['folder_id'];

    if(isset($_GET['files'])){
        $id = $_GET['files'];
        // $file_id = $_SESSION['file_id'];
        $query = "SELECT * FROM otherfiles WHERE id = '$id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['file_size'];
        $sql = "DELETE FROM otherFiles WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("error". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{
                    header("location: files.php?files=$folder_id");
                }
            }
        }
        }
    }
    


    //DELETE MUSIC

    if(isset($_GET['music'])){
        $id = $_GET['music'];
        $music_id = $_SESSION['music_id'];

        $query = "SELECT * FROM music WHERE id = '$music_id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['size'];
            
        
        $sql = "DELETE FROM music WHERE id ='$music_id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            // echo $size;
            // exit();
            // $good = 4876032;
           
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("erroroooooooo". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{

                    header("location: music.php");

                }}
            }
      
    }
    }
    
    //DELETE IMAGE

    if(isset($_GET['img'])){
        $id = $_GET['img'];
        $img_id = $_SESSION['img_id'];

        $query = "SELECT * FROM image WHERE id = '$img_id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['size'];
        $sql = "DELETE FROM image WHERE id ='$img_id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("error". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{
                    header("location: image.php");
                }
            }
        }
    }}


    //DELETE VIDEO

    if(isset($_GET['video'])){
        $id = $_GET['video'];
        $video_id = $_SESSION['video_id'];
        $query = "SELECT * FROM videos WHERE id = '$video_id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['size'];
        $sql = "DELETE FROM videos WHERE id ='$video_id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("error". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{
                    header("location: movies.php");
                }
            }
        }
        }
    }

    //DELETE FOLDER
    if(isset($_GET['folder'])){
        $id = $_GET['folder'];
        
        $_SESSION['folder_id'] = $id;
        $folder_id = $_SESSION['folder_id'];
        
        $sql = "DELETE FROM others WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            header("location: delete.php?other_files='.$folder_id.'");
        }

    }

    //DELETE FOLDER

    if(isset($_GET['other_files'])){

        $sql = "DELETE FROM otherfiles WHERE folder_id ='$folder_id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            exit("error".mysqli_error($conn));
        }else{
            header("location:others.php");
        }
    }

    //DELETE DOCUMENT

    if(isset($_GET['doc'])){
        $id = $_GET['doc'];
        $_SESSION['doc_id'] = $id;
        $query = "SELECT * FROM documents WHERE id = '$id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['size'];
        $sql = "DELETE FROM documents WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("error". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{
                    header("location: documents.php");
                }
            }
        }
        }

    }

    //DELETE RECEIVED FILES

    if(isset($_GET['received_files'])){
        $id = $_GET['received_files'];
        // $_SESSION['doc_id'] = $id;
        $query = "SELECT * FROM receive WHERE id = '$id'";
        $results = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($results)){
            $size = $row['file_size'];
        $sql = "DELETE FROM `receive` WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);

        if(!$result){
            echo "error in delete";
        }else{
            $space = "SELECT * FROM `space` WHERE author_id='$auth_id'";
            $space_result = mysqli_query($conn,$space);
            while($rows = mysqli_fetch_assoc($space_result)){
                $f_space = $rows['total'];
                $f_id = $rows['id'];
            }
            $ins = "INSERT INTO `space` VALUES(null,$f_space - $size,$auth_id)";
            $ins_result = mysqli_query($conn,$ins);
            if(!$ins_result){
                exit("error". mysqli_error($conn));
            }else{
                $del = "DELETE FROM `space` WHERE id ='$f_id'";
                $del_result = mysqli_query($conn,$del);
                
                if(!$del_result){
                    exit("error".mysqli_error($conn));
                }else{
                    header("location: receive.php");
                }
            }
        }
        }

    }
?>