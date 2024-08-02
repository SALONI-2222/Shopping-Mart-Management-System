<?php
session_start();
include "db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validate($_POST['username']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header ("Location: index.php?error=Username is required");
    exit();
}

if (empty($pass)) {
    header ("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM admin WHERE Name='$uname' AND Password='$pass'";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM salesman WHERE Name='$uname' AND Password='$pass'";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_array($result);
    if ($row['Name'] === $uname && $row['Password'] === $pass){
        echo "Logged In";
        $_SESSION["Name"]=$row['Name'];
        $_SESSION['name']=$row['name'];
        $_SESSION['S_No']=$row['S_No'];
        header("Location: wel.php");
        exit();
    } else {
        header ("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}
else if (mysqli_num_rows($result1) === 1) {
    $row = mysqli_fetch_array($result1);
    if ($row['Name'] === $uname && $row['Password'] === $pass){
        echo "Logged In";
        $_SESSION["Name"]=$row['Name'];
        $_SESSION['name']=$row['name'];
        $_SESSION['S_No']=$row['S_No'];
        header("Location: wel.php");
        exit();
    }
    else {
        header ("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
}
else {
    header ("Location: index.php?error=Incorrect User Name or Password");
    exit();
}
