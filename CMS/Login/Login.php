<?php
    ob_start();
    session_start();
    require("include/db.php");

    if(isset($_POST['submit'])){
        $username=mysqli_real_escape_string($conn,strtolower($_POST['username']));
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        
        $check_username_query="SELECT * FROM users WHERE username='$username'";
        $check_username_run=mysqli_query($conn,$check_username_query);
        
        if(mysqli_num_rows($check_username_run)>0){
            $row=mysqli_fetch_array($check_username_run);
            $db_username=$row['username'];
            $db_password=$row['password'];
            $db_role=$row['role'];
            $db_author_image=$row['image'];
            $password=crypt($password,$db_password);
            
            
            if($username==$db_username && $password==$db_password){
                header('Location:index.php');
                $_SESSION['username']=$db_username;
                $_SESSION['role']=$db_role;
                $_SESSION['author_image']=$db_author_image;
            }
            else{
                $error="Invalid UserName or Password";
            }
            
        }
        else{
            $error="Invalid UserName or Password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Rohail Butt Blog | Huge Video Tutorial Portal</title>

    <!-- Bootstrap -->
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animated.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <div class="container">
       <form action="" class="animated fadeInDownBig" method="post">
          <h3 id="log">Admin Login</h3>
           <div class="form-group">
               <input type="text" id="username" name="username" placeholder="Enter UserName" class="form-control">
           </div>
           <div class="form-group">
               <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" >
           </div>
           <div class="form-check" >
               <label for="" class="form-check-label">
                   <input type="checkbox" class="form-check-input">
                   Remember Me!
               </label>
           </div>
           <input type="submit" class="btn btn-primary btn-block btn-lg" name="submit" value="Log In">
       </form>
   </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>