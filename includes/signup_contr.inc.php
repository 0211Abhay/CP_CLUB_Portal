<?php 
    declare(strict_types=1);

    function is_input_empty(string $first_name, string $last_name, string $enrollment_no, string $gr_no, string $mobile_no, string $institute_mail_id, string $secondary_mail_id, string $password, string $confirm_password, string $department, string $program, string $semester)
{
    if (empty($first_name) || empty($last_name) || empty($enrollment_no) || empty($gr_no) || empty($mobile_no) || empty($institute_mail_id) || empty($secondary_mail_id) || empty($password) || empty($confirm_password) || empty($department) || empty($program) || empty($semester)) {
        return true;
    } else {
        return false;
    }
}


    function is_email_invalid(string $institute_mail_id, string $secondary_mail_id)
    {
        if(!filter_var($institute_mail_id, FILTER_VALIDATE_EMAIL) || !filter_var($secondary_mail_id, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else{
            return false;
        }
    }

    function is_erno_registered(object $pdo,string $enrollment_no,string $gr_no)
    {
        if(get_erno( $pdo, $enrollment_no) || get_grno( $pdo, $gr_no)){
            return true;
        }
        else{
            return false;
        }
    }

    function is_email_registered(object $pdo,string $institute_mail_id, string $secondary_mail_id)
    {
        if(get_inst_email( $pdo, $institute_mail_id) || get_sec_email( $pdo, $secondary_mail_id)){
            return true;
        }
        else{
            return false;
        }
    }

    function create_user($pdo, $first_name, $last_name, $enrollment_no, $gr_no, $mobile_no, $institute_mail_id, $secondary_mail_id, $password, $department, $program, $semester)
{
    return set_user($pdo, $first_name, $last_name, $enrollment_no, $gr_no, $mobile_no, $institute_mail_id, $secondary_mail_id, $password, $department, $program, $semester);
}



?>