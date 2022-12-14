package com.example.test_int

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.LinearLayout
import androidx.appcompat.app.AppCompatActivity
import androidx.cardview.widget.CardView
import androidx.navigation.ui.AppBarConfiguration
import com.example.test_int.databinding.ActivityActTestBinding
import com.google.android.material.button.MaterialButton

class act_test : AppCompatActivity() {

    private lateinit var appBarConfiguration: AppBarConfiguration
    private lateinit var binding: ActivityActTestBinding


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)


        var btn = findViewById<MaterialButton>(R.id.btn1)


        btn.setOnClickListener(){
            val intent = Intent(this, SecondFragment::class.java)
            startActivity(intent)

        }
    }

}