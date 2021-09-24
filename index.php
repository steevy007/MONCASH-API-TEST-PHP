<?php
require __DIR__ . '/vendor/autoload.php';
use DGCGroup\MonCashPHPSDK\Credentials;
use DGCGroup\MonCashPHPSDK\Configuration;
use DGCGroup\MonCashPHPSDK\PaymentMaker;
use DGCGroup\MonCashPHPSDK\Order;
use DGCGroup\MonCashPHPSDK\TransactionCaller;
use DGCGroup\MonCashPHPSDK\TransactionDetails;
use DGCGroup\MonCashPHPSDK\TransactionPayment;


$client = "09f0139f25266caf36373b3c4e434231";
$secret = "d3V4GJHJOzGwcEggNhq44l4wWVR04CxWz0-C4ipAd-XdI30IQ24IXHhiDhiWW7n8";
$configArray = Configuration::getSandboxConfigs(); // Configuration::getProdConfigs()
$credential = new Credentials($client, $secret, $configArray);


$amount = 10;//amount in HTG
$orderId = "979679729018";; //may be your cart Id
$theOrder = new Order( $orderId, $amount );
$paymentObj = PaymentMaker::makePaymentRequest($theOrder, $credential,
$configArray);
//This method return the payment gateway url
$url=$paymentObj->getRedirect();
//echo $url;
header('Location:'.$url);


$transactionDetails =TransactionCaller::getTransactionDetailsByTransactionIdRequest( $theOrder,
$credential, $configArray );
echo $transactionDetails->getPayment()->getReference();
echo $transactionDetails->getPayment()->getTransactionId();
echo $transactionDetails->getPayment()->getCost();
echo $transactionDetails->getPayment()->getMessage();
echo $transactionDetails->getPayment()->getPayer();
echo date('D M d Y', $transactionDetails->getTimestamp()/1000);