
<title>PAY MONEY</title>
<link rel="icon" href="./imges/3.png">
<?php
session_start();
require('config.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         => 3456,
    // 'amount'          => $_POST['amount'] * 100,
    'amount'          => $_SESSION['price'] * 100,
    'currency'        => "INR",
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$_POST['item_name'] = "CART ITEMS";
$_POST['item_description'] = "ALL CART ITEMS";
$_POST['cust_name'] = $_SESSION['fname']." ".$_SESSION['lname'];
$_POST['email'] = $_SESSION['email'];
$_POST['contact'] = $_SESSION['mono'];
$_POST['address'] = $_SESSION['address'];


$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $_POST['item_name'],
    "description"       => $_POST['item_description'],
    "image"             => "",
    "prefill"           => [
    "name"              => $_POST['cust_name'],
    "email"             => $_POST['email'],
    "contact"           => $_POST['contact'],
    ],
    "notes"             => [
    "address"           => $_POST['address'],
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#1D3FED"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
if(isset($_SESSION['id']))
  {
    unset($_SESSION['id']);
  }

require("checkout/manual.php");
?>
</div>