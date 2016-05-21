package com.Gateway.pojo;

public class GatewayResponse {
	
	private String resultCode;
	private String resultMessage;
	private String cardLastFourDigits;
	private String cardExpiryMonth;
	private String cardExpiryYear;
	private String token;
	
	public String getResultCode() {
		return resultCode;
	}
	public void setResult(ResultEnum results) {
		this.resultCode = results.getResultCode();
		this.resultMessage = results.name();
	}
	
	public String getResultMessage(){
		return resultMessage;
	}
	
	public String getCardLastFourDigits() {
		return cardLastFourDigits;
	}
	public void setCardLastFourDigits(String cardLastFourDigits) {
		this.cardLastFourDigits = cardLastFourDigits;
	}
	public String getCardExpiryMonth() {
		return cardExpiryMonth;
	}
	public void setCardExpiryMonth(String cardExpiryMonth) {
		this.cardExpiryMonth = cardExpiryMonth;
	}
	public String getCardExpiryYear() {
		return cardExpiryYear;
	}
	public void setCardExpiryYear(String cardExpiryYear) {
		this.cardExpiryYear = cardExpiryYear;
	}
	public String getToken() {
		return token;
	}
	public void setToken(String token) {
		this.token = token;
	}
}
