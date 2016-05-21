package com.LoyaltyIndicator.rest;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import com.LoyaltyIndicator.pojo.LoyaltyIndicator;
import com.google.gson.Gson;

public class GenerateToken extends HttpServlet {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5142234063404445119L;
	
	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		// TODO Auto-generated method stub
		String pan = req.getParameter("pan");
		//send pan and get loyalty indicator
		
		//Token generation
		LoyaltyIndicator token=getLoyaltyIndicator(pan);
		
		
		//Json generate
		final Gson gson = new Gson();
		
		String json = gson.toJson(token);
		//Json Response Writing
		resp.setContentType("application/json");
		PrintWriter out = resp.getWriter();
		out.println(json);
		
		
	}
	
	private LoyaltyIndicator getLoyaltyIndicator(String pan){
		LoyaltyIndicator token = new LoyaltyIndicator();
		token.setToken("bla" + pan);
		return token;
	};

}
