<?php 
    declare(strict_types=1);
    function get_erno(object $pdo, string $enrollment_no)
    {
        $query = "SELECT erno FROM users where erno = :erno;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":erno",$enrollment_no);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_grno(object $pdo, string $gr_no)
    {
        $query = "SELECT grno FROM users where grno = :grno;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":grno",$gr_no);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    function get_inst_email(object $pdo, string $institute_mail_id)
    {
        $query = "SELECT inst_mail FROM users where inst_mail = :inst_mail;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":inst_mail",$institute_mail_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_sec_email(object $pdo, string $secondary_mail_id)
    {
        $query = "SELECT sec_mail FROM users where sec_mail = :sec_mail;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":sec_mail",$secondary_mail_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function set_user($pdo, $first_name, $last_name, $enrollment_no, $gr_no, $mobile_no, $institute_mail_id, $secondary_mail_id, $password, $department, $program, $semester)
{
    $query = "INSERT INTO users (first_name, last_name, erno, grno, mobile_no, inst_mail, sec_mail, pass, dept, program, semester) VALUES (:first_name, :last_name, :enrollment_no, :gr_no, :mobile_no, :institute_mail_id, :secondary_mail_id, :pass, :department, :program, :semester);";
    $stmt = $pdo->prepare($query);

    // Hash the password
    $options = ['cost' => 12];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    // Bind parameters
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":enrollment_no", $enrollment_no);
    $stmt->bindParam(":gr_no", $gr_no);
    $stmt->bindParam(":mobile_no", $mobile_no);
    $stmt->bindParam(":institute_mail_id", $institute_mail_id);
    $stmt->bindParam(":secondary_mail_id", $secondary_mail_id);
    $stmt->bindParam(":pass", $hashedPwd);
    $stmt->bindParam(":department", $department);
    $stmt->bindParam(":program", $program);
    $stmt->bindParam(":semester", $semester);
    
    // Execute the query
    $result = $stmt->execute();

    // Return true if the query executed successfully
    return $result;
}


?>