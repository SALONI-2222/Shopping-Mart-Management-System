<?php

    $sname = "localhost";
    $unmae = "root";
    $password = "";

    $db_name = "users";
    //$db_name2 = "Saleman";

    $conn = mysqli_connect($sname,$unmae,$password,$db_name);
    //$conn2 = mysql_connect($sname,$unmae,$password,$db_name2);

    if ($conn)
    {
        echo "Connection Failed";
        
    }