$(document).ready(function() {
    
    $("#button-send").click(function() {
            $(".alert").css('display', 'none');
            $("#response-box").css('display', 'none');
            
            var cardHolderName = $("#card-holder-name").val();
            var cardNumber = $("#card-number").val();
            var cardExpiryMonth = $("#card-expiry-month").val();
            var cardExpiryYear = $("#card-expiry-year").val();
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
                    registerToLoyality: registerToLoyality
            };

            $.ajax({
                    url: "http://172.16.3.249/HackTM2016EasyLoyality/ScoringLoyality/php/make-payment.php",
                    data: clientInfo,
                    method: "POST",
                    dataType: 'json',
                    success: function(data) {
                            if (data['type'] == 'success') {
                                    // Success
                                    $("#response-box").css("display", "block");
                                    $("#response-box p").html("<strong>Transaction succeeded!</strong> ");
                                    if (data['client_points'] != null) {
                                            $("#response-box p").append("You have <strong>" + data['client_points'] + "</strong> loyality points.");
                                    }
                            }
                            else {
                                    if (data['field'] != null) {
                                            // Wrong format for field
                                            $(".alert").css('display', 'block');
                                            $("#error-field").html(data['field'] + "*:  ");
                                            $("#error-message").html(data['message']);
                                    }
                                    else {
                                            // Other error
                                            $("#response-box").css({"background-color": "#F6CECE", "border-color" : "#FA5858"});
                                            $("#response-box p").html("<strong>Transaction failed!</strong> ");
                                    }
									
							}
							
                    },
                    error: function(data) {
                            // AJAX error
                            console.log(data);
                    }
           
            });
        
    });
    
    
});