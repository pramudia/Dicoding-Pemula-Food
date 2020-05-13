package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main7Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main7);


        WebView view = (WebView) findViewById(R.id.konten6);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Sup buntut dibuat dengan ekor sapi. Sedikitnya ada lima versi sup buntut yang populer di seluruh dunia:    " +
                "makanan tradisional Korea, makanan Tiongkok yang lebih mirip semur, ekor sapi goreng/panggang dicampur  " +
                "dengan berbagai variasi sup merupakan makanan populer di Indonesia, makanan etnis Amerika Serikat bagian Selatan yang sudah ada sejak periode sebelum perang revolusi, dan sup kuah tebal dan gurih yang populer di Britania Raya sejak abad ke-18. " +
                "Sup buntut Kreol dibuat dari tomat dengan ekor sapi, kentang, kacang hijau, jagung, mirepoix, bawang putih, dan rempah-rempah. " ;

        view.loadData(text, "text/html", "utf-8");

    }
}
