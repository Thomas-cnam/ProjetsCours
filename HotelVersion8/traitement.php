<?php 
header("Content-Type: application/json");

$rouge = rand(0, 255);
$vert = rand(0, 255);
$bleu = rand(0, 255);

// la réponse est un tableau à 3 éléments
echo '[', $rouge, ', ', $vert, ', ', $bleu, ']';

?>
