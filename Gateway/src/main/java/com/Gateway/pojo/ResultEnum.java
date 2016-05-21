package com.Gateway.pojo;

public enum ResultEnum {
	Success ("00"),
	InvalidCardLength ("01"),
	InvalidDate ("02"),
	InvalidCVV("03"),
	InvalidAmount("04");
	
	private final String resultCode;
	
	ResultEnum(String resultCode){
		this.resultCode=resultCode;
	}

	public String getResultCode() {
		return resultCode;
	}

}
