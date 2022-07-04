<?php session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCT-PAGE</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/productpage.css">
</head>
<body>
    <table>
        <tr>
            <td>
                <h1 id="loginh1">ONLINE SHOPPING CENTER</h1>
            </td>
            <td>
                <img src="./imges/1.png" height="90" width="90">
            </td>
            <!-- <form action="./productpage.php" method="post"> -->
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td>

            </td>
            <td>
            <?php 
            if(!isset($_SESSION['fname']))
            {
                header('location:./login.php');
            }?>
            <?php 
            if(isset($_SESSION['fname']))
            {?>
                <h2 id="na"> <?php echo $_SESSION['fname']; ?> </h2></td> <td>&nbsp;</td>
                <td><h2 id="na"> <?php echo $_SESSION['lname']; ?> </h2><td>&nbsp;&nbsp;</td>
                <td><img src="./imges/profile/<?php echo $_SESSION['profileimage']?>" id="profilephoto"></td>
            <?php } ?> 
            </td>
        </tr>
    </table>
    <table id="table2">
            <td class="td1">
                <img src="./imges/product/<?php echo $_SESSION['imgurl']?>" class="lap"><br>
               
            </td>
            <td class="td1">
            <h1 id="na"> <?php echo $_SESSION['pname']; ?> </h1>&nbsp;
            <h2 id="na"> <?php echo $_SESSION['detail']; ?> </h2></td>
            <td><h1 id="na2"> <?php echo $_SESSION['price']."  INR"; ?> </h1>&nbsp;</td> <td>&nbsp;</td>
            </td>
        </tr>
        <tr><td class="buy" colspan="2"><form action="./buy.php" method="post">
            <button class="loginlabels"  id="login" value="BUY NOW" name="buynow">BUY NOW</button>
        </tr></td></form>
    </table>
    <br><br>
    <form action="./logout.php" method="post">
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
    </form>
</body>
</html>