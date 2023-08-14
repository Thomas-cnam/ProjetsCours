<?php

require_once("constantes.php");


$nom = $_GET['nom'];
$lat = $_GET['lat'];
$long = $_GET['long'];

try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
} catch (PDOException $e) {
    echo "problème de connexion\n";
    echo $e->getMessage();
    exit(1); // on arrête le script en renvoyant un code d'erreur choisi par nous
}

try {
    $requetePreparee = $pdo->prepare('INSERT INTO station (nomstation, latitude, longitude) VALUES (?, ?, ?)');
    $requetePreparee->bindParam(1, $nom, PDO::PARAM_STR);
    $requetePreparee->bindParam(2, $lat, PDO::PARAM_INT);
    $requetePreparee->bindParam(3, $long, PDO::PARAM_INT);


    // ATTENTION !!! : si on utilise des variables au lieu de valeur en dur, il faut utiliser bindParam au lieu de bindValue
    $resultat = $requetePreparee->execute();

    if ($resultat) {
    } else {
        //echo $pdo->errorInfo()[2], "\n";
        echo $requetePreparee->errorInfo()[2], "\n";
    }
} catch (PDOException $e) {
    echo "problème avec la requête d'insertion\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}

?>