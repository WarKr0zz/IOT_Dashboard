package com.example.loginandroid

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.TextureView
import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import com.google.android.material.button.MaterialButton

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        //var username = TextView( findViewById(R.id.username));
        val username = findViewById<TextView>(R.id.username);
        val password = findViewById<TextView>(R.id.password);
        //val button = MaterialButton(findViewById(R.id.login));
        val button = findViewById<MaterialButton>(R.id.loginbtn)





        //var textView = findViewById<TextView>(R.id.username) as TextView
        //textView?.setOnClickListener{ Toast.makeText(this@MainActivity,.string.text_on_click; Toast.LENGTH_LONG).show() }

        //button.setOnClickListener(){
           // public void onClick(View, v){
             //   if(username.getText().ToString().equals("admin") && password.getText().toString().equals("admin")){
               //     Toast.makeText(content: MainActivity.this, resold:"LOGIN SUCCESSFULLY", Toast.Length_SHORT).show();
                //}else
                  //  Toast.makeText(content: MainActivity.this, resold:"LOGIN FAILED", Toast.Length_SHORT).show();

                if( username.equals("admin")  && (password.equals("admin"))){
                    Log.d("Pass ok","pass ok");

            //}
        }
    }
}