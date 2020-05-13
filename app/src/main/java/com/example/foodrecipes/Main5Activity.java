package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main5Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main5);


        WebView view = (WebView) findViewById(R.id.konten4);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Bacem atau baceman merupakan sajian panganan dari daerah Jawa Tengah, juga Yogyakarta bagian timur (Mataraman).   " +
                "Orang Yogyakarta menyukai bacem yang bercitarasa manis, yaitu dengan bumbu khas gula merah.   " +
                " Sebetulnya bacem merupakan cara pengolahan makanan untuk mengawetkan produk, biasanya adalah tempe dan tahu. " +
                "Dibacem artinya direndam dalam air gula atau garam supaya bahan makanan menjadi awet. " ;

        view.loadData(text, "text/html", "utf-8");
    }
}
