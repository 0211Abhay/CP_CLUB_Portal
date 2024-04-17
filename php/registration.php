<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $lastName = $grNo = $enrollmentNo = $department = $semester = $program = $email = $password = $confirmPassword = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $firstNameErr = "Only letters and white space allowed";
        }
    }

    if (empty($firstNameErr) && empty($lastNameErr) && empty($grNoErr) && empty($enrollmentNoErr) && empty($departmentErr) && empty($semesterErr) && empty($programErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        header("Location: registration_success.php");
        exit();
    }
}

?>
