<?php

    $name = "localhost";
    $nmae = "root";
    $passwrd = "";

    $d_name = "data";

    $conn = mysqli_connect($name,$nmae,$passwrd,$d_name);
    if (!$conn)
    {
        echo "Connection Failed";
        
    }