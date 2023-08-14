<?php

define('SERVEUR', 'localhost'); // define permet de définir des constantes
define('PORT', '5432');

define('UTILISATEUR', 'uti_velib');
define('MDP', 'slam'); // mot de passe
define('NOM_BASE', 'bd_velib');


define('DSN', 'pgsql:host=' . SERVEUR . ' port=' . PORT . ' dbname=' . NOM_BASE); // DSN : Data Source Name

?>