import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;

/**
 * DemoZip
 */
public class DemoZip {
    public final static int LONGUEUR = 10_000; // nombre d'octets lus

    /**
     * le constructeur par défaut (sans paramètre)
     */
    public DemoZip() {
    }

    
    /**
     * point d'entrée du programme
     */
    public static void main(String[] args) {
        DemoZip demoZip = new DemoZip(); // l'objet représentant l'application est créé
        demoZip.demarrer();
    }

    
    /**
     * méthode démarrer : démarre l'application proprement dite
     */    
    private void demarrer() {
        try {
            FileOutputStream fichier = new FileOutputStream("archive.zip");
            ZipOutputStream fichierZIP = new ZipOutputStream(fichier);

            ajouterEntree(fichierZIP, "a.jpg");
            ajouterEntree(fichierZIP, "b.jpg");
            ajouterEntree(fichierZIP, "c.jpg");
            ajouterEntree(fichierZIP, "d.jpg");
            ajouterEntree(fichierZIP, "e.png");

            fichierZIP.close();
        }

        catch (IOException ex) {
            System.err.println("erreur lors de l'archivage");
            ex.printStackTrace();
        }
    }

    private void ajouterEntree(ZipOutputStream fichierZIP, String nomFichierAZiper) {
        try {
            ZipEntry entreeZIP = new ZipEntry(nomFichierAZiper);
            fichierZIP.putNextEntry(entreeZIP);

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
            System.err.println("erreur lors de l'archivage");
            ex.printStackTrace();
        }
    }
}
