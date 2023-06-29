<?php

include("./includes/db_connection.php");
include("./includes/functions.php");
    // print_r($_SESSION); exit();
    if(isset($_POST['upload'])){
      

        //UPLOAD FILES
// $file_name = "";
                        
            $file_name = $_FILES['file']['name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $temp_location = $_FILES['file']['tmp_name'];
            $error= $_FILES['file']['error'];
            $upload_path="uploads/";

          
            if ($file_size > 1000000000) {
                exit("File too, large please upload only file lower than 1MB");
            }
            else{
                $file_extension = explode(".",$file_name );

                $permited_extentions = ["jpg","png","gif","jpeg"];


                if (!in_array(strtolower($file_extension[1]), $permited_extentions)) {
                    exit("Unsupported File type");
                }else{
                    $new_file_name="";
                    $file_name = uniqid();

                    $new_file_name = $upload_path.$new_file_name.".".strtolower($file_extension [1]);

                    // exit($new_file_name);
                    move_uploaded_file($temp_location, $new_file_name);
                    // echo "Image uploaded successfully!";
                }
            }




        $sql = " INSERT INTO images (image,size,name) VALUES ('$new_file_name','$file_size','$file_name')";

        $result = mysqli_query ($conn, $sql);

        if(!$result){
            die("ERROR OCCURED" . mysqli_error($conn));
        }else{
           echo "upload successful";
        }



    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>upload</title>
        <link rel="stylesheet" href="bs4/css/bootstrap.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
      
    </head>
    <body>
        
        <form action="images.php" method="post" enctype = "multipart/form-data">
            <input type="file" name="file" id=""><br><br>
            <button type="submit" name = "upload" class = "btn btn-primary">upload</button>
        
        </form><br><br>
        <div class="container">
            <div class="row">
        <table  width =100% >
            <thead>
                <tr>
                    <th class="">IMAGE</th>
                    <th class="col-md-">NAME</th>
                    <th class="col-md-">SIZE</th>
                    <th>DATE CREATED</th>
                    <th>ACTION</th>


                </tr>
            </thead>
            <tbody>
                <?php  

                    $sql = "SELECT * FROM images";
                    $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result)){
                        $images = $row['image'];
                        $name = $row['name'];
                        $size = $row['size'];
                        $date = $row['created_at'];
                        // $images = $row['name'];

                        echo ' <tr>

                                    <td scope="row"><img style = "width:100px;height:100px;border-radius:50px" src ="'.$images.'"></td>
                                <td>'.$name.'</td>
                                    <td>'.$size.'</td>
                                    <td>'.$date.'</td>
                                    <td> <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modelId">
                                      option
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">option</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body" style="text-decoration:none">
                                                    <a class="options" href =""><ul><li>move</li></ul></a>
                                                    <a class="options" href =""><ul><li>copy</li></ul></a>
                                                    <a class="options" href =""><ul><li>hide</li></ul></a>
                                                    <a class="options" href ="rename.php?rename='.$row['id'].'"><ul><li>rename</li></ul></a>
                                                    <a class="options" href ="delete.php?del='.$row['id'].'"><ul><li>delete</li></ul></a>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div></td>
                                </tr>';

                                // $sn++;
                        
                    }

                ?>
                
            </tbody>
           
        </table>
    
        </div>
        </div>
        <script src="bs4/js/jquery-3.5.1.min.js"></script>
        <script src="bs4/js/bootstrap.min.js"></script>
    </body>
    </html>
 