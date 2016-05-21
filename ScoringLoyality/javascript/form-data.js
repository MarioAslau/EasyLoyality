$(document).ready(function() {
    
    $("#button-send").click(function() {
            $(".alert").css('display', 'none');
            
            var cardHolderName = $("#card-holder-name").val();
            var cardNumber = $("#card-number").val();
            var cardExpiryMonth = $("#card-expiry-month").val();
            var cardExpiryYear = $("#card-expiry-year option:selected").text();
            var cardCVV = $("#card-cvv").val();
            var cardAmount = $("#card-amount").val();
            var registerToLoyality = $('#register-loyality-check').is(":checked");

            var clientInfo = {
                    cardHolderName: cardHolderName,
                    cardNumber: cardNumber,
                    cardExpiryMonth: cardExpiryMonth,
                    cardExpiryYear: cardExpiryYear,
                    cardCVV: cardCVV,
                    cardAmount: cardAmount,
                    registerToLoyality: registerToLoyality,
            };

            $.ajax({
                    url: "ScoringLoyality/php/make-payment.php",
                    data: clientInfo,
                    method: "POST",
                    dataType: 'json',
                    success: function(data) {
                            $("#response-box").css("display", "block");
                            if (data['type'] == 'error') {
                                    $(".alert").css('display', 'block');
                                    $("#error-field").html(data['field'] + "*:  ");
                                    $("#error-message").html(data['message']);
                                    $("#response-box").css({"background-color": "#F6CECE", "border-color" : "red"});
                                    $("#response-box p").html("<strong>Transaction failed!</strong> ");
                            }
                            else {
                                    $("#response-box").css("display", "block");
                                    $("#response-box p").html("<strong>Transaction succeeded!</strong> ");
                                    if (data['client_points'] != null) {
                                            $("#response-box p").append("You have <strong>" + data['client_points'] + "</strong> loyality points.");
                                    }
                            }
                    },
                    error: function(data) {
                            $("#response-box").css("display", "block");
                            alert("Something went wrong :(");
                    }
           
            });
        
    });
    
    
});