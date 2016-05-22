<!DOCTYPE html>

<?php
        include "config.php";
?>
<!-- test -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Loyalatity small</title>

        <script src="<?php echo JS_PATH . 'jQuery-1.12.1.js'; ?>"></script>
        <script src="<?php echo JS_PATH . 'form-data.js'; ?>"></script>

        <!-- Bootstrap -->
        <link href="<?php echo CSS_PATH . 'bootstrap.min.css'; ?>" rel="stylesheet">
        <link href="<?php echo CSS_PATH . 'style.css'; ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="header">
            <h1>Best Buy</h1>
        </div>


        <div class="container">
            <form class="form-horizontal" role="form">
                <fieldset>
                    <legend>Easy Loyality Register</legend>
                    <div class="alert alert-danger">
                        <strong id="error-field"></strong><span id="error-message"></span>
                    </div>
                    
<div style="
    height: 368px;
    width: 583px;
    background-image: url('img/card.png');
">
<input text="Card amount" id="card-amount" value="100" style="
    position: relative;
    top: 10px;
	left: 300px;
    width: 100px;
	text-align: right;
	font-size: 22px;
    display: block;
	
">
<button type="button" class="btn btn-success" id="button-send" name="send" 
    style="
    position: relative;
    top: 15px;
    left: 300px;
    width: 50px;
    font-size: 12px;
    display: block;"
	>Send</button>
	
	
">
<input placeholder="Card number" id="card-number" style="
    position: relative;
    top: 105px;
    left: 47px;
    width: 490px;
    font-size: 22px;
    display: block;
">
<input placeholder="Name on Card" id="card-holder-name" style=" 
    position: relative;
    top: 170px;
    left: 47px;
    width: 336px;
    font-size: 22px;
    display: block;
">
  <input placeholder="Month" id="card-expiry-month" style="
    position: relative;
    top: 87px;
    left: 250px;
    width: 66px;
    font-size: 22px;
    display: block;
">
  <input placeholder="Year" id="card-expiry-year" style="
    position: relative;
    top: 50px;
    left: 318px;
    width: 66px;
    font-size: 22px;
    display: block;
">
<input placeholder="CVV" id="card-cvv" style="
    position: relative;
    top: 50px;
    left: 465px;
    width: 66px;
    font-size: 22px;
    display: block;
    background: lightblue;
">

</div>
                    </div>

                </fieldset>
            </form>
<div>
  <label name="checkbox"><input type="checkbox" value="true" id="register-loyality-check"> Register to Loyality programs?</label>

</div>
          <div id="response-box">
                <p></p>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo JS_PATH . 'bootstrap.min.js'; ?>"></script>
    </body>
</html>
