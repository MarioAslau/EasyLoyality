package com.LoyaltyIndicator;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletContextEvent;
import javax.servlet.ServletContextListener;

import com.LoyaltyIndicator.token.DataBaseManager;

public class AppContextListener implements ServletContextListener {

	@Override
	public void contextInitialized(ServletContextEvent sce) {

		try {

			Connection conn = DataBaseManager.getConnection();
			Statement stat = conn.createStatement(); 

			stat.executeUpdate(
					"create table if not exists Loyalty(panHash varchar(30) primary key, randId varchar(255))");
			
		
			
			stat.close();
			conn.close();

		} catch (SQLException e) {
			throw new RuntimeException("Could not initialize data base!", e);
			
		}

	}

	@Override
	public void contextDestroyed(ServletContextEvent sce) {
		// TODO Auto-generated method stub

	}

}
