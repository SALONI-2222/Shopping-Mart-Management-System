<?php
include "welcome.php";
include "data_conn.php";
$sq = "SELECT * FROM bill";
$res = mysqli_query($conn, $sq);

if (mysqli_num_rows($res) > 0) {
    while($r = mysqli_fetch_assoc($res)) {
        mysqli_query($conn, "DELETE FROM `bill`");
    }
}
else{
    header("Location: welcome.php");
}
echo "Data in Bill deleted successfully";
?>
