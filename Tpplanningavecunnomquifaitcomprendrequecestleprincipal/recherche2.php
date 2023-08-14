 <?php 
header("Content-Type: text/html");

require_once("constantes.inc.php");

// initialisation du tableau des rendez-vous
// l'index correspon au créneau horaire
// ce tableau à partir du résultat de la requête SQL qui donne les rendez-vous pour une date donnée
for($i = 9; $i <=17; $i++) {
    $tabRDV[$i] = "<vide>";
}

try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
} catch(PDOException $e) {
    echo "problème de connexion\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = date('Y-m-d'); // s'il n'y a pas de date, on prend la date du jour
}

try {
    $requetePreparee = $pdo->prepare('SELECT * FROM rdv JOIN patient on (rdv.id_patient = patient.id_patient) WHERE jour = ?');
    $requetePreparee->bindParam(1, $date, PDO::PARAM_STR);
    $resultat = $requetePreparee->execute();
    if ($resultat) {
        $lignes = $requetePreparee->fetchAll(); // on essaie de récupérer toutes les lignes        
        
        // mise à jour du tableau des rendez-vous
        for($i = 0; $i < count($lignes); $i++) {
            //echo $lignes[$i]['nom'], ' -> ', $lignes[$i]['prenom'], "\n";
            $creneau = $lignes[$i]['creneau'];
            $tabRDV[$creneau] = $lignes[$i]['nom'] . " " . $lignes[$i]['prenom'];
        }
    } else {
        echo "échec\n";
        echo $requetePreparee->errorInfo()[2], "\n";
    }
} catch(PDOException $e) {
    echo "problème avec la requête de sélection\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}


// construction du "body" du tableau HTML à partir du tableau des rendez-vous ($tabRDV) 
for($i = 9; $i <= 17; $i++) { // pour tous les créneaux horaires
    echo "<tr>\n";
    echo '<td>', $i, 'h - ', $i + 1, 'h</td><td title="à remplir">', $tabRDV[$i], "</td>\n";
    echo "</tr>\n";
}

