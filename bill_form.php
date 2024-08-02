<?php
include "data_conn.php";
include "welcome.php";

$numberOfInputs = isset($_GET['number_of_inputs']) ? intval($_GET['number_of_inputs']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if ($numberOfInputs > 0) {
        // Retrieve common data (customer_name, membership_card)
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
        $membership_card = mysqli_real_escape_string($conn, $_POST['membership_card']);
        $validationPassed = true;
        // Process each set of inputs
        for ($i = 0; $i < $numberOfInputs; $i++) {
            // Assuming you have the following fields for each set of inputs
            $id = intval($_POST['id'][$i] ?? 0);
            $sell_units = intval($_POST['selling_units'][$i] ?? 0);

            // Check if the product with the given ID exists
            $check_product_query = "SELECT * FROM product_data WHERE id = $id";
            $result_product = mysqli_query($conn, $check_product_query);

            if (mysqli_num_rows($result_product) > 0) {
                $product = mysqli_fetch_assoc($result_product);
                $name = $product['name'];
                $totalprice = $product['price'] * $sell_units;
                $punit = $product['units'];
                $u_unit = $punit - $sell_units;
                $discount = 0; // You can calculate discount based on your logic
                $totalbill = $totalprice - $discount;
                // Insert into 'bill' table
                $insertsql = "INSERT INTO bill(Customer_Name, Membership_card, id, name, sell_units, total_price, discount_amount, total_bill)
                                VALUES ('$customer_name', '$membership_card', '$id', '$name', '$sell_units', '$totalprice', '$discount', '$totalbill')";
                if ($conn->query($insertsql) !== TRUE) {
                    echo "Error inserting into 'bill' table: " . $conn->error;
                    $validationPassed = false;
                }
                // Update product quantity in 'product_data' table
                $update_quantity_query = "UPDATE `product_data` SET units = '$u_unit' WHERE id = '$id'";
                if ($conn->query($update_quantity_query) !== TRUE) {
                    echo "Error updating product quantity: " . $conn->error;
                    $validationPassed = false;
                }
                // Insert into 'sales' table
                $inserts = "INSERT INTO sales(id, name, sellunit, totalprice) VALUES ('$id', '$name', '$sell_units', '$totalprice')";
                if ($conn->query($inserts) !== TRUE) {
                    echo "Error inserting into 'sales' table: " . $conn->error;
                    $validationPassed = false;
                }
            } else {
                echo "Product with ID $id does not exist for $customer_name.";
                $validationPassed = false;
            }
        }
        if ($validationPassed) {
            echo "Transaction completed successfully for $customer_name!";
        } else {
            echo "Please check your inputs and try again.";
        }
    } else {
        echo "Please enter a valid number of inputs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Form</title>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin-top: 22px; margin-bottom: 22px;">Billing Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?number_of_inputs=$numberOfInputs"; ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" id="exampleInputName" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Membership Card</label>
                <input type="text" name="membership_card" class="form-control" id="exampleInputName" required>
            </div>
            <!-- Repeat the input fields for each set of data -->
            <?php
                for ($i = 0; $i < $numberOfInputs; $i++) {
            ?>
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Product ID</label>
                <input type="number" name="id[]" class="form-control" id="exampleInputName" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Selling Units</label>
                <input type="number" name="selling_units[]" class="form-control" id="exampleInputName" required>
            </div>
            <?php
                }
            ?>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
