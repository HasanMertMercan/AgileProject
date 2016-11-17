<?php

    $link = mysqli_connect("localhost", "root", "", "bookExchange");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");           
        }

?>