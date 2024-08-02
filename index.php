<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" >
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post" >
        <h1>LOGIN</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label >Username: </label>
        <input name="username" type="text"/><br>
        <label >Password:  </label>
        <input name="password" type="password" /><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>