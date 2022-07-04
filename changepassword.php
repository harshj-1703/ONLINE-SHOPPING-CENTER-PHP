<?php
session_start();
if(!isset($_SESSION['fname']))
 {
     header('location:./login.php');
 }
if(isset($_POST['submit']))
{
    // $_SESSION['email'] = $email;
    include './connect.php';
    if (count($_POST) > 0) {
        $result = mysqli_query($conn, "SELECT *from login WHERE email='" . $_SESSION['email'] . "'");
        $row = mysqli_fetch_array($result , MYSQLI_ASSOC);
        if (($_POST["currentPassword"] == $row["password"])  && $_POST["newPassword"]==$_POST["confirmPassword"]) {
            mysqli_query($conn, "UPDATE login set password='" . $_POST["newPassword"] . "' WHERE email='" . $_SESSION["email"] . "'");
            $message = "Password Changed";
            //  header("Location: ./dashboard.php");
        } else
            $message = "Current Password is not correct";
    }
}
if(isset($_POST['home']))
{
    header("Location: ./dashboard.php");
}
?>
<html>
<head>
<title>CHANGE PASSWORD</title>
<link rel="stylesheet" type="text/css" href="./CSS/changepassword.css" />
<link rel="icon" href="./imges/3.png">
</head>
<body>
    <form name="frmChange" method="post" action="./changepassword.php">
        <div id="main"><br><br><br><br><br><br><br>
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
            <table cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="8">CHANGE PASSWORD</td>
                </tr>
                <tr>
                    <td><label>Current Password</label></td>
                    <td colspan="6"><input type="password"
                        name="currentPassword" class="txtField" maxlength="20" minlength="8" required/></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td colspan="6"><input type="password" name="newPassword"
                        class="txtField" maxlength="20" minlength="8" required/></td>
                </tr><tr>
                <td><label>Confirm Password</label></td>
                <td colspan="6"><input type="password" name="confirmPassword"
                    class="txtField" maxlength="20" minlength="8" required/></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"
                        value="Submit" class="btnSubmit"></td></form>
                        <form method="post" action="./changepassword.php">
                        <td><button name="home" class="btnSubmit" id="button">Home</button></td></form>
                    </tr>
                </table>
        </div>
    
</body>
</html>