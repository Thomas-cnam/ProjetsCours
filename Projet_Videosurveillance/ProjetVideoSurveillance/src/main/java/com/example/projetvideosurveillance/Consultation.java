package com.example.projetvideosurveillance;

import javafx.application.Platform;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;
import java.io.*;
import java.net.http.HttpClient;
import java.util.Timer;
import java.util.TimerTask;

public class Consultation extends TimerTask {
    private HttpClient client;
    private String url;
    private static int compteur = 0;
    private Boolean existance;
    private String file;
    private Timer timer;
    private String[] liste;
    private int tailleLise;
    private ImageView imageView;
    private GridPane panneau;
    private GridPane panneau2;
    private Stage fenetre;

    public Consultation(HttpClient client, String url, Timer timer, ImageView imageView, GridPane panneau, Stage fenetre) {
        this.client = client;
        this.url = url;
        this.timer = timer;
        this.imageView = imageView;
        this.panneau = panneau;
        this.fenetre = fenetre;
        System.out.println(this.url);
        String[] ip = url.split("/");
        File file = new File(this.url);
        this.file = String.valueOf(file);
        if (file.exists()) {
            existance = true;
            liste = file.list();
            if(liste != null) {
                tailleLise = liste.length;
            } else {
                tailleLise = 0;
            }
        } else {
            existance = false;
        }
        System.out.println(this.file);
    }

    public void stop() {
        fenetre.close();
        fenetre.setScene(panneau.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
        fenetre.show();
    }

    @Override
    public void run() {
        Platform.runLater(new Runnable() {
            public void run() {
                // le traitement a exécuté à intervalle régulier
                Video video1 = new Video(url);
                System.out.println(video1);
                if (compteur++ < tailleLise - 1) {
                    try {
                        FileInputStream inputStream = new FileInputStream(file + "/" + compteur + ".png");
                        Image image = new Image(inputStream);
                        imageView.setImage(image);
                    }catch (FileNotFoundException e) {
                        e.printStackTrace();
                    } catch (IOException e) {
                        e.printStackTrace();
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                } else {
                    timer.cancel();
                    compteur = 0;
//                    fenetre.close();
//                    fenetre.setScene(panneau.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
//                    fenetre.show();
                }
            }
        });
    }

}