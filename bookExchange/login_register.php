<?php

    session_start();

    $error = "";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("user_id", "", time() - 60*60);
        $_COOKIE["user_id"] = "";  
        
    } else if ((array_key_exists("user_id", $_SESSION) AND $_SESSION['user_id']) OR (array_key_exists("user_id", $_COOKIE) AND $_COOKIE['user_id'])) {
        
        header("Location: loggedinpage.php");
        
    }

    if (array_key_exists("submit", $_POST)) {
        
        include ("connection.php");

        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 

        if (!$_POST['fullname']) {
            
            $error .= "A password is required<br>";
            
        } 

        if (!$_POST['phone']) {
            
            $error .= "A password is required<br>";
            
        }                 
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['signUp'] == '1') {
            
                $query = "SELECT user_id FROM `user` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                    $query = "INSERT INTO `user` (`email`, `password`, 'fullname', 'phone') VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."', '".mysqli_real_escape_string($link, $_POST['fullname'])."',  '".mysqli_real_escape_string($link, $_POST['phone'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `user` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE user_id = ".mysqli_insert_id($link)." LIMIT 1";

                        mysqli_query($link, $query);

                        $_SESSION['user_id'] = mysqli_insert_id($link);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("user_id", mysqli_insert_id($link), time() + 60*60*24*365);

                        } 

                        header("Location: loggedinpage.php");

                    }

                } 
                
            } else {
                    
                    $query = "SELECT * FROM `user` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['user_id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['user_id'] = $row['user_id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("user_id", $row['user_id'], time() + 60*60*24*365);

                            } 

                            header("Location: loggedinpage.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                }    
        }
           
    }

?>
<?php include("header.php") ?>

    <div class="container">

        <h1>Book Exchange</h1>


            <div id="error"><?php echo $error; ?></div>

            <form method="post" id="signUpForm">
           
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
                <input class="form-control" type="text" name="phone" placeholder="Phone Number">
            </fieldset>            


            <fieldset class="form-group">
                <input type="hidden" name="signUp" value="1">      
                <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">               
            </fieldset>  

             <p><a class="toggleForms">Already have an account? Click to login!</a></p>  

            </form>

            <form method="post" id="loginForm">

            <fieldset class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your Email">
            </fieldset>    

            <fieldset class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </fieldset>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="stayLoggedIn" value=1> Stay Logged in    

                </label>        
            </div>

            <fieldset class="form-group">
                <input type="hidden" name="signUp" value="0">
                <input class="btn btn-success" type="submit" name="submit" value="Log In!">
            </fieldset>  
            
             <p><a class="toggleForms">Don't you have an account? Create one!</a></p>  
  

            </form>
    </div>

<?php include ("footer.php"); ?>
