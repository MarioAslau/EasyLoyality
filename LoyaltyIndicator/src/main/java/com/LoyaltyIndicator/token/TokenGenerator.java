package com.LoyaltyIndicator.token;


import com.LoyaltyIndicator.pojo.LoyaltyIndicator;

public interface TokenGenerator {

	public LoyaltyIndicator generateToken(String cardNumber) ;
	
	
}
