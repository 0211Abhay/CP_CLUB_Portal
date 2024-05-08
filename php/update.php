

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
    <div class="container" >  
     <div class="row full-height justify-content-center">  
      <div class="col-12 text-center align-self-center py-5">  
       <div class="section pb-5 pt-5 pt-sm-2 text-center">  
        <h6 class="mb-2 pb-1"><span>Forgot Password</span></h6>  
           
        <div class="card-3d-wrap mx-auto">  
          <div class="card-front">  
           <div class="center-wrapA">  
             <h4 class="mb-4 pb-3">Enter Your New PASSWORD</h4>  
              
             <?php
              session_start();
                        if(isset($_POST['verify'])){ 
                            $verify = $_POST['verify'];
                              if($_SESSION['random'] == $verify){
                                echo '<form action = "../php/updateconn.php" method="post">
               
                                <div class="form-group">
                                <input type="password" name="npass" class="form-style"  id="npass" autocomplete="off">  
                                <i class="input-icon uil uil-lock-alt"></i>
                                
                                </div>        
                                <button class="btn mt-4" name="change">CHANGE</button>  
                                 </div> 
                                 </form>';
                              }
                          else{
                              $_SESSION['invalid_OTP'] = 1;
                              header('location:../php/forgot.php');
                          }
                        }
              ?> 
            
             </div>  
            </div>   
        </div>  
    </div>
    </div>
    </div>
    </div>
</body>
</html>  