<?php
    declare(strict_types=1);

    function is_input_empty(string $email, string $pwd){
        if(empty($email)||empty($pwd)){
            return true;
        }else{
            return false;
        }
    }
    function is_email_wrong(bool|array $result){
        if(!$result){
            return true;
        }else{
            return false;
        }
    }
    function is_password_wrong(string $pwd, string $hasedPwd)
    {
        if(!password_verify($pwd,$hasedPwd)){
            return true;
        }else{
            return false;
        }
    }

    function is_admin(array $result) {
        return ($result['role'] === 'admin');
    }

    function set_login_record(object $pdo, string $email)
    {
        insert_login_record($pdo,$email);
    }
?>