<?php session_start();
if(!isset($_SESSION['fname']))
{
    header('location:./adminlogin.php');
}
include '../connect.php';

if(isset($_POST['logindetail']) && isset($_SESSION['fname']))
{
    header("Location: ./admintable1.php");
}
if(isset($_POST['productdetail']) && isset($_SESSION['fname']))
{
    header("Location: ./admintable2.php");
}
if(isset($_POST['sellerdetail']) && isset($_SESSION['fname']))
{
    header("Location: ./admintable3.php");
}
if(isset($_POST['productanalysis']) && isset($_SESSION['fname']))
{
    header("Location: ./analysis.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SHOPPING HOME-PAGE</title>
    <link rel="icon" href="../imges/3.png">
    <link rel="stylesheet" href="./CSS/adminchoice.css">
</head>
<body>
<table>
        <tr>
        <td>
                <h1 id="loginh1">ONLINE SHOPPING CENTER</h1>
            </td>
            <td>
                <img src="../imges/1.png" height="90" width="90">
            </td>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        <td>
            <?php 
            if(!isset($_SESSION['fname']))
            {
                header('location:./adminlogin.php');
            }?>
            <?php 
            if(isset($_SESSION['fname']))
            {?>
                <h2 id="na"> <?php echo $_SESSION['fname']; ?> </h2></td> <td>&nbsp;</td>
                <td><h2 id="na"> <?php echo $_SESSION['lname']; ?> </h2></td><td>&nbsp;&nbsp;</td>
                <td><img src="../imges/adminprofile/<?php echo $_SESSION['profileimage']?>" id="profilephoto"></td>
            <?php } ?> <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
            <form  action="./editadminprofile.php" method="post">
            <!--  -->
            <td>
                <button class="glow-on-hover1"  id="login" value="editprofile" name="editprofile">EDIT PROFILE</button>
            </td><td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></form>
        <form  action="./editadminphoto.php" method="post">
            <!--  -->
            <td>
                <button class="glow-on-hover1"  id="login" value="editprofile" name="editprofile">EDIT PHOTO</button>
            </td>
        </tr>
        </form>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
            </tr></table>
            <table id="tr1">
            <tr>
                <td>
                <form action="./index.php" method="post">
                <button class="glow-on-hover"  id="login" value="changepassword" name="logindetail">CUSTOMER LOGIN DETAILS</button>
                </form>
                </td>
            </tr>
            <tr>
                <td>
                <form action="./index.php" method="post">
                <button class="glow-on-hover"  id="login" value="changepassword" name="sellerdetail">SELLER DETAILS</button>
                </form>
                </td>
            </tr>
            <tr>
                <td>
                <form action="./index.php" method="post">
                <button class="glow-on-hover"  id="login" value="changepassword" name="productdetail">PRODUCT DETAILS</button>
                </form>
                </td>
            <tr>
                <td>
                <form action="./index.php" method="post">
                <button class="glow-on-hover"  id="login" value="productanalysis" name="productanalysis">PRODUCT ANALYSIS</button>
               </form>
               </td>
            </tr>
            </tr>
            <tr>
                <td>
                <form action="./adminchangepassword.php" method="post">
                <button class="glow-on-hover"  id="login" value="changepassword" name="productdetail">CHANGE PASSWORD</button>
                </form>
                </td>
            </tr>
            <form action="../logout.php" method="post">
            <td>
            <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
            </td></form>
            </table>
</body>
</html>