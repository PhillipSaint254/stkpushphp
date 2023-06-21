<?php 
include "function.php";

$invoice = $_GET['orderid'];
$callbackJSONData = file_get_contents('php://input');

$logFile = "stkPush.json";
$log = fopen($logFile, "a");
fwrite($log, $callbackJSONData.$orderid);
fclose($log);
$callBackData = json_decode($callbackJSONData);

$resultCode = $callBackData->Body->stkCallback->ResultCode;

$resultCode = $callBackData->Body->stkCallback->ResultCode;
$amount = $callBackData->Body->stkCallback->CallMetadata->Amount;
$mpesaReceiptNumber = $callBackData->Body->stkCallback->CallMetadata->MpesaReceiptNumber;

$orderid = strval($orderid);
$amount =strval($amount);

if ($resultCode == 0){
    print("order payment successful with code " + $resultCode + " for amount " + $amount);
} else {
    print("Payment unsuccessful with code " + $resultCode);
}