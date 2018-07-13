<?php

    $link = mysqli_connect("localhost", "root", "", "busspass");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }

?>