<?php

$response = array(
        "resultMessage" => 'Success!',
        "resultCode" => "00",
        "cardLastFourDigits" => "4111",
        "cardExpiryMonth" => "05",
        "cardExpiryYear" => "2018",
        "token" => "a5f478b9cc54a5f478b9cc5475c89322" 
);

echo json_encode($response);
