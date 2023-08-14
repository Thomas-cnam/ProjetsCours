<?php
header('Content-Type: application/json');
require_once("constantes.inc.php");


$numero = $_GET["numero"];
$datejour = $_GET["datejour"];

try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
} catch(PDOException $e) {
    echo '{"reponse": "problème de connexion"}';
    //echo $e->getMessage();
    exit(1); // on arrête le script en renvoyant un code d'erreur choisi par nous
}

try {
    $requetePreparee = $pdo->prepare('SELECT * FROM reservation WHERE numero=? and datejour=?'); // where numero=? and datejour=?
    $requetePreparee->errorInfo();
    $requetePreparee->bindParam(1, $numero, PDO::PARAM_STR);
    $requetePreparee->bindParam(2, $datejour, PDO::PARAM_STR);
    $resultat = $requetePreparee->execute();
    if ($resultat) {
        $lignes = $requetePreparee->fetchAll();
        if (count($lignes) > 0 ){
            echo "[\"0xFF0000\"]";
        }else {
            echo "[\"0x32CD32\"]";
        }

    } else {
        echo '{"reponse": "échec"}';
        /*echo "échec\n";
        echo $pdo->errorInfo()[2], "\n";
        echo $requetePreparee->errorInfo()[2], "\n";
        */
        exit(1);
    }
}
catch(PDOException $e) {
    echo '{"reponse": "problème avec la requête d\'insertion"}';
    //echo "problème avec la requête d'insertion\n";
    //echo $e->getMessage();
    exit(1); // on arrête le script
}
$pdo = NULL; //fermeture de la connexion




?>
