package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main3Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main3);

        WebView view = (WebView) findViewById(R.id.konten2);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Rawon adalah masakan Indonesia berupa sup daging berkuah hitam sebagai campuran bumbu khas  " +
                "yang mengandung kluwek. Rawon, meskipun dikenal sebagai masakan khas Jawa Timur, dikenal pula oleh masyarakat Jawa Tengah sebelah timur (daerah Surakarta).  " +
                "Rawon pada umumnya terdiri dari daging dan kuah hitam yang pas jadi lauk lezat menggugah selera. Namun kini rawon disajikan sesuai dengan selera. " +
                "Bagi penyuka pedas, rawon juga bisa disajikan dengan rasa yang pedas. Tak heran jika kini banyak " +
                "tempat makan yang menawarkan rawon setan yang memiliki cita rasa pedas. ";

        view.loadData(text, "text/html", "utf-8");
    }
}
