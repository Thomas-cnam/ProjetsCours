<?php

require_once("constantes.php");



// le curl

$url1 = 'https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_information.json';
$url2 = 'https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_status.json';

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_PROXY, '192.168.3.2:3128');
$data1 = curl_exec($ch1);
curl_close($ch1);

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_PROXY, '192.168.3.2:3128');
$data2 = curl_exec($ch2);
curl_close($ch2);

$stations_information = json_decode($data1, true); // true pour retourner un tableau associatif

$station_status = json_decode($data2, true);

// on combine les deux tableaux en une seule réponse JSON
$response = json_encode(array(
    'data' => array(
        'stations_information' => $stations_information,
        'station_status' => $station_status
    )
));







if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations de connexion de l'utilisateur
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
    } catch (PDOException $e) {
        echo "problème de connexion\n";
        echo $e->getMessage();
        exit(1); // on arrête le script en renvoyant un code d'erreur choisi par nous
    }

    // Vérification des informations de connexion de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nomUti = :nomUti AND mdpUti = :mdpUti");
    $stmt->bindParam(':nomUti', $username);
    $stmt->bindParam(':mdpUti', $password);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur) {
        // L'utilisateur est authentifié avec succès
        $_SESSION['loggedin'] = true; // définir la variable de session pour indiquer que l'utilisateur est connecté
        $_SESSION['nomUti'] = $username; // enregistrer le nom d'utilisateur dans la variable de session

        // insertion dans la base 

        // extraire les valeurs souhaitées


        foreach ($stations_information['data']['stations'] as $station1) {
            foreach ($station_status['data']['stations'] as $station2) {


                if ($station2['station_id'] == $station1['station_id']) {

                    $mon_tableau = array($station1['station_id'], $station1['name'], $station2['num_docks_available'], $station2['num_bikes_available'], $station2['num_bikes_available_types'][1]['ebike'], $station2['num_bikes_available_types'][0]['mechanical'], $station1['lat'], $station1['lon'], $station1['capacity'], $station2 = boolval(['is_renting']),  $station2 = boolval(['is_returning']));

                    try {
                        $requetePreparee = $pdo->prepare('INSERT INTO station (id, nomstation, nombredebornette, nombrevelos, veloselectrique, velosmecanique, latitude, longitude, capacity, veloslouable, velosrecevable) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                        $requetePreparee->bindParam(1, $mon_tableau[0], PDO::PARAM_STR);
                        $requetePreparee->bindParam(2, $mon_tableau[1], PDO::PARAM_INT);
                        $requetePreparee->bindParam(3, $mon_tableau[2], PDO::PARAM_INT);
                        $requetePreparee->bindParam(4, $mon_tableau[3], PDO::PARAM_INT);
                        $requetePreparee->bindParam(5, $mon_tableau[4], PDO::PARAM_INT);
                        $requetePreparee->bindParam(6, $mon_tableau[5], PDO::PARAM_INT);
                        $requetePreparee->bindParam(7, $mon_tableau[6], PDO::PARAM_INT);
                        $requetePreparee->bindParam(8, $mon_tableau[7], PDO::PARAM_INT);
                        $requetePreparee->bindParam(9, $mon_tableau[8], PDO::PARAM_INT); // capacity
                        $requetePreparee->bindParam(10, $mon_tableau[9], PDO::PARAM_BOOL);
                        $requetePreparee->bindParam(11, $mon_tableau[10], PDO::PARAM_BOOL);



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
                }
            }
        }
        
        $pdo = NULL; //fermeture de la connexion
        header('Location: pageUtilisateur.php');
        exit();


        // $nom_station = $stations_information['data']['stations_information']['stations']['name'];
        // $nombre_bornettes = $stations_information->data->stations_information[0]->capacity;
        // $nombre_velos = $station_status->data->stations_status[0]->num_bikes_available;
        // $velos_electriques = $station_status->data->stations_status[0]->num_bikes_available_types->ebike;
        // $velos_mecaniques = $station_status->data->stations_status[0]->num_bikes_available_types->mechanical;
        // $velos_louables = $station_status->data->stations_status[0]->num_bikes_available - ($velos_electriques + $velos_mecaniques);
        // $velos_recevables = $station_status->data->stations_status[0]->num_bikes_available;



    } else {
        // Les informations de connexion sont incorrectes, afficher un message d'erreur
        echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
