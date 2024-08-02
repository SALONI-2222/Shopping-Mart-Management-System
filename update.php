<?php
    include "data_conn.php";
    include "welcome.php";
    if (isset($_POST['submit'])) {
      $id =$_POST['id'];
      $name=$_POST['name'];
      $price=$_POST['price'];
      $expiry_date =$_POST['expirydate'];
      $rack=$_POST['rack'];
      $units=$_POST['units'];
      $insertsql = "INSERT INTO product_data(id,name,price,units,expiry_date, rack_no) VALUES ('$id','$name', '$price','$units','$expiry_date', '$rack')";
      if ($conn->query($insertsql) === TRUE) {
        echo "";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
      <h1 style="text-align: center;margin-top: 22px;" >Update</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Product I'd</label>
          <input type="number" name="id" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
          <label for="exampleInputName" class="form-label">Product Name</label>
          <input type="text" name="name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
          <label for="exampleInputDes" class="form-label">Product Price</label>
          <input type="number" name="price" class="form-control" id="exampleInputDes">
        </div>
        <div class="mb-3">
          <label for="exampleInputDes" class="form-label">Number of Units</label>
          <input type="number" name="units" class="form-control" id="exampleInputDes">
        </div>
        <div class="mb-3">
          <label for="exampleInputDes" class="form-label">Expiry Date</label>
          <input type="date" name="expirydate" class="form-control" id="exampleInputDes">
        </div>
        <div class="mb-3">
          <label for="exampleInputDes" class="form-label">Rack Number</label>
          <input type="number" name="rack" class="form-control" id="exampleInputDes">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
</body>
</html>