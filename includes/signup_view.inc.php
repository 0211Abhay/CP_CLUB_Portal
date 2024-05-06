<?php 
    declare(strict_types=1);
    function check_signup_error()
    {
        if(isset($_SESSION["errors_signup"]))
        {
            $errors = $_SESSION["errors_signup"];
            echo "<br>";
            foreach($errors as $error)
            {
                echo '<p class="form-error">'. $error .'</p>';
            }
            unset($_SESSION['errors_signup']);
        }else if(isset($_GET["signup"]) && $_GET["signup"] == "success" ){
            echo "<br>";
            echo '<p class="form-success">Signup Success</p>';
        }
    }
    function signup_input()
{
    echo '<div class="form">';
    echo '<div class="details personal">';
    echo '<div class="fields">';
    $fields = array(
        "First_Name",
        "Last_Name",
        "Enrollment_No",
        "GR_No",
        "Mobile_No",
        "Institute_Mail_ID",
        "Secondary_Mail_ID",
        "Password",
        "Confirm_Password"
        // Add more fields as needed
    );

    foreach($fields as $field) {
        echo '<div class="input-field">';
        echo '<label for="'.$field.'">'.str_replace("_", " ", $field).'</label>';
        if(isset($_SESSION["signup_data"][$field]))
        {
            echo '<input type="'.(($field == "Password" || $field == "Confirm_Password") ? "password" : "text").'" id="'.$field.'" name="'.$field.'" placeholder="Enter your '.str_replace("_", " ", $field).'" value="'.$_SESSION["signup_data"][$field].'">';
        }
        else
        {
            echo '<input type="'.(($field == "Password" || $field == "Confirm_Password") ? "password" : "text").'" id="'.$field.'" name="'.$field.'" placeholder="Enter your '.str_replace("_", " ", $field).'">';
        }
        echo '</div>'; // Close input-field div
    }

    // Department
    echo '<div class="input-field">';
    echo '<label for="Department">Department</label>';
    echo '<select id="Department" name="Department">';
    echo '<option disabled selected>Select Your Department</option>';
    $departments = array("ICT", "IT", "CE", "CE - AI", "Computer Applications", "Other");
    foreach($departments as $dept)
    {
        if(isset($_SESSION["signup_data"]["Department"]) && $_SESSION["signup_data"]["Department"] === $dept)
        {
            echo '<option selected>'.$dept.'</option>';
        }
        else
        {
            echo '<option>'.$dept.'</option>';
        }
    }
    echo '</select>';
    echo '</div>'; // Close input-field div

    // Program
    echo '<div class="input-field">';
    echo '<label for="Program">Program</label>';
    echo '<select id="Program" name="Program">';
    echo '<option disabled selected>Select Your Program</option>';
    $programs = array("Diploma", "Bachelor's", "Master's", "Doctorate");
    foreach($programs as $prog)
    {
        if(isset($_SESSION["signup_data"]["Program"]) && $_SESSION["signup_data"]["Program"] === $prog)
        {
            echo '<option selected>'.$prog.'</option>';
        }
        else
        {
            echo '<option>'.$prog.'</option>';
        }
    }
    echo '</select>';
    echo '</div>'; // Close input-field div

    // Semester
    echo '<div class="input-field">';
    echo '<label for="Semester">Semester</label>';
    echo '<select id="Semester" name="Semester">';
    echo '<option disabled selected>Select Your Semester</option>';
    $semesters = array("1", "2", "3", "4", "5", "6", "7", "8");
    foreach($semesters as $sem)
    {
        if(isset($_SESSION["signup_data"]["Semester"]) && $_SESSION["signup_data"]["Semester"] === $sem)
        {
            echo '<option selected>'.$sem.'</option>';
        }
        else
        {
            echo '<option>'.$sem.'</option>';
        }
    }
    echo '</select>';
    echo '</div>'; // Close input-field div
    echo '</div>'; // Close input-field div
    echo '</div>'; // Close input-field div
    
    echo '</div>'; // Close form div
}
?>