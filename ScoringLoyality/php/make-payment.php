<?php

include_once 'database.php';


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
	die(json_encode(new ErrorMessage('Card Amount', 'is not a valid number.')));


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


function request($cardHolderName, $cardNumber, $cardExpiryMonth, $cardExpiryYear, $cardCVV, $registerToLoyality) {
	$url = "http://localhost/HackTM2016EasyLoyality/ScoringLoyality/php/test-gateway.php";
	$data = "cardHolderName=".$cardHolderName.
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
		return array(
                        "resultMessage" => 'Failed to fetch data.', 
                        "resultCode" => '01'
                );
	}
	curl_close($ch);
	return $responseData;
}

$responseData = request($cardHolderName, $cardNumber, $cardExpiryMonth, $cardExpiryYear, $cardCVV, $registerToLoyality);
$responseData = json_decode($responseData, true);

$client_points = "";


switch ($responseData['resultCode']) {
       
    case "00": 
            // Success
            $token = $responseData['token'];
            if (!empty($token)) {
                    calculate_points($token);
                    $client_points = get_client_points($token);
                    $response_to_client = array('client_points' => $client_points);
                    echo json_encode($response_to_client);
            }
            break;
            
    case "01":
        
            break;
        
    case "02": 
        
            break;
        
    case "03":
        
            break;
    
    case "04":
           
            break;
    
    default:
        
}
        

function calculate_points($token) {
        global $db_connection;
        
        $insert_score_query = "INSERT INTO scores(user_token, loyality_points)
                    VALUES('$token', '1')
                ON DUPLICATE KEY UPDATE loyality_points = loyality_points + 1";

        $db_connection->query_db($insert_score_query);
}


function get_client_points($token) {
        global $db_connection;
        $client_points = 0;
        
        $get_points_query = "SELECT loyality_points
                                FROM scores
                            WHERE user_token='$token'";
        
        $result = $db_connection->query_db($get_points_query);
        
        $returned_rows = $db_connection->get_returned_rows();
        if ($returned_rows > 0) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $client_points = $row['loyality_points'];
        }
        return $client_points;
}










