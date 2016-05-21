package com.LoyaltyIndicator.token;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DataBaseManager {

	private final static String DBURL = "jdbc:h2:~/test:loyalty";
	public final static String USER = "admin";
	public final static String PASSWORD = "admin";

	static {
		try {
			Class.forName("org.h2.Driver");
		} catch (ClassNotFoundException e) {
			throw new RuntimeException("Could not load JDBC driver", e);
		}
	}

	public static Connection getConnection() throws SQLException {

		return DriverManager.getConnection(DBURL, USER, PASSWORD);
	}
}
