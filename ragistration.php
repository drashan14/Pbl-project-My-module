

<?php
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a style="text-decoration:none" href="'.$google_client->createAuthUrl().'"><font  color="white">Login With Google</font></a>';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'dbconnect.php';
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
//$v_code= $_POST[bin2hex(random_bytes(16))];

function sendMail($username,$v_code)
{
require ("PHPMailer\PHPMailer.php");
require ("PHPMailer\SMTP.php");
require ("PHPMailer\Exception.php");

    $mail = new PHPMailer(true);
    try {
      //Server settings
                           //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'darshanrathod1293@gmail.com';                     //SMTP username
      $mail->Password   = 'drashan14';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom('darshanrathod1293@gmail.com', 'Darshan');
      $mail->addAddress($username);     //Add a recipient
      
      
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Testing expense tracker';
      $mail->Body    = 'Thanks for the ragistration !
                            click the ink below to verify the email adress <a href="http://localhost/pblproject/gayatri project/ragistration.php">verify</a>
                             ';
                     
     
      $mail->send();
     ?>
     <script>alert("The eamil is succefully send");</script>
     <?php
     
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  } 
}
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `ragistration` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows >0 ){
        // $exists = true;

        ?>
        <script>alert("The account is already exists");</script>
        <?php
    }
    else{
        // $exists = false;
        if(($password == $cpassword)){
            //$hash = password_hash($password, PASSWORD_DEFAULT);
            $v_code=bin2hex(random_bytes(16));
            $sql = "INSERT INTO `ragistration` ( `username`, `password`,`verification_code`, `is_verified`,  `dt`) VALUES ('$username', '$password', '$v_code','0',current_timestamp())";
            $result = mysqli_query($conn, $sql) ;
            if ( $result && sendMail($_POST['username'],$v_code )){
            //  include require "sendemail.php";
                 echo "<script>alert('The ragistration is succefull');
                    window.location.href='ragistration.php';</script>";
            }    
                // header('location:ragistration.ph }
            else{
              echo "<script> alert('The connection is succefull');
              window.location.href='ragistration.php';</script> ";
            }
        }
        else{
            ?>
            <script>alert("Password is not matching");</script>
            <?php
        }
    }
  }

  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
   
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
    <style  type="text/css">
      .google
      {
        width:300px;
        height:50px;
        background-color:#ff7f7f;
        border-radius:35px;
        font-size:25px;
        font-family:ubuntu;
       


      }

    </style>
  </head>

 <body>
   
 
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="index.php" class="sign-in-form" method="post">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" id="username" placeholder="Username"  required="required" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name ="password" id="password" placeholder="Password"  required="required" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p>OR</p>
            <br/>
            <?php
   
    echo '<div   align="center"><button class="google">'.$login_button . '</button></div>';
   
   ?>
            <div style="margin-top:20px">
              <p> Not rembember then
               <a style="text-decoration:none"href="forget.php">Click forget password ?</a></p>
               </div>
           
             
               
 
     
          </form>
          <form action="ragistration.php" class="sign-up-form" method="post">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text"  name ="username" id="username" placeholder="Username" required="required" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password"  placeholder="Password"   required="required"  />
              <span id = "message" style="color:red"> </span> <br><br>  
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name ="cpassword" id="cpassword" placeholder="cpassword"   required="required"  />
            </div>
            <input type="submit" class="btn" value="Sign up" />
         
        
   
  
           
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
