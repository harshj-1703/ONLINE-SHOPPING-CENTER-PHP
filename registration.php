<?php

include './connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once("./email/PHPMailer.php");
require_once("./email/SMTP.php");
require_once("./email/Exception.php");

if(isset($_POST['submit']))
    { 
        $fname = $_POST["fname"];
        $mname = $_POST["mname"];
        $lname = $_POST["lname"];
        $birthdate = $_POST["birthdate"];
        $gender = $_POST["gender"];
        $mo1 = $_POST["mo1"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $country = $_POST["country"];
        $state = $_POST["state"];
        $city = $_POST["city"];
        $pincode = $_POST["pincode"];


        $target_dir = "./imges/profile/";
        $pname = rand(100,10000)."-".chr(rand(65,90))."-".chr(rand(97,122))."-".basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $pname;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $mail = new PHPMailer(true);

        $check_email = mysqli_query($conn, "SELECT email FROM login where email = '$email' and status='1'");
        $check_emailold = mysqli_query($conn, "SELECT email FROM login where email = '$email' and status='0'");
        $check_mo1 = mysqli_query($conn, "SELECT mo1 FROM login where mo1 = '$mo1' and status='1'");
        $check_mo1old = mysqli_query($conn, "SELECT mo1 FROM login where mo1 = '$mo1' and status='0'");
        if(mysqli_num_rows($check_emailold) > 0){
            $sql = "UPDATE LOGIN SET fname='$fname',lname='$lname',mname='$mname',birthdate='$birthdate',
            gender='$gender',mo1='$mo1',password='$password',address='$address',
            country='$country',state='$state',city='$city',pincode='$pincode',status='1'
            WHERE email='$email'";
             
            $query = mysqli_query($conn,$sql);
            header('location:./login.php');
        }
        else if(mysqli_num_rows($check_mo1old) > 0){
            $sql = "UPDATE LOGIN SET fname='$fname',lname='$lname',mname='$mname',birthdate='$birthdate',
            gender='$gender',email='$email',password='$password',address='$address',country='$country',
            state='$state',city='$city',pincode='$pincode',status='1'
            WHERE mo1='$mo1'";
             
            $query = mysqli_query($conn,$sql);
            header('location:./login.php');
        }
        else if(mysqli_num_rows($check_email) > 0){
            echo '<script>alert("EMAIL ALREADY EXISTS");
            window.location.replace("./registration.php");</script>';
        }
        else if(mysqli_num_rows($check_mo1) > 0){
            echo '<script>alert("MOBILE NUMBER ALREADY EXISTS");
            window.location.replace("./registration.php");</script>';
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType && "gif")
        {
            echo '<script>alert("FILE FORMET ONLY jpg,jpeg,png and gif.");
            window.location.replace("./registration.php");</script>';
        }
        else if($_FILES["file"]["size"] > 1992294)
        {
            echo '<script>alert("FILE SIZE ONLY LESS THEN 2 MB.");
            window.location.replace("./registration.php");</script>';
        }
        else if($password == $cpassword)
        {
            $sql = "INSERT INTO login(`fname`,`mname`,`lname`,`birthdate`,`gender`,`mo1`,
            `password`,`email`,`address`,`country`,`state`,`city`,`pincode`,`image`)
            VALUES('$fname','$mname','$lname','$birthdate','$gender','$mo1',
            '$password','$email','$address','$country','$state','$city','$pincode','$pname')";
             
            $query = mysqli_query($conn,$sql);
            
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
                $mail->Subject = "YOUR REGISTRATION";
                $mail->Body = 'HI '.$fname.' '.$lname. ',<br><br><p align="center"> YOUR CUSTOMER LOGIN SUCCESSFULL WAS WITH EMAIL <b>' .$email. '</b>.<br> 
                NOW YOU CAN LOGIN WITH THIS EMAIL.<br>KEEP IT SAFE.<br></p><div align="right">THANK YOU FOR YOUR REGISTRATION.</div>';
                $mail->AltBody = '';
            
                $mail->SMTPDebug  = 0;
                $mail->send();
                header('location:./login.php');
                }
                catch (Exception $e) {
                    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
                
                //move upload file
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        }
                
        else{
            //header('location:./registration.php?error=PASSWORD DOES NOT MATCH');
            echo '<script>alert("PASSWORD DOES NOT MATCH");
            window.location.replace("./registration.php");</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SHOPPING REGISTRATION</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/registration.css">
    <!-- <script src="./JS/validinput.js"></script> -->
</head>
<body >
    <table border="0"  cellspacing="10" cellpadding="10">
        <tr>
            <th>
                    <u><h1 id="head">ONLINE SHOPPING REGISTRATION</h1></u>
            </th>
            <td>
                <img src="./imges/1.png" height="110" width="120">
            </td>
        </tr>
    </table>
    <form name="registrationform" method="post" action="./registration.php" enctype="multipart/form-data">
        <table border="0"  cellspacing="10" cellpadding="10">
            <tr>
                <td>
                   <b> <label id="l1" >FIRST NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t1" size="25" class="ip" name="fname" required/>
                </td>
                <td>
                    <b><label id="l2">MIDDLE NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t2" size="25" class="ip" name="mname" required/>
                </td>
                <td>
                    <b><label id="l3">LAST NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t3" size="25" class="ip" name="lname" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <b><label for="l4">YOUR BIRTH-DATE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="date" id="t4" class="ip" name="birthdate" value="2021-01-01" required/>
                </td>
                <td>
                    <b><label for="l5">GENDER :   </label></b>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="MF">MALE</label><input type="radio" id="t5" name="gender" value="MALE" checked="checked">
                    <label class="'MF">FEMALE</label><input type="radio" id="t5" name="gender" value="FEMALE">
                    <label class="'MF">OTHER</label><input type="radio" id="t5" name="gender" value="OTHER">
                </td>
            </tr>
            <tr>
                <td>
                    <b><label id="l6">MOBILE NO. 1 : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t6" minlength="10" maxlength="10" size="11" pattern="[0-9]+" class="ip" name="mo1" required/>
                </td>
                <td>
                    <b><label id="l6">PASSWORD: </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="password" id="t62" minlength="8" maxlength="20" size="11" class="ip" name="password" required/>
                </td>
                
            </tr>
            <tr>
            <td>
                    <b><label id="l6">CONFORM PASSWORD: </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="password" id="t61" minlength="8" maxlength="20" size="11" class="ip" name="cpassword" required/>
                </td>
                <td>
                    <b><label id="l7">EMAIL-ID : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="email" id="t7" class="ip" name="email" maxlength="50" required/>
                </td>
            </tr>
        </table>
        <table border="0"  cellspacing="10" cellpadding="10">
            <tr>
                <td>
                    <b><label id="l8">ADDRESS : </label></b><br><br>
                    <textarea rows="4" cols="80" id="t8" name="address" maxlength="150" minlength="8" required>address</textarea>
                </td>
                <td>
                    <img src="./imges/2.png" height="120" width="120">
                </td>
            </tr>
        </table>
        <table border="0"  cellspacing="10" cellpadding="10">
            <tr>
                <td>
                    <b><label id="l9">COUNTRY : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t9" maxlength="25" minlength="2" size="25" class="ip" name="country" required/>
                </td>
                <td>
                    <b><label id="l10">STATE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t10" maxlength="25" minlength="2" size="25" class="ip" name="state" required/>
                </td>
            </tr>
                <tr>
                <td>
                    <b><label id="l11">CITY : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t11" maxlength="25" minlength="2" size="25" class="ip" name="city" required/>
                </td>
                <td>
                    <b><label id="l12">POSTAL CODE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="number" id="t12" maxlength="12" class="ip" name="pincode" required/>
                </td>
            </tr><tr>
            <td>
                <b><label id="l12">UPLOAD PROFILE PHOTO : </label></b>&nbsp;&nbsp;&nbsp;
                <input type="file" id="t12" name="file" required="">
            </td></tr>
           
            </table>
        <table>
            <tr>
                <td>
                    &emsp;<button type="submit" id="submit1" value="SUBMIT" class="button" name="submit" >SUBMIT</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                </td>
                <td>
                <input type="reset" value="RESET" class="button">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>