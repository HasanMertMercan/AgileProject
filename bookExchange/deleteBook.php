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


  if(isset($_POST['delete'])) { 

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM  users WHERE email = '$email'"; 
    $result = mysqli_query($db,$sql);               
    $row = mysqli_fetch_array($result);
    $isAdmin = $row['isAdmin'];

    
    $deleteText = mysqli_real_escape_string($db,$_POST['deleteText']);

    if ($isAdmin == 1){

      $sql2 = "DELETE FROM books WHERE bookId = '$deleteText'";  
      $result2 = mysqli_query($db,$sql2);

      if ( mysqli_affected_rows($db) > 0) {
        $message = "Book deleted successfully!<br>";
      }
      else {
        $error .= "Unable to delete book.";
}

    }

    else {

      $sql3 = "DELETE FROM books WHERE bookId = '$deleteText' AND ownerId= '".$row['id']."'";  
      $result3 = mysqli_query($db,$sql3);

      if ( mysqli_affected_rows($db) > 0) {
        $message = "Book deleted successfully!<br>";
      }
      else {
        $error .= "Unable to delete book.";
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
            margin-top: 200px;
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

        h1, h5 {
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

        <h1>Delete Book</h1>


            <div id="error"> <?php if($error!="") {

              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?> </div>    

           <div id="message"> <?php if($message!="") {

                    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';} ?> </div>                        

        <h5>Please enter id of the book</h5>

      <form method="post">
              <fieldset class="form-group">
                <input class="form-control" type="text" name="deleteText" placeholder="">
            </fieldset>

            <fieldset class="form-group">
                <input class="btn btn-success" type="submit" name="delete" value="Delete">               
            </fieldset>    

        </form>
          

          </div>    



            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>