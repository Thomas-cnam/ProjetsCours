<?php
require_once("connectionConstantes.php");
// Vérification de la connection PDO


// création du dns pour la connection 

$dsn = 'mysql:host=localhost;dbname=agent;charset=utf8'; 'root';

try
{

$db = new PDO($dsn, 'root' , '');

// pour que les accents se mettent correctement 
$db->exec("SET NAMES utf8");

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


?>

