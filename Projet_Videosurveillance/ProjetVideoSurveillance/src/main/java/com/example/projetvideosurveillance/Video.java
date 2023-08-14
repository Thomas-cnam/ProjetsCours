package com.example.projetvideosurveillance;

import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.Timer;


public class Video extends Main{
    private String url;
    public Video(String url) {
        this.url = url;
    }

    public Image getImageView (HttpClient client) {
        var requete = HttpRequest.newBuilder(
                URI.create(this.url))
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }

        HttpResponse<InputStream> response;
        try {
            response = client
                    .send(requete, HttpResponse.BodyHandlers.ofInputStream());
        } catch (IOException e) {
            e.printStackTrace();
            throw new RuntimeException(e);
        } catch (InterruptedException e) {
            e.printStackTrace();
            throw new RuntimeException(e);
        }

        Image image1 = new Image(response.body());

        return image1;
    }
    public InputStream getInputStream (HttpClient client) {
        var requete = HttpRequest.newBuilder(
                        URI.create(this.url))
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }

        HttpResponse<InputStream> response;
        try {
            response = client
                    .send(requete, HttpResponse.BodyHandlers.ofInputStream());
        } catch (IOException e) {
            e.printStackTrace();
            throw new RuntimeException(e);
        } catch (InterruptedException e) {
            e.printStackTrace();
            throw new RuntimeException(e);
        }

        return response.body();
    }
    public Timer demarrerEnregistrement(Image image, HttpClient client, String url, int numero) {
        Timer timer1 = new Timer(); // un nouveau timer
        Enregistrement tache2 = new Enregistrement(client, url, numero); // la tâche qui va être exécutée à intervalle régulier
        timer1.schedule(tache2, 0, 200); // appel de la tâche toutes les 1 000 millisecondes
        return timer1;
    }

    public void arreterEnregistrement(Image image, HttpClient client, String url, Timer timer) {
        timer.cancel();
    }

    public void demarrerLecture(String url, HttpClient client, ImageView imageView, GridPane panneau, Stage fenetre) {
        Timer timer2 = new Timer(); // un nouveau timer
        Consultation tache2 = new Consultation(client, url, timer2, imageView, panneau, fenetre); // la tâche qui va être exécutée à intervalle régulier
        timer2.schedule(tache2, 0, 200); // appel de la tâche toutes les 1 000 millisecondes
    }
}
