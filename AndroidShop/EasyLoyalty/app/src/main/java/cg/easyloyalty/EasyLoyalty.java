package cg.easyloyalty;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.ToggleButton;
import android.util.Log;
import org.apache.commons.io.IOUtils;
import org.apache.http.client.HttpClient;
import org.json.JSONArray;
import org.json.JSONObject;

import java.io.DataOutput;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import com.loopj.android.http.*;

import javax.net.ssl.HttpsURLConnection;

import cz.msebera.android.httpclient.Header;

//import com.android.okhttp.internal.huc.HttpURLConnectionImpl;
public class EasyLoyalty extends AppCompatActivity {

    EditText etName;
    EditText etNumber;
    EditText etMonth;
    EditText etYear;
    EditText etCVV;
    EditText etAmount;
    CheckBox cbLoyalty;
    Switch sLoyalty;
    boolean state;
    String  stateStatus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_easy_loyalty);
        etName = (EditText) findViewById(R.id.name_id);
        etNumber = (EditText) findViewById(R.id.number_id);
        etMonth = (EditText) findViewById(R.id.month_id);
        etYear = (EditText) findViewById(R.id.year_id);
        etCVV = (EditText) findViewById(R.id.cvv_id);
        etAmount = (EditText) findViewById(R.id.amount_id);
        sLoyalty = (Switch) findViewById(R.id.loyalty_id);

        sLoyalty.setOnCheckedChangeListener/*taking the message from the walking guy*/(new CompoundButton.OnCheckedChangeListener/*the guy*/() {
                                                public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                                                    if (isChecked) {
                                                        //System.out.print("Merge");
                                                        state = true;
                                                    } else {
                                                        //System.out.print("Nu merge");
                                                        state = false;
                                                    }


                                                }
                                            }


        );
    }

    public void clickedProceed(View v) {
        System.out.println("Name: " + etName.getText().toString());//+" Number: " + etNumber.getText().toString() +  " " + etMonth.getText().toString() +  "/" + etYear.getText().toString() + " CVV: " + etCVV.getText().toString() + " Amount:" + etAmount.getText().toString());
        if(state)
        { System.out.println("State is true"); stateStatus = "true";}
        else
        {System.out.println("State is false"); stateStatus = "false";}
        doPostRequest();
/*
        try {
            URL url = new URL("http://172.16.3.249/HackTM2016EasyLoyality/php/make-payment.php");

            HttpURLConnection connection = (HttpURLConnection)url.openConnection();

            String urlParamaters = "cardNumber=1234567890123456&cardHolderName=reter&cardExpiryMonth=5&cardExpiryYear=2020&cardCVV=123&registerToLoyality=true&amount=1100";

            connection.setRequestMethod("POST");
            connection.setRequestProperty("USER-AGENT", "Mozilla/5.0");
            connection.setRequestProperty("ACCEPT-LANGUAGE","en-US,en;0.5");
            connection.setDoInput(true);
            connection.setDoOutput(true);

            DataOutputStream dStream = new DataOutputStream(connection.getOutputStream());

            dStream.writeBytes(urlParamaters);
            dStream.flush();
            dStream.close();

            int responseCode = connection.getResponseCode();
            String data = "cardHolderName="+ etName.getText().toString();//+restul

            InputStream is;
            if (responseCode >= 400){
                is = connection.getErrorStream();
                Log.d("TT","Erroare in rapuns "+responseCode);
            }
            else {
                is = connection.getInputStream();
                Log.d("TT","Merge"+responseCode);

            }

            //String response = IOUtils.toString(is);
            //System.out.println(response);

        } catch (Exception e) {
            //smth
            e.printStackTrace();
        }
        */


    }
    //"cardNumber=1234567890123456&cardHolderName=reter&cardExpiryMonth=5&cardExpiryYear=2020&cardCVV=123&registerToLoyality=true&amount=1100";
    private void doPostRequest()
    {
        String url = "http://172.16.3.249/HackTM2016EasyLoyality/ScoringLoyality/php/make-payment.php";
        AsyncHttpClient client = new AsyncHttpClient();
        RequestParams params = new RequestParams();
        params.put("cardHolderName", etName.getText().toString());
        params.put("cardNumber", etNumber.getText().toString());
        params.put("cardExpiryMonth",etMonth.getText().toString());
        params.put("cardExpiryYear",etYear.getText().toString());
        params.put("cardCVV",etCVV.getText().toString());
        params.put("cardAmount",etAmount.getText().toString());
        params.put("registerToLoyality",stateStatus);

        System.out.println("Linia trimisa: " +params);
        client.post(url, params, new JsonHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                System.out.println("YES");
                System.out.println(response);
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, String message, Throwable throwable) {
                System.out.println("NO");
                System.out.println(statusCode);
                System.out.println(message);
                throwable.printStackTrace();
            }
        });

    }

}

