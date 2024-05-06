<?php
    require_once '../includes/config_session.inc.php';
    require_once '../includes/signup_view.inc.php';
    require_once '../includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/Images/12.png" type="image/png" />
    <link rel="stylesheet" href="../css/registration.css">
    <title>Registration Form - CP Club ICT MU</title>
</head>
<body>
    <div class="container">
        <header>Registration</header>

        <form method="post"  id="Registration_Form" action="../includes/signup.inc.php">
        <?php
        signup_input();
        ?>
            <!-- <div class="form">
                <div class="details personal">

                    <div class="fields">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" id="First_Name"  name="First_Name" placeholder="Enter your First Name">
                        </div>

                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" id="Last_Name"  name="Last_Name" placeholder="Enter your Last Name">
                        </div>

                        <div class="input-field">
                            <label>Enrollment No</label>
                            <input type="text" id="Enrollment_No"  name="Enrollment_No" placeholder="Enter your Enrollment No">
                        </div>

                        <div class="input-field">
                            <label>GR No</label>
                            <input type="text" id="GR_No"  name="GR_No" placeholder="Enter your GR No">
                        </div>

                        <div class="input-field">
                            <label>Mobile No</label>
                            <input type="tel" id="Mobile_No"  name="Mobile_No" placeholder="Enter your Mobile No">
                        </div>

                        <div class="input-field">
                            <label>Institute Email</label>
                            <input type="text" id="Institute_Mail_ID"  name="Institute_Mail_ID" placeholder="Enter your Institute Mail ID">
                        </div>

                        <div class="input-field">
                            <label>Secondary Email</label>
                            <input type="text" id="Secondary_Mail_ID"  name="Secondary_Mail_ID" placeholder="Enter your Personal Email ID">
                        </div>

                        <div class="input-field">
                            <label for="Department">Department</label>
                            <select id="Department" name="Department">
                                <option disabled selected>Select Your Department</option>
                                <option>ICT</option>
                                <option>IT</option>
                                <option>CE</option>
                                <option>CE - AI</option>
                                <option>Computer Applications</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="Program">Program</label>
                            <select id="Program" name="Program">
                                <option disabled selected>Select Your Program</option>
                                <option>Diploma</option>
                                <option>Bachelor's</option>
                                <option>Master's</option>
                                <option>Doctorate</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label for="Semester">Semester</label>
                            <select id="Semester" name="Semester">
                                <option disabled selected>Select Your Semester</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" id="Password"  name="Password" placeholder="Enter your Password">
                        </div>

                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="password" id="Confirm_Password"  name="Confirm_Password" placeholder="Confirm Your Password">
                        </div>

                    </div> -->

                    <input type="submit" value="Register" class="btn" id="registerBtn">
                    
                </div>
            </div>
            <?php
        check_signup_error(); 
    ?>
        </form>
    </div>

    <script src="../js/registration.js"></script>
</body>
</html>