<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["First_Name"];
    $last_name = $_POST["Last_Name"];
    $enrollment_no = $_POST["Enrollment_No"];
    $gr_no = $_POST["GR_No"];
    $mobile_no = $_POST["Mobile_No"];
    $institute_mail_id = $_POST["Institute_Mail_ID"];
    $secondary_mail_id = $_POST["Secondary_Mail_ID"];
    $password = $_POST["Password"];
    $confirm_password = $_POST["Confirm_Password"];
    $department = $_POST['Department'];
    $program = $_POST['Program'];
    $semester = $_POST['Semester'];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];
        if (is_input_empty($first_name, $last_name, $enrollment_no, $gr_no, $mobile_no, $institute_mail_id, $secondary_mail_id, $password, $confirm_password, $department, $program, $semester)) {
            $errors["empty_input"] = "Fill in all fields!!";
        }

        if (is_email_invalid($institute_mail_id, $secondary_mail_id)) {
            $errors["invalid_email"] = "Invalid Email Used!!";
        }
        if (is_erno_registered($pdo, $enrollment_no, $gr_no)) {
            $errors["username_taken"] = "Erno or Grno Already Registered!!";
        }
        if (is_email_registered($pdo, $institute_mail_id, $secondary_mail_id)) {
            $errors["email_used"] = "Email Already Registered!!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            $response = ["success" => false, "errors" => $errors];
        } else {
            if (create_user($pdo, $first_name, $last_name, $enrollment_no, $gr_no, $mobile_no, $institute_mail_id, $secondary_mail_id, $password, $department, $program, $semester)) {
                $response = ["success" => true, "redirect_url" => "../php/index.php"];
            } else {
                $response = ["success" => false, "errors" => ["registration_failed" => "User registration failed"]];
            }
        }

        echo json_encode($response);
        exit();
    } catch (PDOException $e) {
        $response = ["success" => false, "errors" => ["query_failed" => "Query Failed: " . $e->getMessage()]];
        echo json_encode($response);
        exit();
    }
} else {
    $response = ["success" => false, "errors" => ["invalid_request" => "Invalid Request"]];
    echo json_encode($response);
    exit();
}
?>
