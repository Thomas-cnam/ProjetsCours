package com.example.projetvideosurveillance;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;

public class FormatZip {
    public final static int LONGUEUR = 10_000; // nombre d'octets lus
    private static int fichier = 1;
    private int dossier;
    private String url;
    private int numero;
    private String ip;

    public FormatZip(AtomicInteger dossier, String url, int numero) {
        this.dossier = dossier.get();
        this.url = url;
        this.numero = numero;
        String[] url2 = this.url.split("/");
        this.ip = url2[2];
    }

    public void getFormatDemarrer() {
        File[] listeContenu = lireDossier();
        File fileArchive = new File("/tmp/Camera/" +this.ip + "/Archive_Numero_" + this.dossier);
        fileArchive.mkdir();
        try {
            FileOutputStream fichier = new FileOutputStream("/tmp/Camera/" + this.ip + "/Archive_Numero_" + this.dossier +  "/archive" + this.numero + ".zip");
            ZipOutputStream fichierZIP = new ZipOutputStream(fichier);
            for (File item : listeContenu){
                if (item.isFile()){
                    ajouterEntree(fichierZIP, item.getPath());
                }
            }
            fichierZIP.close();

        }

        catch (IOException ex) {
            System.err.println("erreur lors de l'archivage");
            ex.printStackTrace();
        }
        File file2 = new File("/tmp/Camera/" + this.ip + "/Numero_" + this.dossier);
        if(file2.delete()) {
            System.out.println("dossier supprimer");
        } else {
            File dir2 = new File("/tmp/Camera/" + this.ip + "/Numero_" + this.dossier);
            File[] liste2 = dir2.listFiles();
            for (File item2 : liste2){
                if (item2.isFile()){
                    item2.delete();
                }
            }
            file2.delete();
        }
    }

    private File[] lireDossier() {
        File dir = new File("/tmp/Camera/" + this.ip + "/Numero_" + this.dossier);
        File[] liste = dir.listFiles();
        return liste;
    }

    private void ajouterEntree(ZipOutputStream fichierZIP, String nomFichierAZiper) {
        try {
            ZipEntry entreeZIP = new ZipEntry(nomFichierAZiper);
            fichierZIP.putNextEntry(entreeZIP);

            //System.out.println("nom fichier :" + nomFichierAZiper);
            FileInputStream fichierAZiper = new FileInputStream(nomFichierAZiper);


            byte[] tabDonnees = new byte[LONGUEUR];
            int nbOctetsLus = fichierAZiper.read(tabDonnees);
            while(nbOctetsLus != -1) {
                fichierZIP.write(tabDonnees, 0, nbOctetsLus);
                nbOctetsLus = fichierAZiper.read(tabDonnees);
            }

            fichierAZiper.close();
            fichierZIP.closeEntry();
        } catch (IOException ex) {
            System.err.println("erreur lors de l'archivage xxx");
            System.err.println("nom fichier :" + nomFichierAZiper);
            ex.printStackTrace();
        }
    }
}
