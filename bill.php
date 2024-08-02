<?php
session_start();
include "data_conn.php";
include "welcome.php";

$sq = "SELECT * FROM bill";
$res = mysqli_query($conn, $sq);
$x = mysqli_fetch_assoc($res);
$tprice=0;
$cus_name=$x['Customer_Name'];
$card=$x['Membership_card'];
$tprice+=$x['total_price'];
$discount=0;
?>

<html>
<head>
  <title></title>
  <style>
    body{
      margin-left: auto;
      margin-right: auto;
    }
    h1{
      text-align: center;
    }
  </style>
</head>
<body>
    <div class="container">
      <h1 >Bill</h1>
      <?php echo "<hr>"; ?>
      </br>
      <p><b>Name : </b></p><?php echo $cus_name;?>
      </br>
      <?php echo "<hr>"; ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Product Id</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($res) > 0) {
          ?>
          <tr>
            <td scope="col"><?php echo $x['id'];?></td>
            <td scope="col"><?php echo $x['name'];?></td>
            <td scope="col"><?php echo $x['sell_units'];?></td>
            <td scope="col"><?php echo $x['total_price'];?></td>
          </tr>
          <?php
              while($r = mysqli_fetch_assoc($res)) {
                  $tprice+=$r['total_price'];
          ?>
          <tr>
            <td scope="col"><?php echo $r['id'];?></td>
            <td scope="col"><?php echo $r['name'];?></td>
            <td scope="col"><?php echo $r['sell_units'];?></td>
            <td scope="col"><?php echo $r['total_price'];?></td>
          </tr>
          <?php 
              }
            } 
            else {
              echo "0 results";
            }
          ?>   
        </tbody>
          <?php 
            if ($tprice>=500){
              $discount= 0.05*$tprice;
              $tprice1=$tprice-$discount;
            }
            if ($card=="Yes"){
              if($tprice1<=250){
                $discount1=0;
              } elseif ($tprice1>250 && $tprice1<500) {
                $discount1= 0.02*$tprice1;
              } else {
                $x=intdiv($tprice1, 250);
                $discount1= 0.02*$x*$tprice1;
              }
            }
            $discount=$discount+$discount1;
            $tprice=$tprice-$discount;
            echo "<hr>";          
          ?>
            </br>
            <p><b>Discount : </b></p><?php echo $discount;?>
            </br>
            </br>
            <p><b>Total Bill : </b></p><?php echo $tprice;?>
            </br>
            </br>
            <button type="button" onclick="window.print();return false;">Pdf Report</button>
            <a href="del.php" class="btn btn-primary" name="del">Del</a>
            </br>
            </br>
            <?php echo "<hr>";?>
    </div>
</body>
</html>