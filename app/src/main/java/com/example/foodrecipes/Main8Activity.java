package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main8Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main8);


        WebView view = (WebView) findViewById(R.id.konten7);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Ayam goreng adalah hidangan yang dibuat dari daging ayam dicampur tepung bumbu yang digoreng dalam minyak goreng panas.   " +
                "Beberapa rumah makan siap saji secara khusus menghidangkan ayam goreng,  " +
                " , misalnya Kentucky Fried Chicken. Sementara itu beberapa rumah makan di Indonesia " +
                "juga menghidangkan ayam goreng tradisional Indonesia seperti Ayam Goreng Suharti, Fatmawati dan Mbok Berek.";

        view.loadData(text, "text/html", "utf-8");
    }
}
