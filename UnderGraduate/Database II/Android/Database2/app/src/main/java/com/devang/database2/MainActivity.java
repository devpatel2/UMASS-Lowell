package com.devang.database2;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class MainActivity extends AppCompatActivity {

    private EditText E_gsid;
    private TextView textView;
    private static final String DEBUG_TAG = "Http Response:";
    private String result;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        E_gsid = (EditText)findViewById(R.id.editText);
        textView = (TextView)findViewById(R.id.output);
        Button myButton = (Button)findViewById(R.id.but_gsid);
        myButton.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        try{
                            //String link = "http://10.0.2.2:82/graduate.php";  // For UML localhost
                            String link = "http://192.168.1.14:82/graduate1.php"; // For home localhost
                            String id = E_gsid.getText().toString();
                            link = link + "?gsid=" + URLEncoder.encode(id, "UTF-8");
                            new DownloadWebpageTask().execute(link);
                        }
                        catch(IOException e) {
                            e.printStackTrace();
                        }
                    }
                }
        );
    }

    private class DownloadWebpageTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {

            // params comes from the execute() call: params[0] is the url.
            try {
                return downloadUrl(urls[0]);
            } catch (IOException e) {
                return "Unable to retrieve web page. URL may be invalid.";
            } catch (JSONException e) {
                e.getStackTrace();
                return "JSON ERROR";
            }
        }
        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {
            try {
                JSONObject js_obj = new JSONObject(result);
                JSONArray js_arr = js_obj.optJSONArray("result");
                String js_result = js_arr.getString(0) + "\n";
                for(int i = 1; i < js_arr.length(); i++){
                    js_result += js_arr.getString(i);
                    js_result += "\n";
                }
                textView.setText(js_result);
            } catch (JSONException e) {
                e.getStackTrace();
            }
        }
    }

    private String downloadUrl(String link) throws IOException, JSONException {
        try {
            URL url = new URL(link);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setReadTimeout(10000);
            conn.setConnectTimeout(15000);
            conn.setRequestMethod("GET");
            conn.setDoInput(true);
            conn.connect();

            int response = conn.getResponseCode();
            Log.d(DEBUG_TAG, "The response is: " + response);

            BufferedReader rd = new BufferedReader(new InputStreamReader(conn.getInputStream()));
            result = rd.readLine();

            rd.close();
            conn.disconnect();
            return result;
        } catch (Exception e) {
            e.getStackTrace();
            return "Exception Found";
        }
    }

}
