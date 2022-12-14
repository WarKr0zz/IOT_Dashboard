package com.example.test_int

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import java.io.BufferedReader
import java.io.InputStreamReader
import java.net.URL

class DashboardBtnTemp : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_dashboard_btn_temp)


        var BTNT = findViewById<Button>(R.id.BTNTEMP)


        BTNT.setOnClickListener(){
            val url = URL("http://128.128.0.58:2301/API/DeviceId/1")
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