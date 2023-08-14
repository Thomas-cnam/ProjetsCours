package com.example.projetvideosurveillance;

import javafx.application.Platform;
import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.net.http.HttpClient;
import java.util.TimerTask;
import java.util.concurrent.atomic.AtomicInteger;

public class Enregistrement extends TimerTask {
    private HttpClient client;
    private String url;
    private static int compteur = 1;

    private static int compteurFichier1 = 0;

    private static int compteurFichier2 = 0;

    private static int compteurFichier3 = 0;

    private static int compteurFichier4 = 0;

    private int numero;
    private boolean existance;
    private boolean zip;
    private String file;

    public Enregistrement(HttpClient client, String url, int numero) {
        this.client = client;
        this.url = url;
        this.numero = numero;
        this.zip = zip;
        String[] ip = url.split("/");
        File file4 = new File("/tmp/Camera/" + ip[2]);
        compteur = 1;
        if (file4.exists()) {
            if (this.numero == 1) {
                compteurFichier1++;
                File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier1);
                if (file.exists()){
                    existance = true;
                    this.file = String.valueOf(file);
                } else {
                    if (file.mkdir()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        File file2 = new File("/tmp/Camera");
                        file2.mkdir();
                        File file3 = new File("/tmp/Camera/Save");
                        file3.mkdir();
                        existance = false;
                    }
                }
            }
            if (this.numero == 2) {
                compteurFichier2++;
                File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier2);
                if (file.exists()){
                    existance = true;
                    this.file = String.valueOf(file);
                } else {
                    if (file.mkdir()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        File file2 = new File("/tmp/Camera");
                        file2.mkdir();
                        File file3 = new File("/tmp/Camera/Save");
                        file3.mkdir();
                        existance = false;
                    }
                }
            }
            if (this.numero == 3) {
                compteurFichier3++;
                File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier3);
                if (file.exists()){
                    existance = true;
                    this.file = String.valueOf(file);
                } else {
                    if (file.mkdir()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        File file2 = new File("/tmp/Camera");
                        file2.mkdir();
                        File file3 = new File("/tmp/Camera/Save");
                        file3.mkdir();
                        existance = false;
                    }
                }
            }
            if (this.numero == 4) {
                compteurFichier4++;
                File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier4);
                if (file.exists()){
                    existance = true;
                    this.file = String.valueOf(file);
                } else {
                    if (file.mkdir()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        File file2 = new File("/tmp/Camera");
                        file2.mkdir();
                        File file3 = new File("/tmp/Camera/Save");
                        file3.mkdir();
                        existance = false;
                    }
                }
            }
        } else {
            if (file4.mkdir()) {
                if (this.numero == 1) {
                    compteurFichier1++;
                    File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier1);
                    if (file.exists()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        if (file.mkdir()) {
                            existance = true;
                            this.file = String.valueOf(file);
                        } else {
                            File file2 = new File("/tmp/Camera");
                            file2.mkdir();
                            File file3 = new File("/tmp/Camera/Save");
                            file3.mkdir();
                            existance = false;
                        }
                    }
                }
                if (this.numero == 2) {
                    compteurFichier2++;
                    File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier2);
                    if (file.exists()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        if (file.mkdir()) {
                            existance = true;
                            this.file = String.valueOf(file);
                        } else {
                            File file2 = new File("/tmp/Camera");
                            file2.mkdir();
                            File file3 = new File("/tmp/Camera/Save");
                            file3.mkdir();
                            existance = false;
                        }
                    }
                }
                if (this.numero == 3) {
                    compteurFichier3++;
                    File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier3);
                    if (file.exists()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        if (file.mkdir()) {
                            existance = true;
                            this.file = String.valueOf(file);
                        } else {
                            File file2 = new File("/tmp/Camera");
                            file2.mkdir();
                            File file3 = new File("/tmp/Camera/Save");
                            file3.mkdir();
                            existance = false;
                        }
                    }
                }
                if (this.numero == 4) {
                    compteurFichier4++;
                    File file = new File("/tmp/Camera/" + ip[2] + "/Numero_" + compteurFichier4);
                    if (file.exists()) {
                        existance = true;
                        this.file = String.valueOf(file);
                    } else {
                        if (file.mkdir()) {
                            existance = true;
                            this.file = String.valueOf(file);
                        } else {
                            File file2 = new File("/tmp/Camera");
                            file2.mkdir();
                            File file3 = new File("/tmp/Camera/Save");
                            file3.mkdir();
                            existance = false;
                        }
                    }
                }
            } else {
                File file2 = new File("/tmp/Camera");
                file2.mkdir();
                File file3 = new File("/tmp/Camera/Save");
                file3.mkdir();
                existance = false;
                this.file = String.valueOf(file);
            }
        }
//        System.out.println(this.file);
    }

//    public void getFormatZIP(AtomicInteger dossier) {
//        FormatZip formatZip1 = new FormatZip(dossier, this.url, this.numero);
//        formatZip1.getFormatDemarrer();
//    }

    @Override
    public void run() {
        Platform.runLater(new Runnable() {
            public void run() {
                // le traitement a exécuté à intervalle régulier
                Video video1 = new Video(url);
                try {
                    InputStream i1 = video1.getInputStream(client);
                    BufferedImage bImage = ImageIO.read(i1);
                    File outputfile = null;
                    if (existance) {
                        outputfile = new File(file + "/" + compteur++ + ".png");
                    } else {
                        outputfile = new File("/tmp/Camera/Save/save" + compteur++ + ".png");
                    }
                    ImageIO.write(bImage, "png", outputfile);
                } catch (IOException e) {
                    System.out.println("Unable to write file");
                    System.out.println(e.getStackTrace());
                }
            }
        });
    }

}