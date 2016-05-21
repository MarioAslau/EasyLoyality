<?php

//include_once PHP_PATH.'database.php';


$cardHolderName = empty($_POST['cardHolderName']) ? die(error_empty_field('Name on Card')) : $_POST['cardHolderName'];

if (strlen ($cardHolderName) > 50)
die(json_encode(new ErrorMessage('Name on Card', 'more than 50 char')));


preg_match("/[0-9A-Za-z ']{3,50}/", $cardHolderName, $regex_output);
if (empty($regex_output) || $regex_output[0]!=$cardHolderName)
	die(json_encode(new ErrorMessage('Name on Card', 'is not a  alfa numeric value')));




$cardNumber = empty($_POST['cardNumber']) ? die(error_empty_field('Card Number')) : $_POST['cardNumber'];

preg_match("/[0-9]{16}/", $cardNumber, $regex_output);
if (empty($regex_output) || $regex_output[0]!=$cardNumber)
	die(json_encode(new ErrorMessage('Card Number', 'is not a  16 digi value')));


$cardExpiryMonth = empty($_POST['cardExpiryMonth']) ? die(error_empty_field('Expiration Date (month)')) : $_POST['cardExpiryMonth'];

$cardExpiryMonthInt = intval($cardExpiryMonth);
if (!($cardExpiryMonthInt >= 1 && $cardExpiryMonthInt <=12))
	die(json_encode(new ErrorMessage('Expiration Date', 'is not a valid month')));


$cardExpiryYear = empty($_POST['cardExpiryYear']) ? die(error_empty_field('Expiration Date (year)')) : $_POST['cardExpiryYear'];

$cardExpiryYearInt = intval($cardExpiryYear);
if (!($cardExpiryYearInt >= 2016 && $cardExpiryYearInt <=2023))
	die(json_encode(new ErrorMessage('Expiration Date', 'is not a valid year')));

$cardExpiryDate=mktime(0, 0, 0, $cardExpiryMonthInt+1, 1,  $cardExpiryYearInt);

if ( time() >= $cardExpiryDate)
	die(json_encode(new ErrorMessage('Expiration Date', 'is in the past')));
	


$cardCVV = empty($_POST['cardCVV']) ? die(error_empty_field('Card CVV')) : $_POST['cardCVV'];
preg_match("/[0-9']{3}/", $cardCVV, $regex_output);
if (empty($regex_output) || $regex_output[0]!=$cardCVV)
	die(json_encode(new ErrorMessage('Card CVV', 'is not 3 char lenght')));

$cardAmount = empty($_POST['cardAmount']) ? die(error_empty_field('Card Amount')) : $_POST['cardAmount'];
$cardAmountFloat = intval($cardAmount);
if (!($cardAmountFloat >= 1))
	die(json_encode(new ErrorMessage('Card Amount', 'is not a valid number')));


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












