<?php session_start();
include '../connect.php';

if(isset($_POST['submit']))
    { 
        $productname = $_POST["pname"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $detail = $_POST["detail"];
        
        if($quantity <= 0 || $price <=0)
        {
            echo "<script>alert('QUANTITY OR PRICE MUST BE IN POSITIVE OR NONE ZERO.');
            window.location.replace('./sellerdashboard.php');</script>";            
        }
        else{
            $target_dir = "../imges/product/";
            $pname = rand(100,10000)."-".chr(rand(65,90))."-".chr(rand(97,122))."-".basename($_FILES["file"]["name"]);
            $target_file = $target_dir . $pname;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType && "gif")
            {
                echo '<script>alert("FILE FORMET ONLY jpg,jpeg,png and gif.")</script>';
            }
            else if($_FILES["file"]["size"] > 1992294)
            {
                echo "<script>alert('FILE SIZE ONLY LESS THEN 2 MB.');
                window.location.replace('./sellerdashboard.php');</script>";
            }
            else{
            $sql = "INSERT INTO product(`pname`,`price`,`quantity`,`detail`,`imgurl`)
                VALUES('$productname','$price','$quantity','$detail','$pname')";
                 
                $query = mysqli_query($conn,$sql);
    
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    
                // header('location:./sellerdashboard.php');
                echo "<script>window.alert('YOUR PRODUCT IS ADDED');
                         window.location.replace('./sellerdashboard.php');</script>";
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SELLING HOME-PAGE</title>
    <link rel="icon" href="../imges/3.png">
    <link rel="stylesheet" href="./CSS/sellerdashboard.css">
</head>
<body>
    <form action="./changepassword.php" method="post">
    <table>
        <tr>
            <td>
                <h1 id="loginh1">ONLINE SELLING CENTER</h1>
            </td>
            <td>
                <img src="../imges/1.png" height="90" width="90">
            </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            <?php 
            if(!isset($_SESSION['fname']))
            {
                header('location:./index.php');
            }?>
            <?php 
            if(isset($_SESSION['fname']))
            {?>
                <h2 id="na"> <?php echo $_SESSION['fname']; ?> </h2></td> <td>&nbsp;</td>
                <td><h2 id="na"> <?php echo $_SESSION['lname']; ?> </h2></td><td>&nbsp;&nbsp;</td>
                <td><img src="../imges/sellerprofile/<?php echo $_SESSION['profileimage']?>" id="profilephoto"></td>
            <?php } ?> 
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>

            <td>
                <button class="glow-on-hover"  id="login" value="changepassword" name="changepassword">CHANGE PASSWORD</button>
            </td>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></form><form action="./editsellerprofile.php" method="post">
        <td>
                <button class="glow-on-hover"  id="login" value="changepassword" name="changepassword">EDIT PROFILE</button>
            </td>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></form>
        <form action="./editsellerphoto.php" method="post">
        <td>
                <button class="glow-on-hover"  id="login" value="changepassword" name="changepassword">EDIT PHOTO</button>
            </td>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></form>
        </tr>
    </table><br><br><br><form action="./sellerdashboard.php" method="post" enctype="multipart/form-data">
    <table border="0"  cellspacing="10" cellpadding="10" id="formtable">
            <tr>
                <td>
                   <b> <label id="l1" >PRODUCT NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t1" size="25" class="ip" name="pname" required/>
                </td>
            </tr>
            <tr>
                <td>
                   <b> <label id="l1" >PRICE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="number" maxlength="25" minlength="1" id="t1" size="25" class="ip" name="price" required/>
                </td>
            </tr>
            <tr>
                <td>
                   <b> <label id="l1" >QUANTITY : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="number" maxlength="15" minlength="1" id="t1" size="25" class="ip" name="quantity" required/>
                </td>
            </tr>
            <tr>
                <td>
                   <b> <label id="l1" >DETAIL : </label></b>&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
            <td>
                <textarea rows="4" cols="80" id="t8" name="detail" maxlength="150" minlength="8" required></textarea>
            </td>
            </tr>
            <tr>
            <td>
                <b><label id="l12">UPLOAD PRODUCT PHOTO : </label></b>&nbsp;&nbsp;&nbsp;
                <input type="file" id="fileUpload" class="custom-file-input" name="file" required="">
            </td></tr>
            <tr>
                <td><button type="submit" id="submit1" value="SUBMIT" class="button" name="submit" >SUBMIT</button></td>
            </tr>
    </table>        
<br><br></form>
<form action="../logout.php" method="post">
<td>
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
</td></form>
</body>
</html>