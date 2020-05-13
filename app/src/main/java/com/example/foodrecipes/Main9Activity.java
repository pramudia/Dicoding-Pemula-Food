package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main9Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main9);


        WebView view = (WebView) findViewById(R.id.konten8);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Ayam masak merah adalah salah satu masakan yang berasal dari negri jiran, Malaysia. menu ini kerap kali disajikan sebagai hidangan dalam acara kenduri atau resepsi.    " +
                "Yang ada dalam benak kita tentu ribet dan riweh menyiapkan bahan dan cara memasaknya.  " +
                " Karena biasanya menu yang disajikan untuk acara kenduri tentu bukan hidangan biasa, " +
                "karena moment nya juga bukan moment biasa.  " ;

        view.loadData(text, "text/html", "utf-8");
    }
}
