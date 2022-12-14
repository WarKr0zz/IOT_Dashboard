package com.example.dashboardandroid

import android.annotation.SuppressLint
import android.os.Bundle
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.android.volley.Request
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley

class MainActivity : AppCompatActivity() {
    @SuppressLint("SetTextI18n", "MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // find the toast_button by its ID and set a click listener
        findViewById<Button>(R.id.button).setOnClickListener {
            val textView = findViewById<TextView>(R.id.TextView)
            // Instantiate the RequestQueue.
            val queue = Volley.newRequestQueue(this)
            val url = "http://128.128.0.58:2301/API/DeviceId/1"
            // Request a string response from the provided URL.
            var rep = "test";
            val stringRequest = StringRequest(
                Request.Method.GET, url,
                { response ->
                    // Display the first 500 characters of the response string.
                    rep = "Response is: ${response.substring(0, 500)}"
                    textView.text = rep;
                },
                { textView.text = "That didn't work!" })

// Add the request to the RequestQueue.
            queue.add(stringRequest)

            // create a Toast with some text, to appear for a short time
            val myToast = Toast.makeText(applicationContext, textView.text, Toast.LENGTH_SHORT)
            // show the Toast
            myToast.show()

        }
    }
}
