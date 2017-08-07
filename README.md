# EasyLoyalty

EasyLoyalty is a sistem that the user can use when they have more than one loyalty cards from different stores. 
Instead of carrying with them all the cards from each store, a better solution would be to have just one card,
that would store the loyalty points on servers, this issue is solved by the EasyLoyalty project.

The project simulates a few merchants that subscribe to our payment system(Pay&Score). The clients shop and their sites and 
before they finalize the orders they will insert their bank account information in our form.

All the data will be sent through Restful API to the PaymentGateway server where there will be done the necessary validations.
If the registerToLoyality field is true, a unique token will be generated per card number and it will be returned to the Pay&Score
server. If it will be false the transaztion from PaymentGateway will be done and the message "transaction succeeded!" will be
returned. If the user selected registerToLoyality then the Loyalty Token Generator server will generate a unique token for each card and it wi
and it will send it back to the PaymentGateway, the server will send it further to the Pay&Score server and in the end it will
reach the client with the message: "Transactuion Succeeded! You have X loyalty points".

