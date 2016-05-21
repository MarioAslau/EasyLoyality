package com.Gateway.service;

import java.util.Date;

import com.Gateway.pojo.Card;
import com.Gateway.pojo.GatewayResponse;
import com.Gateway.pojo.ResultEnum;

public abstract class ProcessorService {
	
	public GatewayResponse processTransaction(Card card){
		GatewayResponse gatewayresp = new GatewayResponse ();
		validate(card,gatewayresp);
		if(gatewayresp.getResultCode() == ResultEnum.Success.getResultCode()){
			internalProcessing(card, gatewayresp);
			finalizeResponse(card, gatewayresp);
		}
		return gatewayresp;
	};
	
	protected abstract void internalProcessing(Card card,GatewayResponse gatewayresp);
	
	protected void validate(Card card,GatewayResponse gatewayresp){
		if(card.getCardNumber() == null || card.getCardNumber().length() != 16){
			gatewayresp.setResult(ResultEnum.InvalidCardLength);
		}
		else if(!isvalidExpireDate(card)){
			gatewayresp.setResult(ResultEnum.InvalidDate);
		}
		else if(card.getCardCVV() == null || card.getCardCVV().length() !=3 ){
			gatewayresp.setResult(ResultEnum.InvalidCVV);
		}
		else if(card.getAmount() == null || Integer.valueOf(card.getAmount()) < 0){
			gatewayresp.setResult(ResultEnum.InvalidAmount);
		}
		else{
			gatewayresp.setResult(ResultEnum.Success);
		}
	}
	
	protected void finalizeResponse(Card card,GatewayResponse gatewayresp){
		gatewayresp.setCardExpiryMonth(card.getCardExpiryMonth());
		gatewayresp.setCardExpiryYear(card.getCardExpiryYear());
		String str = card.getCardNumber();
		gatewayresp.setCardLastFourDigits(str.substring(12, 16));
	}
	
	public boolean isvalidExpireDate(Card card){
		int expireMonth = Integer.valueOf(card.getCardExpiryMonth());
		int expireYear = Integer.valueOf(card.getCardExpiryYear());
		if(card.getCardExpiryMonth() == null){
			return false;
		} 
		else if(card.getCardExpiryYear() == null){
			return false;
		}
		else if(expireMonth > 12){
			return false;
		}
		else if( expireYear < new Date().getYear()){
			return false;			
		}
		else if( expireYear == new Date().getYear()){
				if(expireMonth < new Date().getMonth()){
					return false;		
				}
				return true;
		}
		else {
			return true;
		}
	}
	
}
