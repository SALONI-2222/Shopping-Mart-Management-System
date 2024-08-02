<?php
session_start();
if (isset($_SESSION['S_No']) && isset($_SESSION['Name'])) {
    header("location: wel.php");
    exit();
} 
else{
    header("location: index.php");
    exit();
}
?>
