<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $First_Name = $_POST["First_Name"];
    $Last_Name = $_POST["Last_Name"];
    $Enrollment_No = $_POST["Enrollment_No"];
    $GR_No = $_POST["GR_No"];
    $Mobile_No = $_POST["Mobile_No"];
    $Institute_Mail_ID = $_POST["Institute_Mail_ID"];
    $Secondary_Mail_ID = $_POST["Secondary_Mail_ID"];
    $Department = $_POST["Department"];
    $Program = $_POST["Program"];
    $Semester = $_POST["Semester"];
    $Password = $_POST["Password"];
    $Confirm_Password = $_POST["Confirm_Password"];

    echo "First Name: " . $First_Name . "<br>";
    echo "Last Name: " . $Last_Name . "<br>";
    echo "Enrollment No: " . $Enrollment_No . "<br>";
    echo "GR No: " . $GR_No . "<br>";
    echo "Mobile No: " . $Mobile_No . "<br>";
    echo "Institute Email: " . $Institute_Mail_ID . "<br>";
    echo "Secondary Email: " . $Secondary_Mail_ID . "<br>";
    echo "Department: " . $Department . "<br>";
    echo "Program: " . $Program . "<br>";
    echo "Semester: " . $Semester . "<br>";
    echo "Password: " . $Password . "<br>";
    echo "Confirm Password: " . $Confirm_Password . "<br>";
} 
?>
