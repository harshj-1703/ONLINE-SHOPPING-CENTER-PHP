<?php
session_start();
include '../connect.php';
if(isset($_POST['login']))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
        
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select *from admin where email = '$email' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            // echo "<h1><center> Login successful </center></h1>";
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['mono'] = $row['mo1'];
            $_SESSION['profileimage'] = $row['image'];
            header("Location: ./index.php");  
        }  
        else{  
           // header("Location: ./login.php ?error=PASSWORD DOES NOT MATCH");
            echo '<script>alert("PASSWORD DOES NOT MATCH");
            window.location.replace("./adminlogin.php");</script>';
        }     
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="icon" href="../imges/3.png">
    <link rel="stylesheet" href="./CSS/login.css">
</head>
<body>
    <marquee behavior="scroll" scrollamount="35"><h1 id="loginh1">ONLINE SHOPPING CENTER</h1><br></marquee>
    <div>
    <form method="post" action="./adminlogin.php">
        <table id="logintable">
            <tr>
                <label id="emaillabel" class="loginlabels">ADMIN EMAIL ID :&nbsp; </label>
            </tr>
            <br>
            <br>
            <tr>
                <input type="email" id="emailinput" class="logininput" name="email" required/>
            </tr>
            <br><br><br>
            <tr>
                <label id="passwordlabel" class="loginlabels" >PASSWORD :&nbsp; </label>
            </tr>
            <br>
            <br>
            <tr>
                <input type="password" id="passwordinput" maxlength="20" minlength="8" class="logininput" name="password" required/>
                
            </tr>
            <br><br><br>
            <tr>
                <a href="./adminforgotpassword.php" id="forgotlink" class="loginlinks">Forgot Password?</a>
            </tr>
            <br><br>
            <tr>
                <button id="login" class="glow-on-hover" value="LOGIN" name="login">LOGIN</button>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>