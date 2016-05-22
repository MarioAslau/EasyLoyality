package com.Gateway.service;

import java.net.*;

import org.apache.commons.io.IOUtils;

import java.io.*;

import com.Gateway.pojo.Card;
import com.Gateway.pojo.GatewayResponse;
import com.Gateway.pojo.LoyaltyTokenResponse;
import com.google.gson.Gson;

import java.net.HttpURLConnection;

public class LoyaltyTransactionProcessor extends ProcessorService {

	@Override
	protected void internalProcessing(Card card, GatewayResponse gatewayresp) {
		// TODO Auto-generated method stub
		URL url = null;
		String resultString = "";
		try {
			url = new URL("http://172.16.3.228:8080/LoyaltyIndicator/generateToken");

			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setRequestMethod("POST");

			conn.setDoInput(true);
			conn.setDoOutput(true);

			String data = "pan=" + card.getCardNumber();

			DataOutputStream wr = null;

			wr = new DataOutputStream(conn.getOutputStream());
			wr.writeBytes(data);
			wr.flush();
			wr.close();

			int responseCode = conn.getResponseCode();

			InputStream is;

			if (responseCode >= 400)
				is = conn.getErrorStream();
			else
				is = conn.getInputStream();

			resultString = IOUtils.toString(is);
			
			final Gson gson = new Gson();

			LoyaltyTokenResponse token = gson.fromJson(resultString, LoyaltyTokenResponse.class);
			// Json Response Writing
			gatewayresp.setToken(token.getToken());
			
		} catch (Throwable e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		

	}

}
