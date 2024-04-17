<?php

function validateInput($data) {
    $data = trim($data); // Remove leading/trailing whitespace
    $data = stripslashes($data); // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
    $username = validateInput($_POST["username"]);
    $password = validateInput($_POST["password"]);

    if (empty($username) || empty($password)) {
        $login_error = "Username and password are required";
    } 
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register_submit"])) {
    $full_name = validateInput($_POST["full_name"]);
    $institute_email = validateInput($_POST["institute_email"]);
    $personal_email = validateInput($_POST["personal_email"]);
    $phone_number = validateInput($_POST["phone_number"]);
    $department = validateInput($_POST["department"]);
    $batch_year = validateInput($_POST["batch_year"]);
    $enrollment_no = validateInput($_POST["enrollment_no"]);


    if (empty($full_name) || empty($institute_email) || empty($personal_email) || empty($phone_number) || empty($department) || empty($batch_year) || empty($enrollment_no)) {
        $registration_error = "All fields are required";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - CP Club ICT MU</title>

    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Log In</h2>
            <form action="#" method="post">
                <div class="input-box">
                    <input type="text" name="username" id="username">
                    <label for="username">User Name</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password">
                    <label for="password">Password</label>
                    <i class='bx bxs-lock'></i>
                </div>

                <button class="btn" type="submit" name="login_submit">
                    Log In
                </button>

                <div class="logreg-link">
                    <p>Don't Have An Account ? <a href="#" class="register-link">Sign Up</a></p>
                </div>
                <?php
                if (isset($login_error)) {
                    echo "<div class='error'>$login_error</div>";
                }
                ?>
            </form>
        </div>
    </div>

    <div class="container">
        <header>Registration</header>

        <form action="#" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name" placeholder="Enter your name">
                        </div>

                        <div class="input-field">
                            <label for="institute_email">Institute Email</label>
                            <input type="email" id="institute_email" name="institute_email" placeholder="Enter your institute email">
                        </div>

                        <div class="input-field">
                            <label for="personal_email">Personal Mail</label>
                            <input type="email" id="personal_email" name="personal_email" placeholder="Enter your personal email">
                        </div>

                        <div class="input-field">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number">
                        </div>

                        <div class="input-field">
                            <label for="department">Department</label>
                            <select id="department" name="department" required>
                                <option disabled selected>Select department</option>
                                <option value="CE-AI">CE-AI</option>
                                <option value="ICT">ICT</option>
                                <option value="CE">CE</option>
                                <option value="BIO INFORMATICS">BIO INFORMATICS</option>
                                <option value="IT">IT</option>
                                <option value="BCA">BCA</option>
                                <option value="MCA">MCA</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="batch_year">Batch Year</label>
                            <input type="number" id="batch_year" name="batch_year" placeholder="Enter your batch year">
                        </div>

                        <div class="input-field">
                            <label for="enrollment_no">Enrollment No</label>
                            <input type="text" id="enrollment_no" name="enrollment_no" placeholder="Enter your enrollment number">
                        </div>
                    </div>
                </div>
            </div>

            <div class="buttons">
                <button class="register" type="submit" name="register_submit">
                    <span class="btnText">Register</span>
                    <i class="uil uil-navigator"></i>
                </button>
                <button class="alreadyRegistered">
                    <span class="btnText">Already Registered</span>
                    <i class="uil uil-navigator"></i>
                </button>
            </div>
            <?php
                if (isset($registration_error)) {
                    echo "<div class='error'>$registration_error</div>";
                }
                ?>
        </form>
    </div>

    <script src="../js/login.js"></script>
</body>

</html>
