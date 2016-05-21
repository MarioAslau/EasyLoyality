package com.Gateway.service;

import com.Gateway.pojo.Card;

public class FactoryClass {
	
	public static ProcessorService getProcessor(Card card){
		ProcessorService service = null; 
		if(Boolean.valueOf(card.getRegisterToLoyality())){
			service= new LoyaltyTransactionProcessor();
		}
		else{
			service= new PlainTransactionService();
		}
		return 	 service;	
	}

}
