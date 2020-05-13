package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;

public class Main2Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        WebView view = (WebView) findViewById(R.id.konten1);
        String text;
        text = "<html><body><p align=\"justify\">";
        text+= "Rendang adalah masakan yang mengandung bumbu rempah yang kaya. Selain bahan dasar daging, " +
                "rendang menggunakan santan kelapa (karambia), dan campuran dari berbagai bumbu khas yang  " +
                "dihaluskan di antaranya cabai (lado), serai, lengkuas, kunyit, jahe, bawang putih, bawang merah" +
                "dan aneka bumbu lainnya yang biasanya disebut sebagai pemasak. Keunikan rendang adalah penggunaan bumbu-bumbu alami, yang bersifat antiseptik dan membunuh  " +
                "bakteri patogen sehingga bersifat sebagai bahan pengawet alami. Bawang putih, bawang merah, jahe,  " +
                "dan lengkuas diketahui memiliki aktivitas antimikroba yang kuat.[7] Tidak mengherankan jika rendang dapat disimpan satu minggu hingga empat minggu. ";
        text+= "</p></body></html>";
        view.loadData(text, "text/html", "utf-8");
    }
}
