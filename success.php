<?php
session_start();
include './connect.php';
require './pdf/fpdf.php';
// require './pdf/html_table.php';

date_default_timezone_set("Asia/Calcutta");
if(!isset($_SESSION['fname']))
{
    header('location:./login.php');
}

// $id=$_SESSION['id'];
// $quantity=$_SESSION['quantity'];
// $quantity = $quantity-1;
// $upd = "UPDATE product SET quantity = '$quantity' where id= '$id'";
// $conn->query($upd);

// date_default_timezone_set("Asia/Calcutta");
// $pname = $_SESSION['pname'];
// $price = $_SESSION['price'];
// $image = $_SESSION['imgurl'];
// $customer = $_SESSION['fname']." ".$_SESSION['lname'];
// $date = date("y-m-d");

// $sql = "INSERT INTO analysis(`pname`,`price`,`image`,`customer`,`date`)
//         VALUES('$pname','$price','$image','$customer','$date')";
         
// $query = mysqli_query($conn,$sql);


if(isset($_POST['print'])){
    $pdf = new FPDF('p','mm',array(220,270));
    $pdf->AddPage();
    // $html = '<h1>HARSH</h1>';
    // $pdf->Rect(0,0,100,100,['F']);
    // $pdf->Ln(50);
    $pdf->SetFillColor(101,221,255);
    $pdf->SetFont('Courier','B',16);
    $pdf->SetTextColor(0,0,140);
    $pdf->SetdrawColor(0,0,140);
    $pdf->SetFillColor(12, 240, 290, true);
    // $pdf->Cell(40,10,'                                  ONLINE SHOPPING CENTER');
    $pdf->Cell(64,10,"ONLINE SHOPPING CENTER");
    $pdf->Image("./imges/1.png", 95, 6,17,17);
    $pdf->Cell(-20,50," PURCHASE BILL\n");
    $pdf->Cell(18,90,"NAME:");
    $pdf->Cell(-18,90,$_SESSION['fname']." ".$_SESSION['lname']);
    $pdf->Cell(45,115,"PRODUCT NAME:");
    $pdf->Cell(-45,115,$_SESSION['pname']);
    // $pdf->Image("./imges/product/5215-P-j-1.jpg", 125,65,60,60);
    $pdf->Cell(48,140,"PRODUCT PRICE:");
    $pdf->Cell(-47,140,$_SESSION['price']);
    $pdf->Cell(17,165,"DATE:");
    $pdf->Cell(-17,165,date("d-m-y"));
    $pdf->Cell(17,190,"TIME:");
    $pdf->Cell(-17,190,date("h:i:sa"));
    $pdf->Cell(58,215,"SHIPPING ADDRESS:");
    $pdf->Cell(-30,215,$_SESSION['address']);
    $pdf->Output();

    // $pdf=new PDF();
    // $pdf->AddPage();
    // $pdf->SetFont('Courier','B',24);
    // $pdf->Image("./imges/1.png", 125, 0,25,25);
    
    // $html='<h1>ONLINE SHOPPING CENTER</h1>
    // <table border="1">
    //     <tr colspan="2">
    //     <td>PURCHASE BILL</td>
    //     </tr>
    //     <tr>
    //     </tr>
    // </table>';

    // $pdf->WriteHTML($html);
    // $pdf->Output();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUCCESSFULL PAYMENT</title>
    <link rel="icon" href="./imges/3.png">
    <link rel="stylesheet" href="./CSS/success.css">
</head>
<body><br><br><br><br><br><br>
    <table>
        <tr class="tr">
            <td>SUCCESSFULL PAYMENT</td>
        </tr>
        <tr class="tr">
            <td><?php echo $_SESSION['fname'];?>&nbsp;<?php echo $_SESSION['lname'];?></td>
        </tr>
        <tr class="tr">
            <td><img src="./imges/success.png" height="100" width="100"></td>
        </tr>
        <tr class="tr">
            <td>THANK YOU FOR PURCHASING</td>
        </tr>
        <tr class="tr">
            <td>FROM OUR SITE.</td>
        </tr><form method="post" action="./success.php">
        <tr>
            <td><button name="print" value="print" class="glow-on-hover">PRINT BILL PDF</button></td>
        </tr><tr><td><br></td></tr></form>
        <form method="post" action="./dashboard.php">
        <tr>
            <td><button name="submit" value="CONTINUE FOR PURCHASE" class="glow-on-hover">CONTINUE FOR PURCHASE</button></td>
        </tr>
    </table>
</form>
</body>
</html>