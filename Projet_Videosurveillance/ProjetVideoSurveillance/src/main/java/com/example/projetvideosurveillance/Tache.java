package com.example.projetvideosurveillance;

import javafx.application.Platform;
import javafx.scene.control.Label;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import java.net.URL;
import java.net.http.HttpClient;
import java.util.TimerTask;

public class Tache extends TimerTask {
    private static int compteur = 0;
    private Label etiquette;
    private Video video;
    private HttpClient client;
    private ImageView imageView;

    public Tache(Label etiquette, Video video, HttpClient client, ImageView imageView) {
        this.etiquette = etiquette;
        this.video = video;
        this.client = client;
        this.imageView = imageView;
    }

    @Override
    public void run() {
        Platform.runLater(new Runnable() {
            public void run() {
                // le traitement a exécuté à intervalle régulier
                Image image2 = video.getImageView(client);
                imageView.setImage(image2);
            }
        });
    }

}