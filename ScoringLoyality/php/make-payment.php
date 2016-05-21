<?php

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


