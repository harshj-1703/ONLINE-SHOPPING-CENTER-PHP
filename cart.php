<?php
session_start();
include './connect.php';
?>

<table>
        <tr>
            <td>
                <h1 id="loginh1">ONLINE SHOPPING CART</h1>
            </td>
            <td>
                <img src="./imges/1.png" height="100" width="100">
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
        </td></tr></table><br>

<?php
if(isset($_GET['REMOVE']) && isset($_SESSION['cart']))
{
    $id = $_GET["REMOVE"];
    $sql2 = "select * from product where id = '$id'";  
    $result2 = mysqli_query($conn, $sql2);  
    $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result2);  
          
        if($count == 1){  
            // $_SESSION['pname'] = $row['pname'];
            // $_SESSION['id'] = $row['id'];
            // $_SESSION['detail'] = $row['detail'];
            // $_SESSION['price'] = $row['price'];
            // $_SESSION['quantity'] = $row['quantity'];
            // $_SESSION['imgurl'] = $row['imgurl'];
            unset($_SESSION['cart'][$id]);
            // header("Location: ./productpage.php");
        }  
        else{  
            echo '<script>alert("ERROR 404")</script>';
        }
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart']))
{
  echo "<table><tr><td  style='background-color:blue; color:white; font-size:24px; font-weight:boder; border:2px solid white; border-radius:15px;'>NO ADDED ITEMS TO CART</td></tr></table><br><br>";
}
else{
$array = $_SESSION['cart']; 

// $array = array("24","26");

// foreach($array as $value){
//     echo $value . "<br>";
// }

// echo implode(',', $array);

// print_r($array);

$result1 = mysqli_query($conn,"SELECT * FROM product where status='1' and id IN(".implode(',', $array).")");
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
$sql = "SELECT * FROM product where status='1' and id IN(".implode(',', $array).") LIMIT $initial_page,$limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='table2'><tr> <th>IMAGE</th><th>PRODUCT NAME</th><th>PRICE</th><th colspan='3'>DETAIL</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr id='tr1'><td id='td1'><img src='./imges/product/".$row['imgurl']."' class='lap'></td><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
      .$row['detail']."</td><td id='td1'><button id='BUY' class='glow-on-hover ' onclick=location.href='./cart.php?REMOVE=".$row["id"]."'>REMOVE</button></td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
?><br><table id="linktable"><tr id="linktr"><td id="linktd"><?php
for($page_number = 1; $page_number<= $total_pages; $page_number++) {
  echo '<button id="linkbutton"><a href = "./cart.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;';  
}

$sql3 = "SELECT sum(price) as totalprice FROM product where id IN(".implode(',', $array).")";
$result3 = mysqli_query($conn, $sql3);  
$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);  
$count3 = mysqli_num_rows($result3);

if($count3 > 0)
{
  
  $_SESSION['price'] = $row3['totalprice'];
  $_SESSION['pname'] = "ALL CART ITEMS";
  // echo $row3['totalprice'];
  ?><br><br><table><tr><td style="background-color:blue; font-weight:bolder; font-size:24px; color:white; border:2px solid white; border-radius:20px;">TOTAL PRICE : <?php echo $row3['totalprice']?> RUPEES</td>
  <form method="post" action="./paycart.php">
  <td><button type="submit" value="submit" class="glow-on-hover"  id="login">CHECKOUT</button></form></td><?php }}?>
  <form action="./dashboard.php" method="post"><td><button type="submit" value="submit" class="glow-on-hover"  id="login">HOME</button></form></td></tr></table>
  
  <br><br>
<form action="./logout.php" method="post">
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
</form>
  <?php
  
?>

</td></tr></table>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
    <link rel="stylesheet" href="./CSS/dashboard.css">
    <link rel="icon" href="./imges/3.png">
</head>
<body>
    
</body>
</html>