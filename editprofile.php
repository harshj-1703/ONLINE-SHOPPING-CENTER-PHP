<?php
session_start();
if(!isset($_SESSION['fname']))
{
    header('location:./login.php');
}

include './connect.php';
$email=$_SESSION['email'];

$sql1 = "select *from login where email = '$email' and status='1'";  
$result = mysqli_query($conn, $sql1);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$gender = $row['gender'];

if(isset($_POST['submit']))
{ 
    $fname = $_POST["ufname"];
    $mname = $_POST["umname"];
    $lname = $_POST["ulname"];
    $birthdate = $_POST["ubirthdate"];
    $gender = $_POST["ugender"];
    $address = $_POST["uaddress"];
    $country = $_POST["ucountry"];
    $state = $_POST["ustate"];
    $city = $_POST["ucity"];
    $pincode = $_POST["upincode"];

        $sql = "UPDATE login SET fname='$fname',mname='$mname',lname='$lname',
        birthdate='$birthdate',gender='$gender',address='$address',country='$country',
        state='$state',city='$city',pincode='$pincode' WHERE email='$email'";
         
        $query = mysqli_query($conn,$sql);
        
        $funame = $fname;
        $_SESSION['fname'] = $funame;
        $luname = $lname;
        $_SESSION['lname'] = $luname;
        echo "<script>window.alert('YOUR DETAIL IS UPDATED');
        window.location.replace('./editprofile.php');</script>";
            
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
    <title>ONLINE SHOPPING UPDATE PROFILE</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/editprofile.css">
    <!-- <script src="./JS/validinput.js"></script> -->
</head>
<body >
    <table border="0"  cellspacing="5" cellpadding="5">
        <tr>
            <th>
                    <u><h1 id="head">ONLINE SHOPPING UPDATE PROFILE</h1></u>
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
    </table>
    <form name="registrationform" method="post" action="./editprofile.php" enctype="multipart/form-data">
        <table border="0"  cellspacing="10" cellpadding="10">
            <tr>
                <td>
                   <b> <label id="l1" >FIRST NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t1" size="25" class="ip" name="ufname" value="<?php echo $row['fname'];?>" required/>
                </td>
                <td>
                    <b><label id="l2">MIDDLE NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t2" size="25" class="ip" name="umname" value="<?php echo $row['mname'];?>" required/>
                </td>
                <td>
                    <b><label id="l3">LAST NAME : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" maxlength="25" minlength="1" id="t3" size="25" class="ip" name="ulname" value="<?php echo $row['lname'];?>" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <b><label for="l4">YOUR BIRTH-DATE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="date" id="t4" class="ip" name="ubirthdate" value="<?php echo $row['birthdate'];?>" required/>
                </td>
                <td>
                    <b><label for="l5">GENDER :   </label></b>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="MF">MALE</label><input type="radio" id="t5" name="ugender" value="MALE" <?php if($gender=="MALE")
                    {
                        echo "checked='checked'";
                    }?>>
                    <label class="'MF">FEMALE</label><input type="radio" id="t5" name="ugender" value="FEMALE" <?php if($gender=="FEMALE")
                    {
                        echo "checked='checked'";
                    }?>>
                    <label class="'MF">OTHER</label><input type="radio" id="t5" name="ugender" value="OTHER" <?php if($gender=="OTHER")
                    {
                        echo "checked='checked'";
                    }?>>
                </td>
            </tr>
            <tr>
                <td>
                    <b><label id="l6">MOBILE NO. 1 : </label></b>&nbsp;&nbsp;&nbsp;
                    <label class="lemail"><?php echo $row['mo1'];?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <b><label id="l7">EMAIL-ID : </label></b>&nbsp;&nbsp;&nbsp;
                    <label class="lemail"><?php echo $row['email'];?></label>
                </td>
            </tr>
        </table>
        <table border="0"  cellspacing="10" cellpadding="10">
            <tr>
                <td>
                    <b><label id="l8">ADDRESS : </label></b><br><br>
                    <textarea rows="4" cols="80" id="t8" name="uaddress" maxlength="150" minlength="8" required><?php echo $row['address'];?></textarea>
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
                    <input type="text" id="t9" maxlength="25" minlength="2" size="25" class="ip" name="ucountry" value="<?php echo $row['country'];?>" required/>
                </td>
                <td>
                    <b><label id="l10">STATE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t10" maxlength="25" minlength="2" size="25" class="ip" name="ustate" value="<?php echo $row['state'];?>" required/>
                </td>
            </tr>
                <tr>
                <td>
                    <b><label id="l11">CITY : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="text" id="t11" maxlength="25" minlength="2" size="25" class="ip" name="ucity" value="<?php echo $row['city'];?>" required/>
                </td>
                <td>
                    <b><label id="l12">POSTAL CODE : </label></b>&nbsp;&nbsp;&nbsp;
                    <input type="number" id="t12" maxlength="12" class="ip" name="upincode" value="<?php echo $row['pincode'];?>" required/>
                </td>
            </tr>
            </table>
        <table>
            <tr>
                <td>
                    &emsp;<button type="submit" id="submit1" value="SUBMIT" class="button" name="submit" >UPDATE</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                </td>
                <td>
                <input type="reset" value="RESET" class="button">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                </td>
            </form>
        <form method="post" action="./editprofile.php">
        <td>
        <button type="submit" id="submit1" value="home" class="button" name="home" >HOME</button>
        </td>        
        </form>
        </tr>
        </table>
</body>
</html>
