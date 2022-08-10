<?php
    //database credentials
    $servername = "#";
    $db_username = "#";
    $db_password = "#";
    $db_name = "#";

    //connecting to database
    $connect = mysqli_connect($servername, $db_username, $db_password, $db_name);

    if(mysqli_connect_error()){
        echo"Cannot connect to the Database.";
        exit();
    }

?>