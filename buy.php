<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUY AN ITEM-PAGE</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/buy.css">
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
            </td><td class="td1">
            <form action="./pay.php" method="post">
                <input type="hidden" value="<?php echo $_SESSION['pname'];?>" name="item_name">
                <input type="hidden" name="item_description" value="<?php echo $_SESSION['detail'];?>">
                <input type="hidden" name="item_number" value="<?php echo $_SESSION['id'];?>">
                <input type="hidden" name="amount" value="<?php echo $_SESSION['price'];?>">
                <h2 id="na">PURCHASE THIS PRODUCT CLICK ON BUY NOW</h2>
                <input type="hidden" name="address" value="<?php echo $_SESSION['address'];?>">
                <input type="hidden" name="currency" value="INR">	
                <input type="hidden" name="cust_name" value="<?php echo $_SESSION['fname'];?>">								
                <input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>">	
                <input type="hidden" name="contact" value="<?php echo $_SESSION['mono'];?>"></td>
            </tr><tr><td class="td1"><h1 id="na2"> <?php echo $_SESSION['price']."  INR"; ?> </h1>&nbsp;</td>
                <td class="td1" id="tdbuy">
                <input type="submit" class="buybutton" value="Buy Now">
            </td>
        </form>
        </tr>
    </table>
    <br><br>
    <form action="./logout.php" method="post">
    <button class="buybutton"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
    </form>
</body>
</html>