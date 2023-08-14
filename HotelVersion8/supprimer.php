<?php
header('Content-Type: application/json');
require_once("constantes.inc.php");

$datejour = $_GET["datejour"];
$numero = $_GET["numero"];



try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
} catch(PDOException $e) {
    echo '{"reponse": "problème de connexion"}';
    //echo $e->getMessage();
    exit(1); // on arrête le script en renvoyant un code d'erreur choisi par nous
}

try {
    $requetePreparee = $pdo->prepare('DELETE FROM reservation WHERE numero=? and datejour=? ');
    $requetePreparee->errorInfo();
    $requetePreparee->bindParam(1, $numero, PDO::PARAM_STR);
    $requetePreparee->bindParam(2, $datejour, PDO::PARAM_STR);

    $resultat = $requetePreparee->execute();
    if ($resultat) {
        echo '{"reponse": "vrai"}';
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
    echo '{"reponse": "problème avec la requête de suppression"}';
    //echo "problème avec la requête d'insertion\n";
    //echo $e->getMessage();
    exit(1); // on arrête le script
}
$pdo = NULL; //fermeture de la connexion




?>
