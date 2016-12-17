<?php  
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login.php");
}  

else {





	
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

    </style>

  </head>
  <body>

    <div class="container">

      	<h2><a href = "logout.php">Sign Out</a></h2>

	      <table class="table"> 
	      <thead>
	       <tr>
	        <th>#</th> 
	        <th>First Name</th> 
	        <th>Last Name</th> 
	        <th>Username</th> 
	        </tr> 
	       </thead> 
	       <tbody>
	        <tr> 
	        <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> 
	        </tr>
	         <tr>
	          <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> 
	          </tr> 
	          <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> 
	          </tr>
	           </tbody>
	       </table>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>    

  </body>
</html>











