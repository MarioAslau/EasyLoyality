<!DOCTYPE html>

<?php
include "config.php";
?>
<!--DD -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Loyalatity</title>

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
        <h1>Welcome to Loyalatity Points Program</h1>


        <div class="container">
            <form class="form-horizontal" role="form">
                <fieldset>
                    <legend>Easy Loyalatity Register</legend>
                    <div class="alert alert-danger">
                        <strong id="error-field"></strong><span id="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-3">
                                    <select class="form-control col-sm-2" name="expiry-month" id="card-expiry-month">
                                        <option>Month</option>
                                        <option value="01">Jan (01)</option>
                                        <option value="02">Feb (02)</option>
                                        <option value="03">Mar (03)</option>
                                        <option value="04">Apr (04)</option>
                                        <option value="05">May (05)</option>
                                        <option value="06">June (06)</option>
                                        <option value="07">July (07)</option>
                                        <option value="08">Aug (08)</option>
                                        <option value="09">Sep (09)</option>
                                        <option value="10">Oct (10)</option>
                                        <option value="11">Nov (11)</option>
                                        <option value="12">Dec (12)</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <select class="form-control" name="expiry-year" id="card-expiry-year">
                                        <option value="16">2016</option>
                                        <option value="17">2017</option>
                                        <option value="18">2018</option>
                                        <option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="cvv" id="card-cvv" placeholder="Security Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <label class="checkbox-inline"><input type="checkbox" value="" id="register-loyality-check"> Register to Loyalatity programs?</label>
                            <button type="button" class="btn btn-success" id="button-send">Send</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo JS_PATH . 'bootstrap.min.js'; ?>"></script>
    </body>
</html>