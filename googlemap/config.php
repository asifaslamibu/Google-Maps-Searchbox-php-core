<?php

    $mysqli = new mysqli("localhost","root","","map_location");

    if($mysqli->connect_error)
    {
        die('Connection Failed'.$mysqli->connect_error);
    }

   // echo "Database Connected Successfully ". $mysqli->host_info;

  
?>