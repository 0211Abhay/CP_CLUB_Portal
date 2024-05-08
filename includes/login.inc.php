<?php
    if($_SERVER["REQUEST_METHOD"] ==="POST"){
        $email = $_POST["Email_Address"];
        $pwd = $_POST["Password"];
        try{
            require_once 'dbh.inc.php';
            require_once 'login_model.inc.php';
            require_once 'login_contr.inc.php';

            $errors = [];
            if(is_input_empty($email, $pwd))
            {
                $errors["empty_input"] = "Fill in all fields!!";
            }

            $result = get_user($pdo,$email);
            if(is_email_wrong($result)){
                $errors["login_incorrect"] = "Incorrect Login info!";
            }
            if(!is_email_wrong($result) && is_password_wrong($pwd,$result["pass"])){
                
            }
            require_once 'config_session.inc.php';

            if($errors)
            {
                $_SESSION["errors_login"] = $errors;
                header("Location: ../php/index.php");
                die();
            }

            $newSessionId = session_create_id();
            $sessionID = $newSessionId . "_" . $result["grno"];
            session_id($newSessionId);

            $_SESSION["user_id"] = $result["grno"];
            $_SESSION["user_email"] = htmlspecialchars($result["inst_email"]);
            $_SESSION["last_regeneration"] = time();
            // After successful login
            if (is_admin($result)) {
                header("Location: ../admin_dashboard.php"); // Redirect to admin dashboard
            } else {
                header("Location: ../HTML/Dashboard.html"); // Redirect to user dashboard
            }


            $pdo = null;
            $stmt = null;
            die();
        }catch(PDOException $e){
            die("Query Failed : ". $e->getMessage());
        }
    }else{
        header("Location: ../php/index.php");
        die();
    }
?>