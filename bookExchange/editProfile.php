<?php  
session_start();  
include("config.php");
$error = "";   
$message = ""; 

  
if(!$_SESSION['email'])  

{  
    header("Location: login.php");
}  

else {

  if ($error != "") {
            
    $error = "<p>There were error(s) in your form:</p>".$error;
            
 }   

  $email = $_SESSION['email'];
  $sql = "SELECT * FROM  users WHERE email = '$email'";
  $result = mysqli_query($db,$sql);        
  $row = mysqli_fetch_array($result);
  $phone = $row['phone'];

  if(isset($_POST['submitEmailButton'])) {

    $newEmail = mysqli_real_escape_string($db,$_POST['newEmail']);

    $sql2 = "UPDATE users SET email = '$newEmail' WHERE id ='".$row['id']."'";
    $result2 = mysqli_query($db,$sql2);     

    if(isset($result2)) {

            $message .= "Your email address changed successfully.<br>";  

    } 

    else {

            $error .= "Unable to change your email address!<br>";

    } 
  } // change email button clicked


  if(isset($_POST['submitPasswordButton'])) {

    $newPassword = mysqli_real_escape_string($db,$_POST['newPassword']);    

    if (strlen($newPassword) < 4) {

        $error .= "Your password must contain more than 4 characters.<br>";
    }

    else {

      $salt = openssl_random_pseudo_bytes(20);
      $secured_password = sha1($newPassword . $salt);            

      $sql3 = "UPDATE users SET password = '$secured_password', salt= '$salt' WHERE id ='".$row['id']."'";
      $result3 = mysqli_query($db,$sql3);    

      if(isset($result3)) {

              $message .= "Your password changed successfully.<br>";  

      } 

      else {

              $error .= "Unable to change your password!<br>";
      }   
    }
  } // change password button clicked


  if(isset($_POST['submitPhoneButton'])) {

    $newPhone = mysqli_real_escape_string($db,$_POST['newPhone']);    

    if (strlen($newPhone) != 10 ) {

       $error .= "Please re-enter 10 digit phone number.<br>";
    }

    else {
         
      $sql4 = "UPDATE users SET phone = '$newPhone' WHERE id ='".$row['id']."'";
      $result4 = mysqli_query($db,$sql4);    

      if(isset($result4)) {

              $message .= "Your phone number changed successfully.<br>";  

      } 

      else {

              $error .= "Unable to change phone number!<br>";
      }   
    }
  } // change phone button clicked
  
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
            margin-top: 130px;
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

<div class="menu">
  <nav class="navbar navbar-light bg-faded"> 
  <ul class="nav navbar-nav"> 


  <li class="nav-item"> 
  <a class="nav-link" href="searchBook.php">Search Book</a> 
  </li> 

  <li class="nav-item"> 
  <a class="nav-link" href="addBook.php">Add Book</a> 
  </li> 

  <li class="nav-item dropdown active"> 
    <a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a> 
    <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
     <a class="dropdown-item" href="myBooks.php">My Books</a>
     <a class="dropdown-item" href="editProfile.php">Edit Profile</a> 
     <a class="dropdown-item" href="deleteBook.php">Delete Book</a>          
     </div> 
   </li> 

  <li class="nav-item"> 
  <a class="nav-link" href="logout.php">Logout</a> 
  </li>


   </ul>
     </nav>
  
</div>


    <div class="container">

        <h1>Edit Profile</h1>


            <div id="error"> <?php if($error!="") {

              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?> </div>    

           <div id="message"> <?php if($message!="") {

                    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';} ?> </div>     
        
            <div class="card card-block" style="margin-top: 30px;">
             <h4 class="card-title"> <?php echo $email; ?> </h4>
              <p class="card-text">Change email</p>                          
              <form class="form-inline float-right" method="post"> 
                <input class="form-control" type="email" name="newEmail" placeholder="New email address" style= "margin-bottom: 5px;">
                <fieldset class="form-group">
                    <input class="btn btn-success" type="submit" name="submitEmailButton" value="Change">               
                </fieldset>  
               </form>                            
              </div> 

            <div class="card card-block">
             <h4 class="card-title">Change Password</h4>
              <form class="form-inline float-right" method="post"> 
                <input class="form-control" type="password" name="newPassword" placeholder="New password">
                <fieldset class="form-group">
                    <input class="btn btn-success" type="submit" name="submitPasswordButton" value="Change">               
                </fieldset>  
               </form>                            
              </div>


            <div class="card card-block">
             <h4 class="card-title"> <?php echo $phone; ?> </h4>
              <form class="form-inline float-right" method="post"> 
                <input class="form-control" type="number" name="newPhone" placeholder="New phone number">
                <fieldset class="form-group">
                    <input class="btn btn-success" type="submit" name="submitPhoneButton" value="Change">               
                </fieldset>  
               </form>                            
              </div>
                                               
          </div>    

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>