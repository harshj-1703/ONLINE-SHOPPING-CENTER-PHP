<?php session_start();
include './connect.php';

if(isset($_GET['BUY']))
{
    $id = $_GET["BUY"];
    $sql = "select * from product where id = '$id'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            $_SESSION['pname'] = $row['pname'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['detail'] = $row['detail'];
            $_SESSION['price'] = $row['price'];
            $_SESSION['quantity'] = $row['quantity'];
            $_SESSION['imgurl'] = $row['imgurl'];
            header("Location: ./productpage.php");
        }  
        else{  
            echo '<script>alert("ERROR 404")</script>';
        }
}
if(isset($_GET['ADDTOCART']))
{
    $id = $_GET["ADDTOCART"];
    $sql = "select * from product where id = '$id'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);

        if($count == 1){  
            // $_SESSION['pname'] = $row['pname'];
            // $_SESSION['id'] = $row['id'];
            // $_SESSION['detail'] = $row['detail'];
            // $_SESSION['price'] = $row['price'];
            // $_SESSION['quantity'] = $row['quantity'];
            // $_SESSION['imgurl'] = $row['imgurl'];

            $_SESSION['cart'][$id] = $row['id'];
            // echo $_SESSION['cart'][$id];


            // header("Location: ./productpage.php");
        }  
        else{  
            echo '<script>alert("ERROR 404")</script>';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINE SHOPPING HOME-PAGE</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/dashboard.css">
</head>
<body>
    <form action="./changepassword.php" method="post">
    <table>
        <tr>
            <td>
                <h1 id="loginh1">ONLINE SHOPPING CENTER</h1>
            </td>
            <td>
                <img src="./imges/1.png" height="90" width="90">
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
                header('location:./login.php');
            }?>
            <?php 
            if(isset($_SESSION['fname']))
            {?>
                <h2 id="na"> <?php echo $_SESSION['fname']; ?> </h2></td> <td>&nbsp;</td>
                <td><h2 id="na"> <?php echo $_SESSION['lname']; ?> </h2></td><td>&nbsp;&nbsp;</td>
                <td><img src="./imges/profile/<?php echo $_SESSION['profileimage']?>" id="profilephoto"></td>
            <?php } ?> 
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        
            <!--  -->
            <td>
                <button class="glow-on-hover"  id="login" value="changepassword" name="changepassword">CHANGE PASSWORD</button>
            </td>
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
            </form><form  action="./editprofile.php" method="post">
            <!--  -->
            <td>
                <button class="glow-on-hover"  id="login" value="editprofile" name="editprofile">EDIT PROFILE</button>
            </td><td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td></form>
        <form  action="./editphoto.php" method="post">
            <!--  -->
            <td>
                <button class="glow-on-hover"  id="login" value="editprofile" name="editprofile">EDIT PHOTO</button>
            </td><td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        </form>
        <form  action="./cart.php" method="post">
            <!--  -->
            <td>
                <button class="glow-on-hover"  id="login" value="editprofile" name="cart">CART</button>
            </td>
        </tr>
        </form>
    </table></form><form action="./dashboard.php" method="post">
    <table>
        <tr>
            <h1 id="na"><u>NEW ARRIVELS</h1></u></h1>
        </tr>
    </table>
    <?php 
    
    $result1 = mysqli_query($conn,"SELECT * FROM product where status='1' and quantity >= '1' order by id desc");
    $limit = 5;
    $total_rows = mysqli_num_rows($result1);  
    $total_pages = ceil ($total_rows / $limit);

    if (!isset ($_GET['page']) ) { 
        $page_number = 1;  
    } else {  
        $page_number = $_GET['page'];      
    }    
    $initial_page = ($page_number-1) * $limit; 
    ?></form><?php
$sql = "SELECT * FROM product where status='1' and quantity >= '1' order by id desc LIMIT $initial_page,$limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='table2'><tr> <th>IMAGE</th><th>PRODUCT NAME</th><th>PRICE</th><th colspan='3'>DETAIL</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr id='tr1'><td id='td1'><img src='./imges/product/".$row['imgurl']."' class='lap'></td><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
      .$row['detail']."</td><td id='td1'><button id='BUY' class='glow-on-hover ' onclick=location.href='./dashboard.php?BUY=".$row["id"]."'>BUY</button></td>
      <td id='td1'><button id='BUY' class='glow-on-hover ' onclick=location.href='./dashboard.php?ADDTOCART=".$row["id"]."'>ADD TO CART</button></td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
?><br><table id="linktable"><tr id="linktr"><td id="linktd"><?php
for($page_number = 1; $page_number<= $total_pages; $page_number++) {
  echo '<button id="linkbutton"><a href = "./dashboard.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;';  
}?>
</td></tr></table>
<br><br>
<form action="./logout.php" method="post">
<td>
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
</td></form>
</body>
</html>