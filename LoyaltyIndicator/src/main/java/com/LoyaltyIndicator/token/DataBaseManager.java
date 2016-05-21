package com.LoyaltyIndicator.token;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

public class DataBaseManager {

	private final static String DBURL = "jdbc:h2:~/test:loyalty";
	public final static String USER = "admin";
	public final static String PASSWORD = "admin";
	
	private static DataSource dataSource;
	
	static {
		try {
			Class.forName("org.h2.Driver");
		} catch (ClassNotFoundException e) {
			throw new RuntimeException("Could not load JDBC driver", e);
		}
	}

	public static void init() throws NamingException, SQLException {

		Context initialContext = new InitialContext();

		/**
		 * Get Context object for all environment naming (JNDI), such as
		 * Resources configured for this web application.
		 */
		Context environmentContext = (Context) initialContext.lookup("java:comp/env");
		/**
		 * Name of the Resource we want to access.
		 */
		String dataResourceName = "jdbc/LoyaltyDB";
		/**
		 * Get the data source for the MySQL to request a connection.
		 */
		dataSource = (DataSource) environmentContext.lookup(dataResourceName);
	
	}

	public static Connection getConnection() throws SQLException {

		return dataSource.getConnection();
		//return DriverManager.getConnection(DBURL, USER, PASSWORD);
	}
}
