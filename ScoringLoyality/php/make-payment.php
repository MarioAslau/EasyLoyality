<?php

include_once PHP_PATH.'database.php';


$cardHolderName = empty($_POST['cardHolderName']) ? die(error_empty_field('Name on Card')) : $_POST['cardHolderName'];
$cardNumber = empty($_POST['cardNumber']) ? die(error_empty_field('Card Number')) : $_POST['cardNumber'];
$cardExpiryMonth = empty($_POST['cardExpiryMonth']) ? die(error_empty_field('Expiration Date (month)')) : $_POST['cardExpiryMonth'];
$cardExpiryYear = empty($_POST['cardExpiryYear']) ? die(error_empty_field('Expiration Date (year)')) : $_POST['cardExpiryYear'];
$cardCVV = empty($_POST['cardCVV']) ? die(error_empty_field('Card CVV')) : $_POST['cardCVV'];
$registerToLoyality = empty($_POST['registerToLoyality']) ? false : $_POST['registerToLoyality'];


function error_empty_field($field) {
        $message = 'This field shouldn\'t be empty.';
        return json_encode(new ErrorMessage($field, $message));
}


class ErrorMessage {
    public $type;
    public $field;
    public $message;
    
    public function __construct($field, $message) {
            $this->type = 'error';
            $this->field = $field;
            $this->message = $message;
    }
    
}

function validate_card_holder_name($holder_name) {
        // check validity of card holder's name
    
    
    
//        if (not-ok)
//                $message = 'This field should contain only a-zA-Z0-9 characters.';
//                die(json_encode(new ErrorMessage('Name on Card', $message)));
}

function validate_card_number($card_number) {
        
}

function validate_card_expiry_month($expiry_month) {
    
}

function validate_card_expiry_year($expiry_year) {
    
}

function validate_card_cvv($cvv) {
    
}


validate_card_holder_name($cardHolderName);
validate_card_number($cardNumber);
validate_card_expiry_month($cardExpiryMonth);
validate_card_expiry_year($cardExpiryYear);
validate_card_cvv($cardCVV);


// All information is now checked and valid


function request($cardHolderName, $cardNumber, $cardExpiryMonth, $cardExpiryYear, $cardCVV, $registerToLoiality) {
	$url = "php/test-gateway.php";
	$data = "authentication.userId=8a8294174b7ecb28014b9699220015cc" .
		"&authentication.password=sy6KJsT8" .
		"&authentication.entityId=8a8294174b7ecb28014b9699220015ca" .
		"&amount=92.00" .
		"&currency=EUR" .
		"&paymentBrand=VISA" .
		"&paymentType=DB" .
		"&cardHolderName=".$cardHolderName.
		"&cardNumber=".$cardNumber.
		"&cardExpiryMonth=".$cardExpiryMonth.
		"&cardExpiryYear=".$cardExpiryYear.
		"&cardCVV=".$cardCVV.
                "&registerToLoiality=".$registerToLoyality;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $responseData;
}

$responseData = request($cardHolderName, $cardNumber, $cardExpiryMonth, $cardExpiryYear, $cardCVV, $registerToLoyality);












