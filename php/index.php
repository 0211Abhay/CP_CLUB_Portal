<?php
    require_once '../includes/config_session.inc.php';
    require_once '../includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CP Club ICT MU</title>
    <link rel="icon" href="../assets/Images/12.png" type="image/png" />
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    check_login_error();
    ?>
    <div class="wrapper">
        <form action="../includes/login.inc.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <label for="Email_Address">Email Address</label>
                <input type="text" placeholder="Email Address" name="Email_Address" id="Email_Address" required>
            </div>
            <div class="input-box">
                <label for="Password">Password</label>
                <input type="password" placeholder="Password" name="Password" id="Password" required>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
            <center><input type="submit" class="btn" value="Login"></center>
            <div class="register-link">
                <p>Don't have an account? <a href="../php/index_reg.php" target="_blank">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>