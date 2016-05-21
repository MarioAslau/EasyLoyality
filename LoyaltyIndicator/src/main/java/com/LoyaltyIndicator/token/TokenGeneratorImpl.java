package com.LoyaltyIndicator.token;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Base64;
import java.util.UUID;

import com.LoyaltyIndicator.LoyaltyException;
import com.LoyaltyIndicator.pojo.LoyaltyIndicator;

public class TokenGeneratorImpl implements TokenGenerator {

	@Override
	public LoyaltyIndicator generateToken(String cardNumber) {

		LoyaltyIndicator loyaltyIndicator = new LoyaltyIndicator();
		try {

			String hash = generateHash(cardNumber);

			String uuid = getUUIDForHash(hash);
			if (uuid == null) {
				uuid = UUID.randomUUID().toString().replaceAll("-", "");
				insertUUIDForHash(hash, uuid);
			}
			 loyaltyIndicator = new LoyaltyIndicator();
			loyaltyIndicator.setToken(uuid);
		} catch (Exception e) {
			loyaltyIndicator.setToken("Err!");
			e.printStackTrace();
		} 
		return loyaltyIndicator;
	}

	private void insertUUIDForHash(String panHash, String randId) throws SQLException {

		Connection conn = DataBaseManager.getConnection();
		PreparedStatement stat = conn.prepareStatement("insert into Loyalty(panHash,randId) values( ? , ?)");
		stat.setString(1, panHash);
		stat.setString(2, randId);

		stat.executeUpdate();

		stat.close();
		conn.close();

	}

	private String generateHash(String cardNumber) throws UnsupportedEncodingException, NoSuchAlgorithmException {
		byte[] bytesOfMessage = cardNumber.getBytes("UTF-8");

		MessageDigest md = MessageDigest.getInstance("MD5");
		byte[] thedigest = md.digest(bytesOfMessage);
		String generated64 = new String(Base64.getEncoder().encode(thedigest));

		return generated64;
	}

	private String getUUIDForHash(String hash) throws LoyaltyException {

		try {
			Connection conn = DataBaseManager.getConnection();
			PreparedStatement stat = conn.prepareStatement("SELECT randId FROM Loyalty WHERE panHash =  ? "); // (3)
			stat.setString(1, hash);

			ResultSet rs = stat.executeQuery();

			String uuid = null;
			if (rs.next()) {
				uuid = rs.getString(1);
			}
			rs.close();
			stat.close();
			conn.close();
			return uuid;

		} catch (SQLException e) {
			throw new LoyaltyException("Could not get uuid!", e);
		}

	}
}
