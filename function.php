<?php

function mpesa($phone, $amount, $ordernum){
    define('CALLBACK_URL', 'https://stkpushphp.onrender.com/callback_url.php?orderid=');

    #access token
    $consumerKey = 'Ee2rP4dbTlkL8bAKEh7l84Gt1QbXCGMO';
    $consumerSecret = '7W5wX5F0vAXT9FT8';

    $BusinessShortCode = '174379'; // if buys goods, use store number
    $PassKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $phone = preg_replace('/^0/', '254', str_replace("+", "", $phone));
    $PartyA = $phone;
    $PartyB = '174379'; // if buy goods, use the till
    $TranactionDesc = 'Pay swifftech smh';

    # get time in format YYYYmmddhms
    $TimeStamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode.$PassKey.$TimeStamp);
    
    $headers = ['content-Type:application/json; charset=utf8'];
    
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.":".$consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result = json_decode($result);
    $access_token = $result->access_token;
    
    curl_close($curl);
    
    #header for stkpush
    $stkheader = ['Content-Type:application/json', 'Authorization:Bearer '.$access_token];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
    
    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        "Password" => $Password,
        "Timestamp" => $TimeStamp,
        "TransactionType" => "CustomerPayBillOnline", //CustomerBuyGoodsOnline if buy goods
        "Amount" => $amount,
        "PartyA" => $PartyA,
        "PartyB" => $PartyB,
        "PhoneNumber" => $PartyA,
        "CallBackURL" => CALLBACK_URL . $ordernum,
        "AccountReference" => $ordernum,
        "TransactionDesc" => $TranactionDesc
    );
    
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    
    $res = (array)(json_decode($curl_response));

    $ResponseCode = $res['$ResponseCode'];
    
    return $ResponseCode;
}
?>