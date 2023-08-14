<?php
session_start();
session_destroy(); // détruire la session
header('Location: pageAuthen.php'); // rediriger vers la page de connexion
exit;
?>
