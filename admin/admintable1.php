<?php
 session_start();
 include '../connect.php';
 if(!isset($_SESSION['fname']))
 {
     header('location:./adminlogin.php');
 }   
 if(isset($_GET["delete"]))
 {
    $id = $_GET["delete"];
    $upd = "UPDATE login SET status = '0' WHERE email = '$id'";
    $conn->query($upd);
 }
 if(isset($_POST["home"]))
 {
  header('location:./index.php');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
 <title>ALL LOGIN DETAILS</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" href="../imges/3.png">
 <link rel="stylesheet" href="./CSS/admintable1.css">
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
            <?php } ?> 
            <td>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        </tr></table><br><br>
        <?php

$result1 = mysqli_query($conn,"SELECT * FROM login where status='1'");
$limit = 4;
$total_rows = mysqli_num_rows($result1);  
$total_pages = ceil ($total_rows / $limit);

if (!isset ($_GET['page']) ) { 
  $page_number = 1;  
} else {  
  $page_number = $_GET['page'];      
}    
$initial_page = ($page_number-1) * $limit; 

$sql = "SELECT fname,lname,email,mo1,birthdate,gender,address,city,state,country FROM login where status='1' LIMIT $initial_page,$limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table id='table1'><tr><th>FIRST NAME</th><th>LAST NAME</th><th>EMAIL</th> <th>MOBILE NO.</th> <th>BIRTHDATE</th> <th>GENDER</th> <th>ADDRESS</th> <th>CITY</th> <th>STATE</th> <th>COUNTRY</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr id='tr1'><td id='td1'>".$row['fname']."</td><td id='td1'>".$row['lname']."</td><td id='td1'>"
      .$row['email']."</td><td id='td1'>".$row['mo1']."</td><td id='td1'>".$row['birthdate']."</td><td id='td1'>".$row['gender']."</td><td id='td1'>".
      $row['address']."</td><td id='td1'>".$row['city']."</td><td id='td1'>".$row['state']."</td><td id='td1'>".$row['country']."</td>
      <td><button id='deletebutton' onclick=location.href='./admintable1.php?delete=".$row["email"]."'>Delete</button></td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
?><br><br><table id="linktable"><tr id="linktr"><td id="linktd"><?php
for($page_number = 1; $page_number<= $total_pages; $page_number++) {
  echo '<button id="linkbutton"><a href = "./admintable1.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;';  
}?>
</td></tr></table><br><br><?php
$conn->close();
?>
    <table><tr>
    <form method="post" action="./admintable1.php">
        <td>
        <button class="loginlabels" id="login" value="HOME" name="home">HOME</button>
        </td> </form>
    <form action="../logout.php" method="post">
    <td>
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
</td></tr></form></table>
</body>
</html>
