<?php session_start();
include './connect.php';
// $select = 0;
// if(isset($_GET['filter']))
// {
//     $select = $_GET["select"];
//     // echo $select;
// }
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
    <form>
    <table>
        <tr>
            <td>
                <h1 id="loginh1">ONLINE SHOPPING CENTER</h1>
            </td>
            <td>
                <img src="./imges/1.png" height="90" width="90">
            </td>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            <td>
                <a href="./registration.php" style="text-decoration: none;"><label  class="loginlabels"  id="newuser">New Customer?</label></a>
            </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
                <a href="./seller/sellerregistration.php" style="text-decoration: none;"><label  class="loginlabels"  id="newuser">New Seller?</label></a>
            </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            <a href="./login.php"  style="text-decoration: none;"><label class="loginlabels"  id="login" value="LOGIN">LOGIN</label></a>
        </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            <a href="./seller/index.php"  style="text-decoration: none;"><label class="loginlabels"  id="login" value="LOGIN">LOGIN AS SELLER</label></a>
        </td>
        <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td>
            <a href="./admin/adminlogin.php"  style="text-decoration: none;"><label class="loginlabels"  id="login" value="LOGIN">LOGIN AS ADMIN</label></a>
        </td>
        <td>
            <?php 
            // if(!isset($_SESSION['fname']))
            // {
            //     header('location:./index.php');
            // }?>
        </tr>
        <!-- <form method="get" action="./index.php">
        <tr>
            <td>SORT BY PRICE : &nbsp;&nbsp;
                <select id="select" name="select">
                <option value="none">none</option>
                <option value="lowtohigh">LOW TO HIGH</option>
                <option value="hightolow">HIGH TO LOW</option></select>
                &nbsp;&nbsp;
                <button type="submit" id="submit1" class="button" name="filter" >FILTER</button>
            </td>
        </tr>
        </form> -->
    </table>
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


    // if($select=="0" || $select=="none")
    // {
$sql = "SELECT * FROM product where status='1' and quantity >= '1' order by id desc LIMIT $initial_page,$limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table class='table2'><tr> <th>IMAGE</th><th>PRODUCT NAME</th><th>PRICE</th><th colspan='2'>DETAIL</th> </tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr id='tr1'><td id='td1'><img src='./imges/product/".$row['imgurl']."' class='lap'></td><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
      .$row['detail']."</td><td id='td1'><button id='BUY' class='glow-on-hover' onclick=location.href='./dashboard.php?BUY=".$row["id"]."'>BUY</button></td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
?><br><table id="linktable"><tr id="linktr"><td id="linktd"><?php
for($page_number = 1; $page_number<= $total_pages; $page_number++) {
  echo '<button id="linkbutton"><a href = "./index.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;';  
}
// }

// else if($select=="lowtohigh"){
//     $sql = "SELECT * FROM product where status='1' order by price LIMIT $initial_page,$limit";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         echo "<table class='table2'><tr> <th>IMAGE</th><th>PRODUCT NAME</th><th>PRICE</th><th>DETAIL</th> </tr>";
//         while($row = $result->fetch_assoc()) {
//           echo "<tr id='tr1'><td id='td1'><img src='./imges/product/".$row['imgurl']."' class='lap'></td><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
//           .$row['detail']."</td><td id='td1'><button id='BUY' class='glow-on-hover ' onclick=location.href='./dashboard.php?BUY=".$row["id"]."'>BUY</button></td></tr>";
//         }
//         echo "</table>";
//       } else {
//         echo "0 results";
//       }
//     ?><!--<br><table id="linktable"><tr id="linktr"><td id="linktd">--><?php
//     for($page_number = 1; $page_number<= $total_pages; $page_number++) {
//       echo '<button id="linkbutton"><a href = "./index.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;'; }
    
// }

// else if($select=="hightolow"){
//     $sql = "SELECT * FROM product where status='1' order by price DESC LIMIT $initial_page,$limit";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         echo "<table class='table2'><tr> <th>IMAGE</th><th>PRODUCT NAME</th><th>PRICE</th><th>DETAIL</th> </tr>";
//         while($row = $result->fetch_assoc()) {
//           echo "<tr id='tr1'><td id='td1'><img src='./imges/product/".$row['imgurl']."' class='lap'></td><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
//           .$row['detail']."</td><td id='td1'><button id='BUY' class='glow-on-hover ' onclick=location.href='./dashboard.php?BUY=".$row["id"]."'>BUY</button></td></tr>";
//         }
//         echo "</table>";
//       } else {
//         echo "0 results";
//       }
//     ?><!--<br><table id="linktable"><tr id="linktr"><td id="linktd">--><?php
//     for($page_number = 1; $page_number<= $total_pages; $page_number++) {
//       echo '<button id="linkbutton"><a href = "./index.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;'; }
    
// }
?>
</td></tr></table>
<br>
    <table>
        <tr>
            <h1 id="na"><u>PLEASE LOGIN FOR PURCHASE PRODUCTS</h1></u></h1>
        </tr><br><br>
        <tr>
            <h1 id="na"><u>PLEASE LOGIN WITH ADMIN FOR SHOW DETAILS</h1></u></h1>
        </tr>
    </table>
</form>
</body>
</html>