
<?php 

include("./includes/db_connection.php");
include("./includes/functions.php");


  $successMessage = $errorMessage = "";

  if(isset($_GET['signup'])){
      if($_GET['signup'] == 'success'){
          $successMessage = '<div class="alert alert-success" role="alert">
                                  <strong>Your account has been created successfully!</strong>
                              </div>';
      }
  }

  // login user

  if(isset($_POST['btnLogin'])){
    $user_id = sanitize_data($_POST['username']);
    $password = sanitize_data($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$user_id' OR email = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) < 1 ){
      $errorMessage = '<div class="alert alert-danger" role="alert">
                            <strong>Incorrect Username/Email or Password</strong>
                        </div>';
                        
                        
    }elseif(mysqli_num_rows($result) > 0){

      while($row =  mysqli_fetch_assoc($result)){
        $hashed_password = $row['password'];
        $id = $row['id'];

      }

      // dehash password and compare
      $check_password = password_verify($password, $hashed_password);

      if(!$check_password){
        
        $errorMessage = '<div class="alert alert-danger" role="alert">
                            <strong>Incorrect Username/Email or Password</strong>
                        </div>';
                        
                       
      }else{

        // User is valid, create sessions
        session_start();

        $_SESSION['user_identity'] = $user_id;
        $_SESSION['id']=TRUE;
        $_SESSION['logged_in'] = $id;

        // set cookies
        // $duration = time(60 * 60 * 24 * 365);

//         print_r($_SESSION);
// exit();
      
        // setcookie('User', $user_id, $duration);
        // setcookie('Password', $password, $duration);

        header("Location: index.php?login=successful");

      }
      
    }

  }
  $login="";

  if(isset($_GET['log'])){
    $login = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>please login</strong> 
</div>';
  }


?>


<script>
  $(".alert").alert();
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
    
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
  <?=$successMessage?>
  <?=$errorMessage?>
  <?=$login?>

  <div class="container">
    <form action="login.php" method="post">
      <div class="form-group">
        <input type="text" name="username" id="" class="form-control w-50 ml-5 mt-5" placeholder="username/email" aria-describedby="helpId" required autofocus>
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control w-50 ml-5 " placeholder="password" aria-describedby="helpId" required><button type="button" onclick = "viewPass()" class = "btn btn-light bg-light eye" style = "border:none"><i class = "fa fa-eye"></i></button>
      </div>
      <button type="submit" name="btnLogin" class = "btn btn-success w-25 ml-5">login</button>
    </form>
    <h6 class="ml-5">dont have an account? <a href="signup.php">signup</a></h6>
    <a href="#" class = "ml-5">forgoten password?</a>
  </div>
   
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
    <script src="bs4/js/jquery-3.5.1.min.js"></script>
    <script src="bs4/js/bootstrap.min.js"></script>
</body>
</html>