package com.Gateway.service;

import org.junit.Test;

import com.Gateway.pojo.Card;
import com.Gateway.pojo.GatewayResponse;

public class ProcessorServiceTest {
 
	   @Test
	   public void testValidate(){
		  LoyaltyTransactionProcessor loyalty = new LoyaltyTransactionProcessor();
		  Card card = new Card();
		  card.setAmount("1100");
		  card.setCardCVV("123");
		  card.setCardExpiryMonth("5");
		  card.setCardExpiryYear("2020");
		  card.setCardHolderName("reter");
		  card.setCardNumber("1234567890123456");
		  card.setRegisterToLoyality("true");
		  
		  System.out.println("Inside testPrintMessage()");   
		  
		  loyalty.internalProcessing(card, new GatewayResponse());
		  
	   }
	
}
