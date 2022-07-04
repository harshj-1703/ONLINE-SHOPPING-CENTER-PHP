<?php
include './connect.php';
require('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once("./email/PHPMailer.php");
require_once("./email/SMTP.php");
require_once("./email/Exception.php");

session_start();
if(!isset($_SESSION['fname']))
{
    header('location:./login.php');
}
$mail = new PHPMailer(true);

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    date_default_timezone_set("Asia/Calcutta");
    if(!isset($_SESSION['fname']))
    {
        header('location:./login.php');
    }

    if(isset($_SESSION['id']))
    {
    $id=$_SESSION['id'];
    $quantity=$_SESSION['quantity'];
    $quantity = $quantity-1;
    $upd = "UPDATE product SET quantity = '$quantity' where id= '$id'";
    $conn->query($upd);

    date_default_timezone_set("Asia/Calcutta");
    $pname = $_SESSION['pname'];
    $price = $_SESSION['price'];
    $image = $_SESSION['imgurl'];
    $customer = $_SESSION['fname']." ".$_SESSION['lname'];
    $date = date("y-m-d");
    $time = date("h:i:sa");

    $sql = "INSERT INTO analysis(`pname`,`price`,`image`,`customer`,`date`,`time`)
            VALUES('$pname','$price','$image','$customer','$date','$time')";
            
    $query = mysqli_query($conn,$sql);

    // unset($_SESSION['id']);

    }

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
        $mail->addAddress($_SESSION['email'], 'HIII DEAR CUSTOMER');
        $mail->addReplyTo('phptest1703@gmail.com', 'HARSH JOLAPARA'); // to set the reply to
        date_default_timezone_set("Asia/Calcutta");
        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "THANK YOU FOR PURCHASING";
        // $mail->Body = 'HI '.$_SESSION['fname'].' '.$_SESSION['lname'].',<br><br><p align="center"> THANK YOU FOR PURCHASING PRODUCT <b>' .$_SESSION['pname']. '</b>.<br> 
        // NOW DELIVARY OF YOUR PRODUCT WILL BE DONE IN TWO DAYS.<br></p><div align="right">THANK YOU FOR YOUR SUPPORT.COME AGAIN.</div>';
        $mail->Body = '<html>
        <body>
        <h3 style="color: blue;">HELLO, '.$_SESSION["fname"]." ".$_SESSION["lname"].',<br><br></h3>
        <table align="center" border="2" style="border:3px solid blue; border-radius:10px; background-color:yellow; text-align:center; font-size:22px;">
        <tr align="center" style="color:white; border-radius:10px; font-weight: bolder; background-color:#026CFF;">
        <td colspan="2">PRODUCT BILL</td>
        </tr>
        <tr>
            <td>NAME : </td>
            <td>'.$_SESSION["fname"]." ".$_SESSION["lname"].'</td>
        </tr>
        <tr>
            <td>PRODUCT NAME : </td>
            <td>'.$_SESSION['pname'].'</td>
        </tr>
        <tr>
            <td>PRODUCT PRICE(₹) : </td>
            <td>'.$_SESSION['price']. '</td>
        </tr>
        <tr>
        <td>SHIPPING ADDRESS : </td>
        <td>'.$_SESSION['address'].'</td>
        </tr>
        <tr>
        <td>PURCHASE DATE : </td>
        <td>'.date("d-m-y").'</td>
        </tr>
        <td>PURCHASE TIME : </td>
        <td>'.date("h:i:sa").'</td>
        </tr>
        </table>
        <h4 align="right" style="color:blue;">THANK YOU FOR PURCHASING PRODUCT.</h4>
        </body>
        </html>';
        $mail->AltBody = '';
    
        $mail->SMTPDebug  = 0;
        $mail->send();
     //    header('location:./login.php');
        }
        catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
        
        if(isset($_SESSION['cart']) && !isset($_SESSION['id']))
        {
            unset($_SESSION['cart']);
        }
    
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
             echo "<script>window.location.href='./success.php';</script>";

}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
