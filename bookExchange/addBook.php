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

  if(isset($_POST['addBook'])) { 

    if (!$_POST['bookName']) {
            
        $error .= "Book name is required<br>";
            
    } 
        
    if (!$_POST['author']) {
            
        $error .= "Author name is required<br>";
            
    } 

    if (!$_POST['publishYear']) {
            
        $error .= "Publish year is required<br>";
            
    }     
        
    if ($error != "") {
            
        $error = "<p>There were error(s) in your form:</p>".$error;
            
    } else {


        $email = $_SESSION['email'];
        $bookName = mysqli_real_escape_string($db,$_POST['bookName']);
        $author = mysqli_real_escape_string($db,$_POST['author']);           
        $publishYear = mysqli_real_escape_string($db,$_POST['publishYear']);

        if (strlen($publishYear) != 4 ) {

              $error .= "Please re-enter publish year with 4 digit.<br>";
                                     
        }
        else {

            $sql = "SELECT id FROM  users WHERE email = '$email'";
            $result = mysqli_query($db,$sql);        
            $row = mysqli_fetch_array($result);
 
            if(isset($row)) {

              $sql2 = "INSERT INTO books (bookName, author, ownerId, publishYear) VALUES ('$bookName','$author', '".$row['id']."', '$publishYear')";
              $result2 = mysqli_query($db,$sql2);


              if ($result2) {

                  $message = "Your book added to library safely!<br>";  

                      }        

              else {

                  $error .= "Unable to add book.<br>";

              }

            }

            else {

             $error .= "User session is unable.<br>";
            } 
                                                          

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

  <li class="nav-item active"> 
    <a class="nav-link" href="addBook.php">Add Book 
    <span class="sr-only">(current)</span>
    </a> 
</li>

  <li class="nav-item dropdown"> 
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

        <h1>Add Book</h1>


            <div id="error"> <?php if($error!="") {

              echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?> </div>    

           <div id="message"> <?php if($message!="") {

                    echo '<div class="alert alert-success" role="alert">'.$message.'</div>';} ?> </div>                       

             <form method="post" id="addBookForm">
  
            <fieldset class="form-group">
                <input class="form-control" type="text" name="bookName" placeholder="Book Name">
            </fieldset>

            <fieldset class="form-group">
                <input class="form-control" type="text" name="author" placeholder="Author">
            </fieldset> 

            <fieldset class="form-group">
                <input class="form-control" type="number" name="publishYear" placeholder="Publish Year">
            </fieldset>                       

            <fieldset class="form-group">
                <input class="btn btn-success" type="submit" name="addBook" value="Add">               
            </fieldset>  
            </form>    

          </div>    

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>