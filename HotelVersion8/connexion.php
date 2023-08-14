<?php

// Ce script montre comment se connecter à une base de données avec PDO
//
require_once("constantes.inc.php");


try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
} catch(PDOException $e) {
    echo "problème de connexion\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}

echo "le script est connecté avec la base de données\n";

$pdo = NULL; // fermeture de la connexion

?>
