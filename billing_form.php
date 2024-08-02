<?php
include "data_conn.php";
include "welcome.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $numberOfInputs = isset($_POST['number_of_inputs']) ? intval($_POST['number_of_inputs']) : 0;
    if ($numberOfInputs > 0) {
        // Redirect to bill_form.php with the number of inputs
        header("Location: bill_form.php?number_of_inputs=$numberOfInputs");
        exit();
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
        <h1 style="text-align: center; margin-top: 22px; margin-bottom: 22px;">Billing-Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Number of Inputs</label>
                <input type="number" name="number_of_inputs" class="form-control" id="exampleInputName" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
