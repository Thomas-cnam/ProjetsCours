package com.example.projetvideosurveillance;

import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.HPos;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.GridPane;
import javafx.stage.DirectoryChooser;
import javafx.stage.Stage;
import java.io.*;
import java.net.Authenticator;
import java.net.PasswordAuthentication;
import java.net.http.HttpClient;
import java.util.Optional;
import java.util.Timer;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.concurrent.atomic.AtomicReference;

public class Main extends Application {
    @Override
    public void start(Stage fenetre) throws IOException {

        // enregistrement format zip V
        // enregistrement sous fichier incrémenter V
        // lecture avec choix de fichier V
        // changer les ip directements sur les caméras (zone du milieu) ~
        // fenetre attaché à l'avant pour les ips
        // video, pouvoir avancer, mettre en pause, reculer, ... ~

        fenetre.setTitle("Caméra"); // titre de la fenêtre
        fenetre.getIcons().add(new Image(Main.class.getResourceAsStream("a.jpg"))); // mise en place d'une icône (visible dans le panneau)

        GridPane panneau = new GridPane();
        GridPane panneau2 = new GridPane();
        HttpClient HttpClient = null;
        // étiquette
        Label etiquette = new Label("Ip caméras");
        etiquette.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 16.5pt;");

        // créer un client
        HttpClient client = HttpClient.newBuilder()
                .authenticator(new Authenticator() {
                    @Override
                    protected PasswordAuthentication getPasswordAuthentication() {
                        return new PasswordAuthentication("admin", "".toCharArray());
                    }
                })
                .build();

        String fichierParametre = "";
        File file = new File("parametre.txt");
        if (file.exists()) {
            try {
                BufferedReader entree = new BufferedReader(new FileReader("parametre.txt")); // ouverture en lecture
                String ligne = entree.readLine();
                while (ligne != null) {
                    fichierParametre = fichierParametre + ligne;
                    ligne = entree.readLine();
                }
                entree.close();
            } catch (IOException ex) {
                System.err.println("erreur de lecture");
                ex.printStackTrace();
                System.exit(2);
            }
        }
        String[] fichierParametre2 = fichierParametre.split("/");

        // zone de texte
        TextField texte1 = new TextField();
        texte1.setAlignment(Pos.CENTER_RIGHT);
        texte1.setMaxSize(140, 20); // dimension
        texte1.setTooltip(new Tooltip("IP Première caméra : ")); // bulle d'aide
        if (file.exists()) {
            texte1.setText(fichierParametre2[0]);
        }

        // zone de texte
        TextField texte2 = new TextField();
        texte2.setAlignment(Pos.CENTER_RIGHT);
        texte2.setMaxSize(140, 20); // dimension
        texte2.setTooltip(new Tooltip("IP Deuxième caméra : ")); // bulle d'aide
        if (file.exists()) {
            texte2.setText(fichierParametre2[1]);
        }

        // zone de texte
        TextField texte3 = new TextField();
        texte3.setAlignment(Pos.CENTER_RIGHT);
        texte3.setMaxSize(140, 20); // dimension
        texte3.setTooltip(new Tooltip("IP Troisième caméra : ")); // bulle d'aide
        if (file.exists()) {
            texte3.setText(fichierParametre2[2]);
        }

        // zone de texte
        TextField texte4 = new TextField();
        texte4.setAlignment(Pos.CENTER_RIGHT);
        texte4.setMaxSize(140, 20); // dimension
        texte4.setTooltip(new Tooltip("IP Quatrième caméra : ")); // bulle d'aide
        if (file.exists()) {
            texte4.setText(fichierParametre2[3]);
        }


        // création et configuration du bouton Mettre à Zéro
        Button bouton = new Button();
        bouton.setText("Valider");
        bouton.setStyle("-fx-alignment: center;" + "-fx-pref-width: 140px;");
        bouton.setOnAction((ActionEvent event) -> {
            int valide = 1;
            Verification verification = new Verification(texte1.getText());
            try {
                if (!texte1.getText().matches("((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))") || texte1.getText() == null) {
                    valide = 0;
                }
                if (!verification.getVerification()) {
                    texte1.setStyle("-fx-background-color: yellow;"); // on passe le fond en jaune pour signaler l'erreur
                    texte1.setTooltip(new Tooltip("Caméra non connectée. "));
                    valide = 0;
                } else {
                    texte1.setStyle("-fx-background-color: white;"); // on passe le fond en jaune pour signaler l'erreur
                    texte1.setTooltip(new Tooltip("IP Première caméra : ")); // bulle d'aide
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            Verification verification2 = new Verification(texte2.getText());
            try {
                if (!texte2.getText().matches("((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))") || texte2.getText() == null) {
                    valide = 0;
                }
                if (!verification2.getVerification()) {
                    texte2.setStyle("-fx-background-color: yellow;"); // on passe le fond en jaune pour signaler l'erreur
                    texte2.setTooltip(new Tooltip("Caméra non connectée. "));
                    valide = 0;

                } else {
                    texte2.setStyle("-fx-background-color: white;"); // on passe le fond en jaune pour signaler l'erreur
                    texte2.setTooltip(new Tooltip("IP Deuxième caméra : ")); // bulle d'aide
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            Verification verification3 = new Verification(texte3.getText());
            try {
                if (!texte3.getText().matches("((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))") || texte3.getText() == null) {
                    valide = 0;
                }
                if (!verification3.getVerification()) {
                    texte3.setStyle("-fx-background-color: yellow;"); // on passe le fond en jaune pour signaler l'erreur
                    texte3.setTooltip(new Tooltip("Caméra non connectée. "));
                    valide = 0;
                } else {
                    texte3.setStyle("-fx-background-color: white;"); // on passe le fond en jaune pour signaler l'erreur
                    texte3.setTooltip(new Tooltip("IP Troisième caméra : ")); // bulle d'aide
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            Verification verification4 = new Verification(texte4.getText());
            try {
                if (!texte4.getText().matches("((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))") || texte4.getText() == null) {
                    valide = 0;
                }
                if (!verification4.getVerification()) {
                    texte4.setStyle("-fx-background-color: yellow;"); // on passe le fond en jaune pour signaler l'erreur
                    texte4.setTooltip(new Tooltip("Caméra non connectée. "));
                    valide = 0;
                } else {
                    texte4.setStyle("-fx-background-color: white;"); // on passe le fond en jaune pour signaler l'erreur
                    texte4.setTooltip(new Tooltip("IP Quatrième caméra : ")); // bulle d'aide
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            if (valide == 1) {
                panneau.getChildren().remove(etiquette);
                panneau.getChildren().remove(texte1);
                panneau.getChildren().remove(texte2);
                panneau.getChildren().remove(texte3);
                panneau.getChildren().remove(texte4);
                panneau.getChildren().remove(bouton);

                try {
                    PrintWriter sortie = new PrintWriter("parametre.txt");  // ouverture de la sortie
                    sortie.println(texte1.getText() + "/" + texte2.getText() + "/" + texte3.getText() + "/" + texte4.getText());
                    sortie.close(); // fermeture de la sortie
                } catch (IOException ex) {
                    System.err.println("erreur");
                    ex.printStackTrace();
                    System.exit(1);
                }

                Label etiquette2 = new Label("Vidéo Surveillance");
                etiquette2.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 25pt;");

                /* ----------------------Zone vidéo ----------------------------- */
                Video video1 = new Video("http://" + texte1.getText() + "/dms?nowprofileid=1");
                Timer timer1 = new Timer(); // un nouveau timer
                ImageView imageView1 = new ImageView();
                imageView1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 140px;");
                Tache tache1 = new Tache(etiquette2, video1, client, imageView1); // la tâche qui va être exécutée à intervalle régulier
                timer1.schedule(tache1, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                Video video2 = new Video("http://" + texte2.getText() + "/dms?nowprofileid=1");
                Timer timer2 = new Timer(); // un nouveau timer
                ImageView imageView2 = new ImageView();
                imageView2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 140px;");
                Tache tache2 = new Tache(etiquette2, video2, client, imageView2); // la tâche qui va être exécutée à intervalle régulier
                timer2.schedule(tache2, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                Video video3 = new Video("http://" + texte3.getText() + "/dms?nowprofileid=1");
                Timer timer3 = new Timer(); // un nouveau timer
                ImageView imageView3 = new ImageView();
                imageView3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 140px;");
                Tache tache3 = new Tache(etiquette2, video3, client, imageView3); // la tâche qui va être exécutée à intervalle régulier
                timer3.schedule(tache3, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                Video video4 = new Video("http://" + texte4.getText() + "/dms?nowprofileid=1");
                Timer timer4 = new Timer(); // un nouveau timer
                ImageView imageView4 = new ImageView();
                imageView4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 140px;");
                Tache tache4 = new Tache(etiquette2, video4, client, imageView4); // la tâche qui va être exécutée à intervalle régulier
                timer4.schedule(tache4, 0, 200); // appel de la tâche toutes les 1 000 millisecondes


                // -------------------------------- création de la scène de lecture -----------------------------------------
                // panneau sous forme de grille
                panneau2.setGridLinesVisible(false); // utile pour le débogage : passer à true pour voir la grille
                panneau2.setPadding(new Insets(20));
                panneau2.setHgap(10); // écart horizontal
                panneau2.setVgap(10); // écart vertical
                panneau2.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 4;" + "-fx-border-radius: 5;" + "-fx-border-color: blue;");
                AtomicInteger creer = new AtomicInteger();
//                fenetre.setScene(new Scene(panneau2, 700, 600)); // ajout du panneau à une scène, ajout de la scène à la fenêtre


                // ----------------------------------- 1er Caméra -----------------------------------
                final ComboBox<Integer> vitesse = new ComboBox();
                vitesse.setPromptText("1");
//                vitesse.setVisibleRowCount(1);
                final Integer[] choix = {1, 1, 1, 1};
                vitesse.getItems().setAll(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                vitesse.getSelectionModel().selectedItemProperty().addListener(observable -> choix[0] = vitesse.getSelectionModel().getSelectedItem());
                vitesse.getValue();
                EventHandler<ActionEvent> eventchoix = new EventHandler<ActionEvent>() {
                    public void handle(ActionEvent e) {
                        choix[0] = Integer.valueOf((vitesse.getValue()));
                        System.out.println(choix[0]);
                    }
                };
                vitesse.setOnAction(eventchoix);

                // numero camera
                Button boutonIP1 = new Button();
                boutonIP1.setText(texte1.getText());
                boutonIP1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
//                boutonIP1.setOnAction((ActionEvent event38) -> {
//                    TextInputDialog ip1 = new TextInputDialog();
//                    ip1.setTitle("Saisie de l'ip");
//                    ip1.setHeaderText("");
//                    ip1.setContentText("ip : ");
//                    Optional<String> resultat = ip1.showAndWait(); // affiche la fenêtre des dialogues et attend la réponse
//                    resultat.ifPresent(ip -> {
//                        Verification verification12 = new Verification(ip);
//                        try {
//                            if (!ip.matches("((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))(.)((\\d)|(\\d\\d)|(\\d\\d\\d)|(\\d\\d\\d\\d))") || ip == null) {
//                                Alert a = new Alert(Alert.AlertType.NONE, "Erreur de saisie dans l'ip", ButtonType.CLOSE);
//                                a.show();
//                            }
//                            if (!verification12.getVerification()) {
//                                Alert a = new Alert(Alert.AlertType.NONE, "Camera non connectée", ButtonType.CLOSE);
//                                a.show();
//                            } else {
//                                texte1.setText(ip);
//                            }
//                        } catch (IOException e) {
//                            e.printStackTrace();
//                        }
//                    });
//                });

                // droite
                String url1 = "http://" + texte1.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=right&panstep=";
//                String tilstep1 = "&tiltstep=1";
                Position position1 = new Position(url1, client);
                Button boutonDroite1 = new Button();
                boutonDroite1.setText("Droite");
                boutonDroite1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonDroite1.setOnAction((ActionEvent event18) -> {
                    position1.droite(String.valueOf(choix[0]));
                });

                // gauche
                String url2 = "http://" + texte1.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=left&panstep=";
                Position position2 = new Position(url2, client);
                Button boutonGauche1 = new Button();
                boutonGauche1.setText("Gauche");
                boutonGauche1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonGauche1.setOnAction((ActionEvent event19) -> {
                    position2.gauche(String.valueOf(choix[0]));
                });

                // haut
                String url3 = "http://" + texte1.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=up&panstep=";
                Position position3 = new Position(url3, client);
                Button boutonHaut1 = new Button();
                boutonHaut1.setText("Haut");
                boutonHaut1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonHaut1.setOnAction((ActionEvent event20) -> {
                    position3.haut(String.valueOf(choix[0]));
                });

                // bas
                String url4 = "http://" + texte1.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=down&panstep=";
                Position position4 = new Position(url4, client);
                Button boutonBas1 = new Button();
                boutonBas1.setText("Bas");
                boutonBas1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonBas1.setOnAction((ActionEvent event21) -> {
                    position4.bas(String.valueOf(choix[0]));
                });

                // balayage
                String urlBalayage1 = "http://" + texte1.getText() + "/cgi-bin/longcctvapn.cgi?action=go&speed=1";
                Position positionBalayage1 = new Position(urlBalayage1, client);
                // création et configuration du bouton droite
                Button boutonBalayage1 = new Button();
                boutonBalayage1 = positionBalayage1.balayage();

                // enregistrement
                String urlEnregistrementVideo = "http://" + texte1.getText() + "/dms?nowprofileid=1";
                // création et configuration du bouton enregistrement
                Video video01 = new Video(urlEnregistrementVideo);
                Image image01 = video01.getImageView(client);
                AtomicInteger dossier = new AtomicInteger();
                dossier.set(0);
                Button boutonEnregistrement1 = new Button();
                Button boutonStopEnregistrement1 = new Button();
                AtomicReference<Timer> timer01 = new AtomicReference<>(new Timer());

                boutonEnregistrement1.setText("Enregistrement");
                boutonEnregistrement1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonEnregistrement1.setOnAction((ActionEvent event2) -> {
                    timer01.set(video01.demarrerEnregistrement(image01, client, urlEnregistrementVideo, 1));
                    dossier.getAndIncrement();
                    panneau.getChildren().remove(boutonEnregistrement1);
                    panneau.setHalignment(boutonStopEnregistrement1, HPos.LEFT);
                    panneau.add(boutonStopEnregistrement1, 0, 9); // colonne 2, ligne 6
                });

                boutonStopEnregistrement1.setText("Arrêter rec");
                boutonStopEnregistrement1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;" + "-fx-background-color: red;");
                boutonStopEnregistrement1.setOnAction((ActionEvent event2) -> {
                    video01.arreterEnregistrement(image01, client, urlEnregistrementVideo, timer01.get());
                    panneau.getChildren().remove(boutonStopEnregistrement1);
                    panneau.setHalignment(boutonEnregistrement1, HPos.LEFT);
                    panneau.add(boutonEnregistrement1, 0, 9); // colonne 2, ligne 6
                    Alert alerteZIP = new Alert(Alert.AlertType.CONFIRMATION, "Voulez-vous enregistrer en format ZIP ?", ButtonType.YES, ButtonType.NO);
                    alerteZIP.setHeaderText("");
                    Optional<ButtonType> resultatZIP = alerteZIP.showAndWait();
                    resultatZIP.ifPresent(boutonZIP -> {
                        if (boutonZIP.equals(ButtonType.YES)) {
                            FormatZip formatZIP1 = new FormatZip(dossier, urlEnregistrementVideo, 1);
                            formatZIP1.getFormatDemarrer();
                        }
                    });
                });

                // Lecture
                AtomicReference<String> urlLectureVideo = new AtomicReference<>("http://" + texte1.getText() + "/dms?nowprofileid=1");
                // création et configuration du bouton enregistrement
                Video video001 = new Video(urlLectureVideo.get());
                Button boutonLecture = new Button();
                boutonLecture.setText("Lecture");
                boutonLecture.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonLecture.setOnAction((ActionEvent event7) -> {
                    ImageView imageView01 = new ImageView();
                    imageView01.setStyle("-fx-alignment: center;" + "-fx-pref-width: 500px;");
                    DirectoryChooser directoryChooser = new DirectoryChooser();
                    File cheminDefaut1 = new File("/tmp/Camera");
                    directoryChooser.setInitialDirectory(cheminDefaut1);
                    directoryChooser.setTitle("Ouvrir un dossier");
                    File fichier = directoryChooser.showDialog(fenetre);
                    if (fichier != null) {
                        panneau2.getChildren().removeAll();
                        urlLectureVideo.set(fichier.getPath());
                        Timer timer001 = new Timer(); // un nouveau timer
                        Consultation consultation1 = new Consultation(client, urlLectureVideo.get(), timer001, imageView01, panneau, fenetre);
                        timer001.schedule(consultation1, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                        Label etiquette01 = new Label("Visualisation caméra");
                        etiquette01.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 16.5pt;");

                        Button boutonArretLecture1 = new Button();
                        boutonArretLecture1.setText("Stop");
                        boutonArretLecture1.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                        boutonArretLecture1.setOnAction((ActionEvent event35) -> {
                            consultation1.stop();
                        });

                        panneau2.setHalignment(etiquette01, HPos.CENTER);
                        panneau2.setHalignment(boutonArretLecture1, HPos.RIGHT);

                        panneau2.add(etiquette01, 0, 0); // colonne 0, ligne 0
                        panneau2.add(imageView01, 0, 2); // colonne 0, ligne 2
                        panneau2.add(boutonArretLecture1, 0, 3);

                        if (creer.get() == 0) {
                            fenetre.setScene(new Scene(panneau2, 250, 300)); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        } else {
                            fenetre.setScene(panneau2.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        }

                        fenetre.show(); // affichage de la fenêtre
                    } else {
                        // create a alert
                        Alert a = new Alert(Alert.AlertType.NONE, "Erreur de lecture de dossier", ButtonType.CLOSE);
                        a.show();
                    }
                });


                // ----------------------------------- 2eme Caméra -----------------------------------
                final ComboBox<Integer> vitesse2 = new ComboBox();
                vitesse2.setPromptText("1");
                vitesse2.getItems().setAll(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                vitesse2.getSelectionModel().selectedItemProperty().addListener(observable -> choix[1] = vitesse2.getSelectionModel().getSelectedItem());
                vitesse2.getValue();
                EventHandler<ActionEvent> eventchoix2 = new EventHandler<ActionEvent>() {
                    public void handle(ActionEvent e) {
                        choix[1] = Integer.valueOf((vitesse2.getValue()));
                    }
                };
                vitesse2.setOnAction(eventchoix2);

                // numero camera
                Button boutonIP2 = new Button();
                boutonIP2.setText(texte2.getText());
                boutonIP2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");

                // droite
                String url5 = "http://" + texte2.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=right&panstep=";
                Position position5 = new Position(url5, client);
                // création et configuration du bouton droite
                Button boutonDroite2 = new Button();
                boutonDroite2.setText("Droite");
                boutonDroite2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonDroite2.setOnAction((ActionEvent event22) -> {
                    position5.droite(String.valueOf(choix[1]));
                });

                // gauche
                String url6 = "http://" + texte2.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=left&panstep=";
                Position position6 = new Position(url6, client);
                // création et configuration du bouton droite
                Button boutonGauche2 = new Button();
                boutonGauche2.setText("Gauche");
                boutonGauche2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonGauche2.setOnAction((ActionEvent event23) -> {
                    position6.gauche(String.valueOf(choix[1]));
                });

                // haut
                String url7 = "http://" + texte2.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=up&panstep=";
                Position position7 = new Position(url7, client);
                // création et configuration du bouton droite
                Button boutonHaut2 = new Button();
                boutonHaut2.setText("Haut");
                boutonHaut2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonHaut2.setOnAction((ActionEvent event24) -> {
                    position7.haut(String.valueOf(choix[1]));
                });

                // bas
                String url8 = "http://" + texte2.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=down&panstep=";
                Position position8 = new Position(url8, client);
                // création et configuration du bouton droite
                Button boutonBas2 = new Button();
                boutonBas2.setText("Bas");
                boutonBas2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonBas2.setOnAction((ActionEvent event25) -> {
                    position8.bas(String.valueOf(choix[1]));
                });

                // balayage
                String urlBalayage2 = "http://" + texte2.getText() + "/cgi-bin/longcctvapn.cgi?action=go&speed=1";
                Position positionBalayage2 = new Position(urlBalayage2, client);
                // création et configuration du bouton droite
                Button boutonBalayage2 = new Button();
                boutonBalayage2 = positionBalayage2.balayage();

                // enregistrement
                String urlEnregistrementVideo2 = "http://" + texte2.getText() + "/dms?nowprofileid=1";
                // création et configuration du bouton enregistrement
                Video video02 = new Video(urlEnregistrementVideo2);
                Image image02 = video02.getImageView(client);
                AtomicInteger dossier2 = new AtomicInteger();
                dossier2.set(0);
                Button boutonEnregistrement2 = new Button();
                Button boutonStopEnregistrement2 = new Button();
                AtomicReference<Timer> timer02 = new AtomicReference<>(new Timer());

                boutonEnregistrement2.setText("Enregistrement");
                boutonEnregistrement2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonEnregistrement2.setOnAction((ActionEvent event3) -> {
                    timer02.set(video02.demarrerEnregistrement(image02, client, urlEnregistrementVideo2, 2));
                    dossier2.getAndIncrement();
                    panneau.getChildren().remove(boutonEnregistrement2);
                    panneau.setHalignment(boutonStopEnregistrement2, HPos.LEFT);
                    panneau.add(boutonStopEnregistrement2, 2, 9); // colonne 2, ligne 6
                });

                boutonStopEnregistrement2.setText("Arrêter rec");
                boutonStopEnregistrement2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;" + "-fx-background-color: red;");
                boutonStopEnregistrement2.setOnAction((ActionEvent event3) -> {
                    video02.arreterEnregistrement(image02, client, urlEnregistrementVideo2, timer02.get());
                    panneau.getChildren().remove(boutonStopEnregistrement2);
                    panneau.setHalignment(boutonEnregistrement2, HPos.LEFT);
                    panneau.add(boutonEnregistrement2, 2, 9); // colonne 2, ligne 6
                    Alert alerteZIP2 = new Alert(Alert.AlertType.CONFIRMATION, "Voulez-vous enregistrer en format ZIP ?", ButtonType.YES, ButtonType.NO);
                    alerteZIP2.setHeaderText("");
                    Optional<ButtonType> resultatZIP2 = alerteZIP2.showAndWait();
                    resultatZIP2.ifPresent(boutonZIP2 -> {
                        if (boutonZIP2.equals(ButtonType.YES)) {
                            FormatZip formatZIP2 = new FormatZip(dossier2, urlEnregistrementVideo2, 2);
                            formatZIP2.getFormatDemarrer();
                        }
                    });
                });

                // Lecture
                AtomicReference<String> urlLectureVideo2 = new AtomicReference<>("http://" + texte2.getText() + "/dms?nowprofileid=1");
                // création et configuration du bouton enregistrement
                Video video002 = new Video(urlLectureVideo2.get());
                Button boutonLecture2 = new Button();
                boutonLecture2.setText("Lecture");
                boutonLecture2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonLecture2.setOnAction((ActionEvent event8) -> {
                    ImageView imageView02 = new ImageView();
                    imageView02.setStyle("-fx-alignment: center;" + "-fx-pref-width: 500px;");
                    DirectoryChooser directoryChooser = new DirectoryChooser();
                    File cheminDefaut2 = new File("/tmp/Camera");
                    directoryChooser.setInitialDirectory(cheminDefaut2);
                    directoryChooser.setTitle("Ouvrir un dossier");
                    File fichier = directoryChooser.showDialog(fenetre);
                    if (fichier != null) {
                        panneau2.getChildren().removeAll();
//                        GridPane panneau2 = new GridPane();
                        Timer timer002 = new Timer(); // un nouveau timer
                        Consultation consultation2 = new Consultation(client, urlLectureVideo2.get(), timer002, imageView02, panneau, fenetre);
                        timer002.schedule(consultation2, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                        Label etiquette02 = new Label("Visualisation caméra");
                        etiquette02.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 16.5pt;");

                        Button boutonArretLecture2 = new Button();
                        boutonArretLecture2.setText("Stop");
                        boutonArretLecture2.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                        boutonArretLecture2.setOnAction((ActionEvent event46) -> {
                            consultation2.stop();
                        });

                        panneau2.setHalignment(etiquette02, HPos.CENTER);
                        panneau2.setHalignment(boutonArretLecture2, HPos.RIGHT);

                        panneau2.add(etiquette02, 0, 0); // colonne 0, ligne 0
                        panneau2.add(imageView02, 0, 2); // colonne 0, ligne 1
                        panneau2.add(boutonArretLecture2, 0, 3);

                        if (creer.get() == 0) {
                            fenetre.setScene(new Scene(panneau2, 250, 300)); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        } else {
                            fenetre.setScene(panneau2.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        }

                        fenetre.show(); // affichage de la fenêtre
                    } else {
                        // create a alert
                        Alert a = new Alert(Alert.AlertType.NONE, "Erreur de lecture de dossier", ButtonType.CLOSE);
                        a.show();
                    }
                });

                // ----------------------------------- 3ème Caméra -----------------------------------
                final ComboBox<Integer> vitesse3 = new ComboBox();
                vitesse3.setPromptText("1");
                vitesse3.getItems().setAll(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                vitesse3.getSelectionModel().selectedItemProperty().addListener(observable -> choix[2] = vitesse3.getSelectionModel().getSelectedItem());
                vitesse3.getValue();
                EventHandler<ActionEvent> eventchoix3 = new EventHandler<ActionEvent>() {
                    public void handle(ActionEvent e) {
                        choix[2] = Integer.valueOf((vitesse3.getValue()));
                    }
                };
                vitesse3.setOnAction(eventchoix3);

                // numero camera
                Button boutonIP3 = new Button();
                boutonIP3.setText(texte3.getText());
                boutonIP3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");

                // droite
                String url9 = "http://" + texte3.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=right&panstep=";
                Position position9 = new Position(url9, client);
                // création et configuration du bouton droite
                Button boutonDroite3 = new Button();
                boutonDroite3.setText("Droite");
                boutonDroite3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonDroite3.setOnAction((ActionEvent event26) -> {
                    position9.droite(String.valueOf(choix[2]));
                });

                // gauche
                String url10 = "http://" + texte3.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=left&panstep=";
                Position position10 = new Position(url10, client);
                // création et configuration du bouton droite
                Button boutonGauche3 = new Button();
                boutonGauche3.setText("Gauche");
                boutonGauche3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonGauche3.setOnAction((ActionEvent event27) -> {
                    position10.gauche(String.valueOf(choix[2]));
                });

                // haut
                String url11 = "http://" + texte3.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=up&panstep=";
                Position position11 = new Position(url11, client);
                // création et configuration du bouton droite
                Button boutonHaut3 = new Button();
                boutonHaut3.setText("Haut");
                boutonHaut3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonHaut3.setOnAction((ActionEvent event28) -> {
                    position11.haut(String.valueOf(choix[2]));
                });

                // bas
                String url12 = "http://" + texte3.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=down&panstep=";
                Position position12 = new Position(url12, client);
                // création et configuration du bouton droite
                Button boutonBas3 = new Button();
                boutonBas3.setText("Bas");
                boutonBas3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonBas3.setOnAction((ActionEvent event29) -> {
                    position12.bas(String.valueOf(choix[2]));
                });

                // balayage
                String urlBalayage3 = "http://" + texte3.getText() + "/cgi-bin/longcctvapn.cgi?action=go&speed=1";
                Position positionBalayage3 = new Position(urlBalayage3, client);
                // création et configuration du bouton droite
                Button boutonBalayage3 = new Button();
                boutonBalayage3 = positionBalayage3.balayage();

                // enregistrement
                String urlEnregistrementVideo3 = "http://" + texte3.getText() + "/dms?nowprofileid=1";
                // création et configuration du bouton enregistrement
                Video video03 = new Video(urlEnregistrementVideo3);
                Image image03 = video03.getImageView(client);
                AtomicInteger dossier3 = new AtomicInteger();
                dossier3.set(0);
                Button boutonEnregistrement3 = new Button();
                Button boutonStopEnregistrement3 = new Button();
                AtomicReference<Timer> timer03 = new AtomicReference<>(new Timer());

                boutonEnregistrement3.setText("Enregistrement");
                boutonEnregistrement3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonEnregistrement3.setOnAction((ActionEvent event4) -> {
                    timer03.set(video03.demarrerEnregistrement(image03, client, urlEnregistrementVideo3, 3));
                    dossier3.getAndIncrement();
                    panneau.getChildren().remove(boutonEnregistrement3);
                    panneau.setHalignment(boutonStopEnregistrement3, HPos.LEFT);
                    panneau.add(boutonStopEnregistrement3, 0, 16); // colonne 2, ligne 6
                });

                boutonStopEnregistrement3.setText("Arrêter rec");
                boutonStopEnregistrement3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;" + "-fx-background-color: red;");
                boutonStopEnregistrement3.setOnAction((ActionEvent event4) -> {
                    video03.arreterEnregistrement(image03, client, urlEnregistrementVideo3, timer03.get());
                    panneau.getChildren().remove(boutonStopEnregistrement3);
                    panneau.setHalignment(boutonEnregistrement3, HPos.LEFT);
                    panneau.add(boutonEnregistrement3, 0, 16); // colonne 2, ligne 6
                    Alert alerteZIP3 = new Alert(Alert.AlertType.CONFIRMATION, "Voulez-vous enregistrer en format ZIP ?", ButtonType.YES, ButtonType.NO);
                    alerteZIP3.setHeaderText("");
                    Optional<ButtonType> resultatZIP3 = alerteZIP3.showAndWait();
                    resultatZIP3.ifPresent(boutonZIP3 -> {
                        if (boutonZIP3.equals(ButtonType.YES)) {
                            FormatZip formatZIP3 = new FormatZip(dossier3, urlEnregistrementVideo3, 3);
                            formatZIP3.getFormatDemarrer();
                        }
                    });
                });

                // Lecture
                AtomicReference<String> urlLectureVideo3 = new AtomicReference<>("http://" + texte3.getText() + "/dms?nowprofileid=1");
                // création et configuration du bouton enregistrement
                Video video003 = new Video(urlLectureVideo3.get());
                Button boutonLecture3 = new Button();
                boutonLecture3.setText("Lecture");
                boutonLecture3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonLecture3.setOnAction((ActionEvent event9) -> {
                    ImageView imageView03 = new ImageView();
                    imageView03.setStyle("-fx-alignment: center;" + "-fx-pref-width: 500px;");
                    DirectoryChooser directoryChooser = new DirectoryChooser();
                    File cheminDefaut3 = new File("/tmp/Camera");
                    directoryChooser.setInitialDirectory(cheminDefaut3);
                    directoryChooser.setTitle("Ouvrir un dossier");
                    File fichier = directoryChooser.showDialog(fenetre);
                    if (fichier != null) {
                        panneau2.getChildren().removeAll();
//                        GridPane panneau2 = new GridPane();
                        urlLectureVideo3.set(fichier.getPath());

                        Timer timer003 = new Timer(); // un nouveau timer
                        Consultation consultation3 = new Consultation(client, urlLectureVideo3.get(), timer003, imageView03, panneau, fenetre);
                        timer003.schedule(consultation3, 0, 200); // appel de la tâche toutes les 1 000 millisecondes

                        Label etiquette03 = new Label("Visualisation caméra");
                        etiquette03.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 16.5pt;");

                        Button boutonArretLecture3 = new Button();
                        boutonArretLecture3.setText("Stop");
                        boutonArretLecture3.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                        boutonArretLecture3.setOnAction((ActionEvent event45) -> {
                            consultation3.stop();
                        });

                        panneau2.setHalignment(etiquette03, HPos.CENTER);
                        panneau2.setHalignment(boutonArretLecture3, HPos.RIGHT);

                        panneau2.add(etiquette03, 0, 0); // colonne 0, ligne 0
                        panneau2.add(imageView03, 0, 2); // colonne 0, ligne 1
                        panneau2.add(boutonArretLecture3, 0, 3);

                        if (creer.get() == 0) {
                            fenetre.setScene(new Scene(panneau2, 250, 300)); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        } else {
                            fenetre.setScene(panneau2.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        }

                        fenetre.show(); // affichage de la fenêtre
                    } else {
                        // create a alert
                        Alert a = new Alert(Alert.AlertType.NONE, "Erreur de lecture de dossier", ButtonType.CLOSE);
                        a.show();
                    }
                });


                // ----------------------------------- 4ème Caméra -----------------------------------
                final ComboBox<Integer> vitesse4 = new ComboBox();
                vitesse4.setPromptText("1");
                vitesse4.getItems().setAll(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                vitesse4.getSelectionModel().selectedItemProperty().addListener(observable -> choix[3] = vitesse4.getSelectionModel().getSelectedItem());
                vitesse4.getValue();
                EventHandler<ActionEvent> eventchoix4 = new EventHandler<ActionEvent>() {
                    public void handle(ActionEvent e) {
                        choix[3] = Integer.valueOf((vitesse4.getValue()));
                    }
                };
                vitesse4.setOnAction(eventchoix4);

                // numero camera
                Button boutonIP4 = new Button();
                boutonIP4.setText(texte4.getText());
                boutonIP4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");

                // droite
                String url13 = "http://" + texte4.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=right&panstep=";
                Position position13 = new Position(url13, client);
                // création et configuration du bouton droite
                Button boutonDroite4 = new Button();
                boutonDroite4.setText("Droite");
                boutonDroite4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonDroite4.setOnAction((ActionEvent event27) -> {
                    position13.droite(String.valueOf(choix[3]));
                });

                // gauche
                String url14 = "http://" + texte4.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=left&panstep=";
                Position position14 = new Position(url14, client);
                // création et configuration du bouton droite
                Button boutonGauche4 = new Button();
                boutonGauche4.setText("Gauche");
                boutonGauche4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonGauche4.setOnAction((ActionEvent event28) -> {
                    position14.gauche(String.valueOf(choix[3]));
                });

                // haut
                String url15 = "http://" + texte4.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=up&panstep=";
                Position position15 = new Position(url15, client);
                // création et configuration du bouton droite
                Button boutonHaut4 = new Button();
                boutonHaut4.setText("Haut");
                boutonHaut4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonHaut4.setOnAction((ActionEvent event29) -> {
                    position15.haut(String.valueOf(choix[3]));
                });

                // bas
                String url16 = "http://" + texte4.getText() + "/cgi-bin/longcctvmove.cgi?action=move&direction=down&panstep=";
                Position position16 = new Position(url16, client);
                // création et configuration du bouton droite
                Button boutonBas4 = new Button();
                boutonBas4.setText("Bas");
                boutonBas4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonBas4.setOnAction((ActionEvent event30) -> {
                    position16.bas(String.valueOf(choix[3]));
                });

                // balayage
                String urlBalayage4 = "http://" + texte4.getText() + "/cgi-bin/longcctvapn.cgi?action=go&speed=1";
                Position positionBalayage4 = new Position(urlBalayage4, client);
                // création et configuration du bouton droite
                Button boutonBalayage4 = new Button();
                boutonBalayage4 = positionBalayage4.balayage();

                // enregistrement
                String urlEnregistrementVideo4 = "http://" + texte4.getText() + "/dms?nowprofileid=1";
                // création et configuration du bouton enregistrement
                Video video04 = new Video(urlEnregistrementVideo4);
                Image image04 = video04.getImageView(client);
                AtomicInteger dossier4 = new AtomicInteger();
                dossier4.set(0);
                Button boutonEnregistrement4 = new Button();
                Button boutonStopEnregistrement4 = new Button();
                AtomicReference<Timer> timer04 = new AtomicReference<>(new Timer());

                boutonEnregistrement4.setText("Enregistrement");
                boutonEnregistrement4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonEnregistrement4.setOnAction((ActionEvent event5) -> {
                    timer04.set(video04.demarrerEnregistrement(image04, client, urlEnregistrementVideo4, 4));
                    dossier4.getAndIncrement();
                    panneau.getChildren().remove(boutonEnregistrement4);
                    panneau.setHalignment(boutonStopEnregistrement4, HPos.LEFT);
                    panneau.add(boutonStopEnregistrement4, 2, 16); // colonne 2, ligne 6
                });

                boutonStopEnregistrement4.setText("Arrêter rec");
                boutonStopEnregistrement4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;" + "-fx-background-color: red;");
                boutonStopEnregistrement4.setOnAction((ActionEvent event5) -> {
                    video04.arreterEnregistrement(image04, client, urlEnregistrementVideo4, timer04.get());
                    panneau.getChildren().remove(boutonStopEnregistrement4);
                    panneau.setHalignment(boutonEnregistrement4, HPos.LEFT);
                    panneau.add(boutonEnregistrement4, 2, 16); // colonne 2, ligne 6
                    Alert alerteZIP4 = new Alert(Alert.AlertType.CONFIRMATION, "Voulez-vous enregistrer en format ZIP ?", ButtonType.YES, ButtonType.NO);
                    alerteZIP4.setHeaderText("");
                    Optional<ButtonType> resultatZIP4 = alerteZIP4.showAndWait();
                    resultatZIP4.ifPresent(boutonZIP4 -> {
                        if (boutonZIP4.equals(ButtonType.YES)) {
                            FormatZip formatZIP4 = new FormatZip(dossier4, urlEnregistrementVideo4, 4);
                            formatZIP4.getFormatDemarrer();
                        }
                    });
                });

                // Lecture
                AtomicReference<String> urlLectureVideo4 = new AtomicReference<>("http://" + texte4.getText() + "/dms?nowprofileid=1");
                // création et configuration du bouton enregistrement
                Video video004 = new Video(urlLectureVideo4.get());
                Button boutonLecture4 = new Button();
                boutonLecture4.setText("Lecture");
                boutonLecture4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                boutonLecture4.setOnAction((ActionEvent event10) -> {
                    ImageView imageView04 = new ImageView();
                    imageView04.setStyle("-fx-alignment: center;" + "-fx-pref-width: 500px;");
                    DirectoryChooser directoryChooser = new DirectoryChooser();
                    File cheminDefaut4 = new File("/tmp/Camera");
                    directoryChooser.setInitialDirectory(cheminDefaut4);
                    directoryChooser.setTitle("Ouvrir un dossier");
                    File fichier = directoryChooser.showDialog(fenetre);
                    if (fichier != null) {
                        panneau2.getChildren().removeAll();
//                        GridPane panneau2 = new GridPane();
                        urlLectureVideo4.set(fichier.getPath());

                        Timer timer004 = new Timer(); // un nouveau timer
                        Consultation consultation4 = new Consultation(client, urlLectureVideo4.get(), timer004, imageView04, panneau, fenetre);
                        timer004.schedule(consultation4, 0, 200); // appel de la tâche toutes les 1 000 millisecondes


                        Label etiquette04 = new Label("Visualisation caméra");
                        etiquette04.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 2;" + "-fx-font-size: 16.5pt;");

                        Button boutonArretLecture4 = new Button();
                        boutonArretLecture4.setText("Stop");
                        boutonArretLecture4.setStyle("-fx-alignment: center;" + "-fx-pref-width: 150px;");
                        boutonArretLecture4.setOnAction((ActionEvent event35) -> {
                            consultation4.stop();
                        });

                        panneau2.setHalignment(etiquette04, HPos.CENTER);
                        panneau2.setHalignment(boutonArretLecture4, HPos.RIGHT);

                        panneau2.add(etiquette04, 0, 0); // colonne 0, ligne 0
                        panneau2.add(imageView04, 0, 2); // colonne 0, ligne 1
                        panneau2.add(boutonArretLecture4, 0, 3);

                        if (creer.get() == 0) {
                            fenetre.setScene(new Scene(panneau2, 250, 300)); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        } else {
                            fenetre.setScene(panneau2.getScene()); // ajout du panneau à une scène, ajout de la scène à la fenêtre
                            creer.set(1);
                        }

                        fenetre.show(); // affichage de la fenêtre
                    } else {
                        // create a alert
                        Alert a = new Alert(Alert.AlertType.NONE, "Erreur de lecture de dossier", ButtonType.CLOSE);
                        a.show();
                    }
                });

                /* ----------------------Bouton retour ----------------------------- */
                Button boutonRetour = new Button();
                boutonRetour.setText("Retour");
                boutonRetour.setStyle("-fx-alignment: center;" + "-fx-pref-width: 300px;");
                boutonRetour.setOnAction((ActionEvent event11) -> {
                    fenetre.close();
                    try {
                        start(fenetre);
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                });

                /* ----------------------Bouton Quitter ----------------------------- */
                Button boutonQuitter = new Button();
                boutonQuitter.setText("Quitter");
                boutonQuitter.setStyle("-fx-alignment: center;" + "-fx-pref-width: 300px;");
                boutonQuitter.setOnAction((ActionEvent event65) -> {
                    fenetre.close();
                });

                panneau.add(etiquette2, 0, 0); // colonne 2, ligne 0

                panneau.setHalignment(boutonDroite1, HPos.RIGHT);
                panneau.setHalignment(boutonHaut1, HPos.CENTER);
                panneau.setHalignment(boutonBas1, HPos.CENTER);
                panneau.setHalignment(boutonGauche1, HPos.LEFT);
                panneau.setHalignment(boutonBalayage1, HPos.LEFT);
                panneau.setHalignment(boutonEnregistrement1, HPos.LEFT);
                panneau.setHalignment(boutonLecture, HPos.RIGHT);
                panneau.setHalignment(boutonIP1, HPos.CENTER);
                panneau.setHalignment(vitesse, HPos.RIGHT);

                panneau.add(imageView1, 0, 8);
                panneau.add(boutonHaut1, 0, 9); // colonne 2, ligne 2
                panneau.add(boutonGauche1, 0, 10); // colonne 0, ligne 4
                panneau.add(boutonDroite1, 0, 10); // colonne 4, ligne 4
                panneau.add(boutonBas1, 0, 11); // colonne 2, ligne 6
                panneau.add(boutonBalayage1, 0, 11); // colonne 2, ligne 6
                panneau.add(boutonEnregistrement1, 0, 9); // colonne 2, ligne 6
                panneau.add(boutonLecture, 0, 9); // colonne 2, ligne 6
                panneau.add(boutonIP1, 0, 10);
                panneau.add(vitesse, 0, 11); // colonne 2, ligne 6

                panneau.setHalignment(boutonDroite2, HPos.RIGHT);
                panneau.setHalignment(boutonHaut2, HPos.CENTER);
                panneau.setHalignment(boutonBas2, HPos.CENTER);
                panneau.setHalignment(boutonGauche2, HPos.LEFT);
                panneau.setHalignment(boutonBalayage2, HPos.LEFT);
                panneau.setHalignment(boutonEnregistrement2, HPos.LEFT);
                panneau.setHalignment(boutonLecture2, HPos.RIGHT);
                panneau.setHalignment(boutonIP2, HPos.CENTER);
                panneau.setHalignment(vitesse2, HPos.RIGHT);

                panneau.add(imageView2, 2, 8);
                panneau.add(boutonHaut2, 2, 9); // colonne 2, ligne 2
                panneau.add(boutonGauche2, 2, 10); // colonne 0, ligne 4
                panneau.add(boutonDroite2, 2, 10); // colonne 4, ligne 4
                panneau.add(boutonBas2, 2, 11); // colonne 2, ligne 6
                panneau.add(boutonBalayage2, 2, 11); // colonne 2, ligne 6
                panneau.add(boutonEnregistrement2, 2, 9); // colonne 2, ligne 6
                panneau.add(boutonLecture2, 2, 9); // colonne 2, ligne 6
                panneau.add(boutonIP2, 2, 10);
                panneau.add(vitesse2, 2, 11); // colonne 2, ligne 6

                panneau.setHalignment(boutonDroite3, HPos.RIGHT);
                panneau.setHalignment(boutonHaut3, HPos.CENTER);
                panneau.setHalignment(boutonBas3, HPos.CENTER);
                panneau.setHalignment(boutonGauche3, HPos.LEFT);
                panneau.setHalignment(boutonBalayage3, HPos.LEFT);
                panneau.setHalignment(boutonEnregistrement3, HPos.LEFT);
                panneau.setHalignment(boutonLecture3, HPos.RIGHT);
                panneau.setHalignment(boutonIP3, HPos.CENTER);
                panneau.setHalignment(vitesse3, HPos.RIGHT);

                panneau.add(imageView3, 0, 15);
                panneau.add(boutonHaut3, 0, 16); // colonne 2, ligne 2
                panneau.add(boutonGauche3, 0, 17); // colonne 0, ligne 4
                panneau.add(boutonDroite3, 0, 17); // colonne 4, ligne 4
                panneau.add(boutonBas3, 0, 18); // colonne 2, ligne 6
                panneau.add(boutonBalayage3, 0, 18); // colonne 2, ligne 6
                panneau.add(boutonEnregistrement3, 0, 16); // colonne 2, ligne 6
                panneau.add(boutonLecture3, 0, 16); // colonne 2, ligne 6
                panneau.add(boutonIP3, 0, 17);
                panneau.add(vitesse3, 0, 18); // colonne 2, ligne 6

                panneau.setHalignment(boutonDroite4, HPos.RIGHT);
                panneau.setHalignment(boutonHaut4, HPos.CENTER);
                panneau.setHalignment(boutonBas4, HPos.CENTER);
                panneau.setHalignment(boutonGauche4, HPos.LEFT);
                panneau.setHalignment(boutonBalayage4, HPos.LEFT);
                panneau.setHalignment(boutonEnregistrement4, HPos.LEFT);
                panneau.setHalignment(boutonLecture4, HPos.RIGHT);
                panneau.setHalignment(boutonIP4, HPos.CENTER);
                panneau.setHalignment(vitesse4, HPos.RIGHT);

                panneau.add(imageView4, 2, 15);
                panneau.add(boutonHaut4, 2, 16); // colonne 2, ligne 2
                panneau.add(boutonGauche4, 2, 17); // colonne 0, ligne 4
                panneau.add(boutonDroite4, 2, 17); // colonne 4, ligne 4
                panneau.add(boutonBas4, 2, 18); // colonne 2, ligne 6
                panneau.add(boutonBalayage4, 2, 18); // colonne 2, ligne 6
                panneau.add(boutonEnregistrement4, 2, 16); // colonne 2, ligne 6
                panneau.add(boutonLecture4, 2, 16); // colonne 2, ligne 6
                panneau.add(boutonIP4, 2, 17);
                panneau.add(vitesse4, 2, 18); // colonne 2, ligne 6

                panneau.setHalignment(boutonRetour, HPos.LEFT);
                panneau.setHalignment(boutonQuitter, HPos.RIGHT);
                panneau.add(boutonRetour, 0, 25); // colonne 2, ligne 6
                panneau.add(boutonQuitter, 2, 25); // colonne 2, ligne 6
            }
        });

        // panneau sous forme de grille
        panneau.setGridLinesVisible(false); // utile pour le débogage : passer à true pour voir la grille
        panneau.setPadding(new Insets(20));
        panneau.setHgap(10); // écart horizontal
        panneau.setVgap(10); // écart vertical
        panneau.setStyle("-fx-border-style: solid inside;" + "-fx-border-width: 4;" + "-fx-border-radius: 5;" + "-fx-border-color: blue;");

        panneau.add(etiquette, 0, 0); // colonne 0, ligne 0
        panneau.add(texte1, 0, 2); // colonne 0, ligne 1
        panneau.add(texte2, 0, 4); // colonne 0, ligne 1
        panneau.add(texte3, 0, 6); // colonne 0, ligne 1
        panneau.add(texte4, 0, 8); // colonne 0, ligne 1
        panneau.add(bouton, 4, 10);

        fenetre.setScene(new Scene(panneau, 500, 500)); // ajout du panneau à une scène, ajout de la scène à la fenêtre
        fenetre.show(); // affichage de la fenêtre
    }

    public static void main(String[] args) {
        launch();
    }
}
