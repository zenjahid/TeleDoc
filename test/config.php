<?php
    $host = "127.0.0.1";
    $user = "root";                     
    $pass = "";                                  
    $db = "teledoc";
    $port = 3308;
     $con = mysqli_connect($host, $user, $pass, $db, $port)or die('Error: ' . mysqli_error($myConnection));;
?>