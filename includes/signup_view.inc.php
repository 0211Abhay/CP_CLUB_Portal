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
        
        if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["error_signup"]["username_taken"])){
            echo '<input type="text" name="username" id="username" placeholder="username" value="'.$_SESSION["signup_data"]["username"].'">';
        }
        else{
            echo '<input type="text" name="username" id="username" placeholder="username">';
        }

        echo '<input type="password" name="pwd" id="pwd" placeholder="password">';

        if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["error_signup"]["email_used"]) && !isset($_SESSION["error_signup"]["invaild_email"])){
            
            echo ' <input type="text" name="email" id="email" placeholder="email" value="'.$_SESSION["signup_data"]["email"].'">';
        }
        else{
            echo ' <input type="text" name="email" id="email" placeholder="email" >';
        }
    }
?>