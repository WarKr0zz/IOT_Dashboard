package com.example.test_int

import android.os.Bundle
import android.os.StrictMode
import android.os.StrictMode.ThreadPolicy
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity
import java.io.BufferedReader
import java.io.InputStreamReader
import java.net.URL


class DashboardBtnDevice : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_dashboard_btn_device)

        val policy = ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)

        var Getdevice = findViewById<Button>(R.id.RecupDevice)

        var test = "a,b,c"
        Getdevice.setOnClickListener(){
            val url = URL("http://128.128.0.58:2301/API/DeviceId")
            val connection = url.openConnection()
            BufferedReader(InputStreamReader(connection.getInputStream())).use { inp ->
            var line: String?
            var delimiter = ","
            while (inp.readLine().also { line = it } != null) {
            println(line?.split(delimiter))
            }
            }
        }
    }
}