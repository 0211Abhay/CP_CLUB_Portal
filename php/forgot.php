<?php
require('../includes/dbh.inc.php'); // Include the PDO connection file
require('../includes/PHPMailer.php');
require('../includes/SMTP.php');
session_start();

if(isset($_POST['Email'])){
    $email = $_POST['Email'];

    $stmt = $pdo->prepare("SELECT inst_mail FROM users WHERE inst_mail = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$row){
        echo 'Invalid user';
    } else {
        $random = rand(1000,10000);
        
        $_SESSION['email'] = $row['inst_mail'];
        $_SESSION['random'] = $random;

        //Sending email code
        // PHPMailer classes into the global namespace
        // Base files 

        // create object of PHPMailer class with boolean parameter which sets/unsets exception.
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP(); // using SMTP protocol                                     
            $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
            $mail->SMTPAuth = true;  // enable smtp authentication                             
            $mail->Username = 'aryan.langhanoja119561@marwadiuniversity.ac.in';  // sender gmail host              
            $mail->Password = 'ebqn gbry trqz onji'; // sender gmail host password                          
            $mail->SMTPSecure = 'tls';  // for encrypted connection                           
            $mail->Port = 587;   // port for SMTP     

            $mail->setFrom('aryan.langhanoja119561@marwadiuniversity.ac.in', "Admin"); // sender's email and name
            $mail->addAddress($email, "Receiver");  // receiver's email and name

            $mail->Subject = 'One Time Password';
            $mail->Body    = 'Your OTP is '.$random;

            $mail->send();
            //echo 'Email has been sent. If not recieved please check SPAM box.';
        } catch (Exception $e) { // handle error.
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
?>

<html>
<head>
    <title>Forgot password</title>
</head>
<body>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8" />  
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="../css/forgot.css">  
</head>  
<body>  
<div class="section">  
    <div class="container">  
        <div class="row full-height justify-content-center">  
            <div class="col-12 text-center align-self-center py-5">  
                <div class="section pb-5 pt-5 pt-sm-2 text-center">  
                    <h6 class="mb-2 pb-1"><span>Forgot Password</span></h6>  

                    <div class="card-3d-wrap mx-auto">  
                        <div class="card-front">  
                            <div class="center-wrapA">
                                <?php
                                if (!isset($_POST['submit'])) {
                                    echo ' <h4 class="mb-4 pb-4">Enter Your E-Mail ID</h4>';
                                } else {
                                    echo ' <h4 class="mb-4 pb-4">Enter OTP</h4>';
                                    echo 'Email has been sent. If not received please check SPAM box.';
                                }

                                if (!isset($_POST['submit'])) {
                                    echo '  <form action = "forgot.php" method="post">
                        <div class="form-group"> 
                        <input type="email" name="Email" class="form-style"  id="Email" autocomplete="off">  
                        <i class="input-icon uil uil-at"></i>    
                          <button class="btn mt-4" name="submit">SUBMIT</button>
                        </div> </form>';
                                    if (isset($_SESSION['invalid_OTP'])) {
                                        echo 'INVALID OTP. Enter Your Email Again.';
                                        session_destroy();
                                    }
                                } else {
                                    echo ' <form action="update.php" method="post">
                            <div class="form-group"> 
                            <input type="text" name="verify" class="form-style"  id="verify" autocomplete="off">  
                          <i class="input-icon uil uil-lock-alt"></i>
                          <button class="btn mt-4" name="vrfybtn">VERIFY</button> 
                          </div> 
                          </form>';
                                }
                                ?>


                            </div>  
                        </div>

                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
