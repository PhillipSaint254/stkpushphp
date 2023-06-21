<?php 
include "function.php";
if (isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $invoice = date('YmdHis');
    $status = "unpaid";

    $response = mpesa($phone, $amount, $invoice);

    if ($response == 0){
        header("Location: index.php?error= Please fill the required fields!");
    } else {
        header("Location: index.php?error= an error has occured!");
    }
}