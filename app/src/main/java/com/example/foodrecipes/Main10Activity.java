package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main10Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main10);


        WebView view = (WebView) findViewById(R.id.konten9);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "olahan laut ini memang bisa diolah menjadi beragam makanan dengan berbagai variasi bumbu. " +
                "Dari sekian banyaknya variasi, salah satu yang patut kamu coba adalah bumbu balado. Udang   " +
                " dengan bumbu balado ini memiliki cita rasa pedas dan gurih yang jika ditambah dengan irisan " +
                "petai akan membuatnya semakin menggugah selera." ;

        view.loadData(text, "text/html", "utf-8");
    }
}
