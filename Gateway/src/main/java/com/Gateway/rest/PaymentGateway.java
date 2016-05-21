package com.Gateway.rest;

import javax.servlet.http.HttpServlet;
import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.Gateway.pojo.Card;
import com.Gateway.pojo.GatewayResponse;
import com.Gateway.service.FactoryClass;
import com.Gateway.service.ProcessorService;
import com.google.gson.Gson;

public class PaymentGateway extends HttpServlet {

	/**
	 * 
	 */
	private static final long serialVersionUID = -1958755814230040482L;
	
	
	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
	
		Card card = getCardModel(req);
		
		//Json generate
		final Gson gson = new Gson();
				
		String json = gson.toJson(processTransaction(card));
		//Json Response Writing
		resp.setContentType("application/json");
		PrintWriter out = resp.getWriter();
		out.println(json);
				
		
	}
	
	private Card getCardModel(HttpServletRequest req){
		Card card = new Card();
		card.setCardHolderName(req.getParameter("cardHolderName"));
		card.setCardNumber(req.getParameter("cardNumber"));
		card.setCardExpiryMonth(req.getParameter("cardExpiryMonth"));
		card.setCardExpiryYear(req.getParameter("cardExpiryYear"));
		card.setAmount(req.getParameter("amount"));
		card.setCardCVV(req.getParameter("cardCVV"));
		card.setRegisterToLoyality(req.getParameter("registerToLoyality"));
		return card;		
	}
	
	private GatewayResponse processTransaction(Card card){
		ProcessorService processorService = FactoryClass.getProcessor(card);
		GatewayResponse gatewayresp = processorService.processTransaction(card);		
		return gatewayresp;	
	}
	
}
