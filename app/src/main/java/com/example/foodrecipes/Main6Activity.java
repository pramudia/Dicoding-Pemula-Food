package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main6Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main6);


        WebView view = (WebView) findViewById(R.id.konten5);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Soto ayam adalah makanan khas Indonesia yang berupa sejenis sup ayam dengan kuah yang berwarna kekuningan.    " +
                "Warna kuning ini dikarenakan oleh kunyit yang digunakan sebagai bumbu.    " +
                "Selain ayam bahan yang digunakan juga meliputi telur rebus, irisan kentang, daun seledri, serta bawang goreng. Terkadang soto juga disajikan dengan lontong atau nasi putih.  " +
                "Selain itu soto ayam juga sering dihidangkan dengan sambal, kerupuk dan koya (campuran tumbukan kerupuk dengan bawang putih). " ;

        view.loadData(text, "text/html", "utf-8");
    }

}
