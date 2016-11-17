<?php

    session_start();

    if (array_key_exists("user_id", $_COOKIE)) {
        
        $_SESSION['user_id'] = $_COOKIE['user_id'];        
    }

    if (array_key_exists("user_id", $_SESSION)) {
        
        echo "<p>Logged In! <a href='index.php?logout=1'>Log out</a></p>";
        
    } else {
        
        header("Location: index.php");    
    }
?>