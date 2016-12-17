<?php 

include("config.php");
$error = "";    

if(isset($_POST['submit'])) { 

    if (!$_POST['fullname']) {
            
        $error .= "Your name is required<br>";
            
    } 

    if (!$_POST['email']) {
            
        $error .= "An email address is required<br>";
            
    } 
        
    if (!$_POST['password']) {
            
        $error .= "A password is required<br>";
            
    } 

    if (!$_POST['phone']) {
            
        $error .= "Your phone number is required<br>";
            
    }     
        
    if ($error != "") {
            
        $error = "<p>There were error(s) in your form:</p>".$error;
            
    } else {
        $fullname = mysqli_real_escape_string($db,$_POST['fullname']);
        $email = mysqli_real_escape_string($db,$_POST['email']);           
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);   

        if (strlen($phone) != 10 ) {

              $error .= "Please re-enter 10 digit phone number.<br>";
                                     
        }
        else {

          if (strlen($password < 4)) {

              $error .= "Your password must contain more than 4 characters.<br>";
          }

          else {

            $salt = openssl_random_pseudo_bytes(20);
            $secured_password = sha1($password . $salt);

            $sql = "INSERT INTO users (fullname, email, password, salt, phone) VALUES ('$fullname', '$email', '$secured_password', '$salt', '$phone')";

            $result = mysqli_query($db,$sql);        

              
            if(! $result ) {
              die('Could not enter data: ' . mysql_error());    
              
            }

            else {

              $sql2 = "SELECT * FROM users WHERE email= '$email'";
              $result2 = mysqli_query($db,$sql2);                      
              $row = mysqli_fetch_array($result2);          

              require("email.php");

                $email = new email();
                
                $token = $email->generateToken(20);
                
                $sql3  = "INSERT INTO emailTokens (id, token) VALUES ('".$row['id']."', '$token')";
                $result3 = mysqli_query($db,$sql3); 

                if($result3) {

                  $details = array();
                  $details["subject"] = "Email comfirmation on Book Exchange";
                  $details["to"] = $row["email"];
                  $details["fromName"] = "Book Exchange Office";
                  $details["fromEmail"] = "ahmetsafasezgin@gmail.com";
                  
                  
                  $template = $email->confirmationTemplate();
                  
                  $template = str_replace("{token}", $token, $template);
                  
                  $details["body"] = $template;
                  
                  $email->sendEmail($details);

                }     else {
                  echo "token kaydedilemedi";
                }           
                
            }                        
                
                header("Location: toLogin.php");
            }            


          }


          
    }
      }
       ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
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

        #loginLink {

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

             <form method="post" action="<?php $_PHP_SELF ?>" id="signUpForm">
       
           <fieldset class="form-group">
                <input class="form-control" type="text" name="fullname" placeholder="Name and Surname">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your Email">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </fieldset>

           <fieldset class="form-group">
                <input class="form-control" type="number" name="phone" placeholder="Phone Number">
            </fieldset>            


            <fieldset class="form-group">
                <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">               
            </fieldset>  
              <p style="color: white;">Already have an account? <a id="loginLink" href="login.php" >Click to login!</a></p>  
            </form>
    </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>     

  </body>
</html>
