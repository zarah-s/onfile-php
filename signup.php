<?php
  $errorMessage = "";
    include("includes/db_connection.php");
    include("includes/functions.php");

    if(isset($_POST['btnSignup'])){
        $firstName = sanitize_data($_POST['firstName']);
        $lastName = sanitize_data($_POST['lastName']);
        $email = sanitize_data($_POST['email']);
        $username = sanitize_data($_POST['username']);
        $password = sanitize_data($_POST['password']);
        $gender = sanitize_data($_POST['gender']);

          // validate length
    if(strlen($username) < 5 ){
        $errorMessage = '<div class="alert alert-danger" role="alert">
                            <strong>Username must be more than 5 characters</strong>
                          </div>';
      }else{
  
        // Check username duplicate
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
          $errorMessage = '<div class="alert alert-danger" role="alert">
                        <strong>'.$username.' </strong> already exists, please choose a new username
                      </div>';
        }else{
          // Check username duplicate
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
              $errorMessage = '<div class="alert alert-danger" role="alert">
                                <strong>'.$email.' </strong> already exists, please choose a new email
                              </div>';
            }else{
              // hash user's password
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
              $sql = "INSERT INTO users (firstName, lastName, userName, email, password,gender) VALUES('$firstName', '$lastName', '$username', '$email', '$hashed_password','$gender')";
              $result = mysqli_query($conn, $sql);
              
              if(!$result){
                die("Could not create user ". mysqli_error($conn));
              }else{
                header("Location: login.php?signup=success");
              }
            }
          }
    
      }
       
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<style>
  .eye{
    position:relative;
    bottom:37px;
    left:50%;
  }
</style>
<body>
  <?=$errorMessage?>
    <form action="signup.php" method="post">
        <div class="form-group">
          <input type="text" name="firstName" id="" class="form-control w-50 mt-5 ml-5" placeholder="firstName" aria-describedby="helpId" required autofocus>
        </div>
        <div class="form-group">
          <input type="text" name="lastName" id="" class="form-control w-50 ml-5" placeholder="lastName" aria-describedby="helpId" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" id="" class="form-control w-50 ml-5" placeholder="Email" aria-describedby="helpId" required>
        </div>
        <div class="form-group">
          <input type="text" name="username" id="" class="form-control w-50 ml-5" placeholder="Username" aria-describedby="helpId" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" id="password" class="form-control w-50 ml-5" placeholder="password" aria-describedby="helpId" required><button type="button" onclick = "viewPass()" class = "btn btn-light bg-light eye" style = "border:none"><i class = "fa fa-eye"></i></button>
        </div>
        <select name="gender" class="ml-5" id="" required>
            <option value="">Gender</option>
            <?php
                $sql = "SELECT * FROM gender";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $name = $row['name'];

                    echo '<option value = "'.$id.'">'.$name.'</option>';
                }
            ?>
        </select><br><br>
        <button type="submit" name = "btnSignup" class="btn btn-success ml-5">signup</button>
        <p class = "ml-5">Already have an account?<a href="login.php"> Login</a></p>
    </form>

    <script>
      var x = document.querySelector("#password");
      function viewPass(){
        if(x.type == "password"){
          x.type = "text";
        }else{
          x.type = "password"
        }
      }
    </script>
</body>
</html>