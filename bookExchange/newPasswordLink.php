<?php 
include("config.php");
$error = "";    
$message = ""; 

if(isset($_POST['save'])) { 

    $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
    $token = mysqli_real_escape_string($db,$_POST['token']);

        if (!$_POST['password_1']) {
            
            $error .= "Please enter a new password.<br>";            
        }     

        if (!$_POST['password_2']) {
            
            $error .= "Please confirm your new password<br>";            
        }     
        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;
            
        }    
        else {

            if ($password_1 != $password_2) {

                    $error .= "Passwords do not match<br>";            
            } 
            else {

            $sql = "SELECT id FROM passwordTokens WHERE token = '$token'";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result);

            if(!empty($row["id"])) {

                    $salt = openssl_random_pseudo_bytes(20);
                    $secured_password = sha1($password_1 . $salt);            

                    $sql2 = "UPDATE users SET password = '$secured_password', salt= '$salt' WHERE '".$row['id']."'";
                    $result2 = mysqli_query($db,$sql2);   

                    if($result2) {

                        if (!$error) {

                        $message .= "Your password has been reset successfully!<br>";  

                        }  
                    }
                    else 
                    $error .= "Sorry, something went wrong<br>";            


            } else {
                    $error .= "Sorry, something went wrong<br>";            
            }     
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


    </style>

  </head>
  <body>


    <div class="container">

        <h1>Book Exchange</h1>

            <div id="error"> <?php if($error!="") {

              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?> </div>    

             <div id="message"> <?php if($message!="") {

                echo '<div class="alert alert-success" role="alert">'.$message.'</div>';} ?> </div>              

            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <fieldset class="form-group">
                <input class="form-control" type="password" name="password_1" placeholder="New password">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="password" name="password_2" placeholder="Confirm new password">
            </fieldset>            

            <fieldset class="form-group">
                <input class="btn btn-success" type="submit" name="save" value="Save">              
            </fieldset>            
            <input type="hidden" value="<?php echo $_GET['token'];?>" name="token">            
            </form>
          </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>
