<?php
    declare(strict_types=1);
    function get_user(object $pdo, string $email){
        $query = "SELECT * FROM users where inst_mail = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert_login_record(object $pdo, string $email){
        $insert_query = "INSERT INTO login_records (inst_mail) VALUES (:email)";
        $stmt = $pdo->prepare($insert_query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    }
?>