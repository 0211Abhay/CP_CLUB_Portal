<?php
if(!isset($_SESSION['email'])){
    header('location:../php/index.php');
}
require('../includes/dbh.inc.php');
session_start();

$update = $_POST['npass'];
$email = $_SESSION['email'];

try {
    $stmt = $pdo->prepare("UPDATE users SET pass = :update WHERE inst_mail = :email");

    $options = ['cost' => 12];
    $hashedPwd = password_hash($update, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':update', $hashedPwd);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $_SESSION['successful'] = 1;
        header('location:../php/index.php');
    } else {
        echo 'No records updated';
    }
} catch(PDOException $e) {
    echo 'Database connection error: ' . $e->getMessage();
}
?>
