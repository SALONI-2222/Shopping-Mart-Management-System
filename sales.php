<?php
session_start();
include "data_conn.php";
include "welcome.php";

$sq = "SELECT * FROM sales";
$res = mysqli_query($conn, $sq);

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
      margin-top: 22px;
      padding-bottom: 30px;
    }
    table,td{
      border: 1px solid white;
    }
    table {
      border-collapse: collapse;
      width: 700px;
      margin-top: auto;
      margin-bottom: auto;
      margin-left: auto;
      margin-right: auto;
    }
    th, td {
      text-align: center;
      padding: 8px;
      border-bottom: 1px solid #e8e0e0;
    }
    tr:hover  {
      border-bottom: 2px solid #201e1e;
    }
    tr:nth-child(odd){
      background-color: white;
    }
    tr:nth-child(even) {
      background-color: gray;
    }
    #first{
      background-color:rgb(133, 233, 133);
      border-bottom: 2px solid #201e1e;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 style="text-align: center;margin-top: 22px;margin-bottom: 22px;" >Sales Status</h1>
    <table class="table table-striped">
      <thead>
        <tr id="first">
          <th scope="col">Product Id</th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (mysqli_num_rows($res) > 0) {
            while($r = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
          <td scope="col"><?php echo $r['id'];?></td>
          <td scope="col"><?php echo $r['name'];?></td>
          <td scope="col"><?php echo $r['sellunit'];?></td>
          <td scope="col"><?php echo $r['totalprice'];?></td>
        </tr>
        <?php 
            }
          } 
          else {
            echo "0 results";
          }
        ?>   
      </tbody>
    </table>
  </div>
</body>
</html>