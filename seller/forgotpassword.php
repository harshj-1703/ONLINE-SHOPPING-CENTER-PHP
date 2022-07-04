<?php
// if(!isset($_SESSION['fname']))
// {
//     header('location:./login.php');
// }
include '../connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once("../email/PHPMailer.php");
require_once("../email/SMTP.php");
require_once("../email/Exception.php");

if(isset($_POST['email']))
{
session_start();
$email = $_POST["email"];
$mail = new PHPMailer(true);
$email = stripcslashes($email);  
$email = mysqli_real_escape_string($conn, $email);  
$sql = "select *from seller where email = '$email'";
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);
if($count == 1){  
    $_SESSION['fname'] = $row['fname'];
    $_SESSION['lname'] = $row['lname'];
    $_SESSION['password'] = $row['password'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $password = $_SESSION['password'];

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        $mail->Username = 'phptest1703@gmail.com'; // YOUR gmail email
        $mail->Password = 'phptest@1703phptest@1703'; // YOUR gmail password
    
        // Sender and recipient settings
        $mail->setFrom('phptest1703@gmail.com', 'HARSH JOLAPARA');
        $mail->addAddress($email, 'HIII DEAR CUSTOMER');
        $mail->addReplyTo('phptest1703@gmail.com', 'HARSH JOLAPARA'); // to set the reply to
    
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "YOUR PASSWORD";
        $mail->Body = 'HI '.$fname.' '.$lname. ',<br><br><p align="center"> YOUR SELLER LOGIN PASSWORD WAS <b>' .$password. '</b>.<br> 
        NOW LOGIN WITH THIS PASSWORD AND CHANGE YOUR PASSWORD.<br>KEEP IT SAFE.<br></p><div align="right">THANK YOU FOR YOUR SUPPORT.</div>';
        $mail->AltBody = '';
    
        $mail->SMTPDebug  = 0;
        $mail->send();
        $message = "Password To Your Email is Sent.";
        } 
        catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else{  
       // header("Location: ./login.php ?error=PASSWORD DOES NOT MATCH");
        echo '<script>alert("EMAIL NOT FOUND")</script>';
        }
}  
if(isset($_POST['home']))
{
    header("Location: ./sellerdashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMAIL FROGOT PASSWORD</title>
    <link rel="stylesheet" href="./CSS/forgotpassword.css">
    <link rel="icon" href="../imges/3.png">
</head>
<body>
    <form action="./forgotpassword.php" method="post">
    <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
        <table cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm" >
        <tr class="tableheader">
            <td colspan="2">FORGOT PASSWORD</td>
        </tr>
        <tr>
        <td><label id="l1">ENTER EMAIL :-  </label></td>
        <td><input type="email" name="email" id="i1" required/></td>
        </tr>
        <tr><td><input type="submit" value="SUBMIT" name="submit" id="button"></td></form>
        <form method="post" action="./forgotpassword.php">
        <td><button name="home" class="btnSubmit" id="button">Home</button></td>
        </form>
        </tr>
        </table>
</body>
</html>
