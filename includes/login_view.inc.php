<?php
    declare(strict_types=1);
    if (isset($_COOKIE['remember_user'])) {
        $remembered_email = $_COOKIE['remember_user'];
        echo '<script>document.getElementById("Email_Address").value = "' . $remembered_email . '";</script>';
    }
    
    function check_login_error(){
        if(isset($_SESSION['errors_login'])){
            $errors = $_SESSION["errors_login"];
            echo "<br>";

            foreach($errors as $error){
                echo '<p class="form-error">'. $error.'</p>';
            }
            unset($_SESSION["errors_login"]);
        }
        else if(isset($_GET["login"]) && $_GET["login"] === "success"){
            header("Location: ../HTML/Dashboard.html");
die();
        }
    }
?>