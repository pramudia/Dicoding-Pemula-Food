package com.example.foodrecipes;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.GridLayout;
import android.widget.ImageView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity{
private  Button detail1, detail2, detail3, detail4, detail5, detail6, detail7,detail8,detail9,detail10;
ImageView image;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        image = findViewById(R.id.profile);
        image.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent startIntent = new Intent(getApplicationContext(), profile.class);
                startActivity(startIntent);
            }
        });


        detail1 = (Button) findViewById(R.id.detail1);
        detail2 = (Button) findViewById(R.id.detail2);
        detail3 = (Button) findViewById(R.id.detail3);
        detail4 = (Button) findViewById(R.id.detail4);
        detail5 = (Button) findViewById(R.id.detail5);
        detail6 = (Button) findViewById(R.id.detail6);
        detail7 = (Button) findViewById(R.id.detail7);
        detail8 = (Button) findViewById(R.id.detail8);
        detail9 = (Button) findViewById(R.id.detail9);
        detail10 = (Button) findViewById(R.id.detail10);

        detail1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main2Activity.class);
                startActivity(startIntent);
            }
        });


        detail2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main3Activity.class);
                startActivity(startIntent);
            }
        });

        detail3.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main4Activity.class);
                startActivity(startIntent);
            }
        });

        detail4.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main5Activity.class);
                startActivity(startIntent);
            }
        });

        detail5.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main6Activity.class);
                startActivity(startIntent);
            }
        });

        detail6.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main7Activity.class);
                startActivity(startIntent);
            }
        });

        detail7.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main8Activity.class);
                startActivity(startIntent);
            }
        });

        detail8.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main9Activity.class);
                startActivity(startIntent);
            }
        });

        detail9.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main10Activity.class);
                startActivity(startIntent);
            }
        });

        detail10.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent startIntent = new Intent(getApplicationContext(), Main11Activity.class);
                startActivity(startIntent);
            }
        });
    }

}
