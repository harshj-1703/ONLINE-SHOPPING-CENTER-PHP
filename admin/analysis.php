<?php
 session_start();
 include '../connect.php';
 if(!isset($_SESSION['fname']))
 {
     header('location:./adminlogin.php');
 }   
 if(isset($_POST["home"]))
 {
  header('location:./index.php');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
 <title>ANALYSIS OF PRODUCTS</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" href="../imges/3.png">
 <link rel="stylesheet" href="./CSS/admintable1.css">
</head>
<body>
<table>
        <tr>
        <td>
                <h1 id="loginh1">ONLINE SHOPPING ANALYSIS</h1>
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

date_default_timezone_set("Asia/Calcutta");

echo "<table><tr><td>";

$sql2 = "select pname,COUNT(*) as total from analysis group by pname order by total desc";  
$result2 = mysqli_query($conn, $sql2);  
// $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

echo "<table border='2' style='background-color:yellow; font-size:20px; text-align:center;'><tr style='background-color:blue; color:white;'><td colspan='2'>TOTAL SALES</td></tr>";
echo "<tr style='background-color:blue; color:white;'><td>PRODUCT NAME</td><td>TOTAL SELLES(High To Low)</td></tr>";
while($row2 = mysqli_fetch_array($result2)){
    echo "<tr><td>".$row2['pname']."</td><td>".$row2['total']."</td></tr>";
}
echo "</table><br><br></td>";



//-----------------chart----------------
echo "<td>";
if($stmt = $conn->query("select pname,COUNT(*) as total from analysis group by pname")){

while ($row = $stmt->fetch_row()) {
   $php_data_array[] = $row; // Adding to array
   }
}else{
echo $conn->error;
}
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>


<div id="chart_div">
<br><br>
<!--<a href=https://www.plus2net.com/php_tutorial/chart-database.php>Pie Chart from MySQL database</a>-->
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'language');
        data.addColumn('number', 'Nos');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'PIE CHART FOR NUMBER OF SOLD ITEMS TOTAL',
                       width:600,
                       height:500};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
<?php
// $sql4 = "select SUM(COUNT(*)) as total from analysis group by pname";  
// $result4 = mysqli_query($conn, $sql4);  
// while($row4 = mysqli_fetch_array($result4)){
//   echo "TOTAL SOLD PRODUCTS : ".$row4['total']."";
// }

?>
</div>
</html>
<!---------------------------chart--------------------->


<?php
echo "</td><td>";

$date = date("y-m-d");
$date1 = date("d-m-20y");

$sql3 = "select pname,COUNT(*) as total from analysis where date='$date' group by pname order by total desc";  
$result3 = mysqli_query($conn, $sql3);  
// $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

echo "<table border='2' style='background-color:yellow; font-size:20px; text-align:center;'><tr style='background-color:blue; color:white;'><td colspan='2'>TODAY ($date1) TOTAL SALES</td></tr>";
echo "<tr style='background-color:blue; color:white;'><td>PRODUCT NAME</td><td>TOTAL SELLES(High To Low)</td></tr>";
while($row3 = mysqli_fetch_array($result3)){
    echo "<tr><td>".$row3['pname']."</td><td>".$row3['total']."</td></tr>";
}


echo "</table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td style='text-align:center; background-color:blue; color:white; font-weight:bolder; font-size:24px; border-radius:20px'>";
$sql4 = "select pname,COUNT(*) as total from analysis";  
$result4 = mysqli_query($conn, $sql4);  
while($row4 = mysqli_fetch_array($result4)){
  echo "TOTAL SOLD PRODUCTS : ".$row4['total']."";
}


echo "</td><td>&nbsp;</td><tr><td>&nbsp;</td><td style='text-align:center; background-color:blue; color:white; font-weight:bolder; font-size:24px; border-radius:20px'>";
$sql5 = "select pname,COUNT(*) as total from analysis where date='$date'";  
$result5 = mysqli_query($conn, $sql5);  
while($row5 = mysqli_fetch_array($result5)){
  echo "TOTAL SOLD PRODUCTS TODAY : ".$row5['total']."";
}
echo "</td><td>&nbsp;</td></tr></table><br><br>";


$result1 = mysqli_query($conn,"SELECT * FROM analysis order by id desc");
$limit = 4;
$total_rows = mysqli_num_rows($result1);  
$total_pages = ceil ($total_rows / $limit);

if (!isset ($_GET['page']) ) { 
  $page_number = 1;  
} else {  
  $page_number = $_GET['page'];      
}    
$initial_page = ($page_number-1) * $limit; 

$sql = "SELECT * FROM analysis order by id desc LIMIT $initial_page,$limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table id='table1'><tr><th>PRODUCT NAME</th><th>PRICE</th><th>CUSTOMER NAME</th><th>IMAGE</th><th>PURCHASED DATE</th><th>PURCHASED TIME</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr id='tr1'><td id='td1'>".$row['pname']."</td><td id='td1'>".$row['price']."</td><td id='td1'>"
      .$row['customer']."<td id='td1'><img src='../imges/product/".$row['image']."' class='lap' height='70' width='80'></td><td id='td1'>".$row['date']."</td><td id='td1'>".$row['time']."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
  }
?><br><br><table id="linktable"><tr id="linktr"><td id="linktd"><?php
for($page_number = 1; $page_number<= $total_pages; $page_number++) {
  echo '<button id="linkbutton"><a href = "./analysis.php?page=' . $page_number . '" id="pageno">' . $page_number . ' </a></button>&nbsp;&nbsp;';  
}?>
</td></tr></table><br><br><?php
$conn->close();
?>
    <table><tr>
    <form method="post" action="./analysis.php">
        <td>
        <button class="loginlabels" id="login" value="HOME" name="home">HOME</button>
        </td> </form>
    <form action="../logout.php" method="post">
    <td>
    <button class="loginlabels"  id="login" value="LOGOUT" name="logout">LOG OUT</button>
</td></tr></form></table>
</body>
</html>
