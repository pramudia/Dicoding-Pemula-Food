package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main4Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main4);
        WebView view = (WebView) findViewById(R.id.konten3);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Sate atau satai banyak ditemui hampir seluruh wilayah di Indonesia. Tidak salah jika sate memiliki peringkat ke 14 sebagai makanan terlezat di dunia   " +
                "dengan rendang berada di puncak pertama. Uniknya sate yang berasal dari Jawa ini ditemui di hampir   " +
                "seluruh daerah di Indonesia dengan cita rasanya yang berbeda. " +
                "Sate memiliki cita rasa yang khas dengan bahan dasar aneka daging dari ayam, kambing, hingga  " +
                "kelinci. Uniknya sate memiliki variasi yang berbeda, seperti saos kacang yang gurih salah satunya. ";

        view.loadData(text, "text/html", "utf-8");
    }
}
