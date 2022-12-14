package com.example.test_int

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.google.android.material.button.MaterialButton

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)




        var button = findViewById<MaterialButton>(R.id.loginbtn)


        button.setOnClickListener{
            val intent = Intent(this, DashboardDeSesMorts::class.java)
            startActivity(intent)
        }
    }


}