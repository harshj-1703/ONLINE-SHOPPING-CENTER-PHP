<?php
session_start();
include './connect.php';
if(!isset($_SESSION['fname']))
{
    header('location:./login.php');
}
$email=$_SESSION['email'];

if(isset($_POST['submit']))
{ 
    $target_dir = "./imges/profile/";
    $pname = rand(100,10000)."-".chr(rand(65,90))."-".chr(rand(97,122))."-".basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $pname;

    $sql = "UPDATE login SET image='$pname' WHERE email='$email'";

$query = mysqli_query($conn,$sql);        

//move upload file
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$profile = $pname;
$_SESSION['profileimage'] = $profile;
echo "<script>window.alert('YOUR DETAIL IS UPDATED');
        window.location.replace('./editphoto.php');</script>";
// header("Location: ./editphoto.php");

}
if(isset($_POST['home']))
{
header("Location: ./dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SHOPPING UPDATE PROFILE PHOTO</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/editphoto.css">
</head>
<body>
<table border="0" cellspacing="5" cellpadding="5">
        <tr>
            <th>
                <h1 id="head">ONLINE SHOPPING UPDATE PROFILE PHOTO</h1>
            </th>
            <td>
                <img src="./imges/1.png" height="110" width="120">
            </td><td>&nbsp;&nbsp;&nbsp;</td>
            <td>
            <?php 
            if(isset($_SESSION['fname']))
            {?>
                <h2 id="na"><?php echo $_SESSION['fname'];?></h2></td>
                <td><h2 id="na"><?php echo $_SESSION['lname'];?></h2></td>
                <td><img src="./imges/profile/<?php echo $_SESSION['profileimage']?>" id="profilephoto"></td>
            <?php } ?> 
        </tr>
    </table><br>
    <table id="maintable" cellspacing="5" cellpadding="5" style="text-align:center;">
    <tr>
        <td>
        <img src="./imges/profile/<?php echo $_SESSION['profileimage']?>" id="bigprofilephoto">
        </td>
    </tr>
    <tr><td>
    <form method="post" action="./editphoto.php" enctype="multipart/form-data">
    <table cellspacing="5" cellpadding="5" style="text-align:center;">
    <tr>
        <td>
        <b><label id="l12">UPLOAD PROFILE PHOTO : </label></b></td>
        <td><input type="file" class="custom-file-input" name="file" required="">
        </td>
    </tr>
    </table></td></tr><tr><td>
    <table cellspacing="5" cellpadding="5" style="text-align:center;">
    <tr>
    <td>
       <button type="submit" id="submit1" value="SUBMIT" class="button" name="submit" >UPDATE</button>
        </form></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
       <form method="post" action="./editphoto.php">
        <button type="submit" id="submit1" value="home" class="button" name="home">HOME</button>
        </td>  
    </tr>
    </table></form></td></tr>
    </table>
</body>
</html>