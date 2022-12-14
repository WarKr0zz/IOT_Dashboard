package com.example.test_int

import android.annotation.SuppressLint
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import androidx.cardview.widget.CardView

class DashboardDeSesMorts : AppCompatActivity() {
    @SuppressLint("MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_dashboard_de_ses_morts)




        var CardD = findViewById<CardView>(R.id.cardDevice)
        var CardB = findViewById<CardView>(R.id.cardBtn)
        var Card = findViewById<CardView>(R.id.cardTemp)


        CardB.setOnClickListener(){
            val intent = Intent(this, DashboardBtnBtn::class.java)
            startActivity(intent)

        }


        Card.setOnClickListener(){
            val intent = Intent(this, DashboardBtnTemp::class.java)
            startActivity(intent)

        }

        CardD.setOnClickListener(){
            val intent = Intent(this, DashboardBtnDevice::class.java)
            startActivity(intent)

        }


    }
}