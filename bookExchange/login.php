<?php
session_start();
ob_start();
include("config.php");
$error = "";    
   
if(isset($_POST['login'])) {
        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {

            $email = mysqli_real_escape_string($db,$_POST['email']);
            $password = mysqli_real_escape_string($db,$_POST['password']); 

                  
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($db,$sql);
                               
            $row = mysqli_fetch_array($result);
                            
            if (isset($row)) {
                                    
            $hashedPassword = md5(md5($row['id']).$_POST['password']);
                                
               if ($hashedPassword == $row['password']) {
            
                     $_SESSION['valid'] = true;
                     $_SESSION['timeout'] = time();
                     $_SESSION['email'] = '$email'; 
                     header("Location: home.php");

                  } else {       

                      $error = "That email/password combination could not be found.<br>";                          
                 }
                            
              }else {
                                
                  $error = "That email/password combination could not be found.<br>";                        
          }  
        }

   }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

    <style type="text/css">
        
        .container {
            text-align: center;
            width: 400px;
            margin-top: 260px;
        }


        html { 
              background: url(background.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
    }
        body {
            background: none;
        }

        h1 {
            color: white;
        }      


        #forgotPasswordLink {

          color: white;
          text-decoration: underline;
          font-style: italic;
          font-size: 15px;
        }

        #registerLink {

          color: white;
          text-decoration: underline;
          font-style: italic;
        }
    </style>

  </head>
  <body>


    <div class="container">

        <h1>Book Exchange</h1>

            <div id="error"> <?php if($error!="") {

              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?> </div>

             <form method="post" id="loginForm">
  
            <fieldset class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your Email">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </fieldset>          

            <fieldset class="form-group">
                <input class="btn btn-success" type="submit" name="login" value="Login">               
            </fieldset>  
                 <a id="forgotPasswordLink" href="forgotpassword.php">Forgot your password?</a>
                 <p style="color: white;">Don't you have an account? <a id="registerLink" href="register.php" >Click to Register!</a></p>              
            </form>
          </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>