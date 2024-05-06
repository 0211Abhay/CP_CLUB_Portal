<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store validation errors
    $errors = [];

    // Validate email
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    $password = trim($_POST["pswd"]);
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no validation errors, proceed with further processing
    if (empty($errors)) {
        // Perform additional authentication or database operations here
        // For demonstration purposes, we'll just redirect to a success page
        header("Location: success.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In CP Club ICT MU</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div id="main" class="rounded-50">
        <div class="row">
            <div id="form-div">
                <h1>Log In</h1>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email"
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php if (!empty($errors) && in_array("Email is required", $errors)) {
                            echo "<span class='text-danger'>Email is required</span>";
                        } elseif (!empty($errors) && in_array("Invalid email format", $errors)) {
                            echo "<span class='text-danger'>Invalid email format</span>";
                        } ?>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" name="pswd" id="pwd" class="form-control"
                            placeholder="Enter Your Password">
                        <?php if (!empty($errors) && in_array("Password is required", $errors)) {
                            echo "<span class='text-danger'>Password is required</span>";
                        } ?>
                    </div>

                    <div class="form-group form-check"><input type="checkbox" name="remember" id=""
                            class="form-check-input">Remember me</label>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-primary" id="btn">Log In</button>
                    </center>
                </form>

                <?php
                // Display validation errors if any
                if (!empty($errors)) {
                    echo "<div class='alert alert-danger mt-3'>";
                    echo "<ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
