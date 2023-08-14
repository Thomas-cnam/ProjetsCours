package com.example.projetvideosurveillance;

import javafx.event.ActionEvent;
import javafx.scene.control.Button;
import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

public class Position extends Main{
    private String url;
    private HttpClient client;
    public Position(String url, HttpClient client) {
        this.url = url;
        this.client = client;
    }

    public void droite(String panstep) {
        // créer une requête
        var requete = HttpRequest.newBuilder(
                        URI.create(this.url + panstep + "&tiltstep=1"))
//                    .setHeader("User-Agent", "Mozilla/5.0 (X11; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/107.0")
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = this.client.send(requete, HttpResponse.BodyHandlers.ofString());
            System.out.println("Status  : " + reponse.statusCode());
            System.out.println("Headers : " + reponse.headers());
            System.out.println("Body    : " + reponse.body());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }

    public void gauche(String panstep) {
        // créer une requête
        var requete = HttpRequest.newBuilder(
                        URI.create(this.url + panstep + "&tiltstep=1"))
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
            System.out.println("Status  : " + reponse.statusCode());
            System.out.println("Headers : " + reponse.headers());
            System.out.println("Body    : " + reponse.body());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }

    public void haut(String panstep) {
        // créer une requête
        var requete = HttpRequest.newBuilder(
                        URI.create(this.url + panstep + "&tiltstep=1"))
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
            System.out.println("Status  : " + reponse.statusCode());
            System.out.println("Headers : " + reponse.headers());
            System.out.println("Body    : " + reponse.body());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }

    public void bas(String panstep) {
        // créer une requête
        var requete = HttpRequest.newBuilder(
                        URI.create(this.url + "1&tiltstep=1"))
//                    .setHeader("User-Agent", "Mozilla/5.0 (X11; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/107.0")
                .GET()
                .build();

        // envoie la requête et attends une réponse
        HttpResponse reponse;
        try {
            reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
            System.out.println("Status  : " + reponse.statusCode());
            System.out.println("Headers : " + reponse.headers());
            System.out.println("Body    : " + reponse.body());
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }

    public Button balayage() {
        // création et configuration du bouton balayage
        Button boutonBalayage = new Button();
        boutonBalayage.setText("Balayage");
        boutonBalayage.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
        boutonBalayage.setOnAction((ActionEvent event) -> {

            // créer une requête
            var requete = HttpRequest.newBuilder(
                            URI.create(this.url))
                    .GET()
                    .build();
            // envoie la requête et attends une réponse
            HttpResponse reponse;
            try {
                reponse = client.send(requete, HttpResponse.BodyHandlers.ofString());
                System.out.println("Status  : " + reponse.statusCode());
                System.out.println("Headers : " + reponse.headers());
                System.out.println("Body    : " + reponse.body());
            } catch (IOException | InterruptedException e) {
                e.printStackTrace();
            }
        });
        return boutonBalayage;
    }

}
