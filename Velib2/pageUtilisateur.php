<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: pageAuthen.php');
    exit;
}

if (isset($_POST['logout'])) {
    // détruire la session et rediriger vers la page de connexion lorsque l'utilisateur se déconnecte
    session_destroy();
    header('Location: pageAuthen.php');
    exit;
}
?>

<?php
// connexion a la base

require_once("constantes.php");


try {
    $pdo = new PDO(DSN, UTILISATEUR, MDP); // tentative de connexion
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // utile pour le débogage
} catch (PDOException $e) {
    echo "problème de connexion\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}

try {
    $requetePreparee = $pdo->prepare('SELECT * FROM station');
    $resultat = $requetePreparee->execute();

    if ($resultat) {
        $lignes = $requetePreparee->fetchAll(); // on essaie de récupérer toutes les lignes
        $mon_tableau = [];
        for ($i = 0; $i < count($lignes); $i++) {
            array_push($mon_tableau, array($lignes[$i]['id'], $lignes[$i]['nomstation'], $lignes[$i]['nombredebornette'], $lignes[$i]['nombrevelos'], $lignes[$i]['veloselectrique'], $lignes[$i]['velosmecanique'], $lignes[$i]['latitude'], $lignes[$i]['longitude'], $lignes[$i]['capacity'], $lignes[$i]['veloslouable'],  $lignes[$i]['velosrecevable']));
        }
    } else {
        echo "échec\n";
        echo $requetePreparee->errorInfo()[2], "\n";
    }
} catch (PDOException $e) {
    echo "problème avec la requête de sélection\n";
    echo $e->getMessage();
    exit(1); // on arrête le script
}

$pdo = NULL; //fermeture de la connexion
$mon_tableau = json_encode($mon_tableau);
?>



<!DOCTYPE html>
<html>

<head>
    <title>Velib</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />


    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


</head>

<body>

    <h1> PROJET VÉLIB </h1>

    <p>Vous êtes connecté en tant que <?php echo $_SESSION['nomUti']; ?></p>


    <div class="divMapListe">

        <div id="map"></div>



        <div class="divliste">
            <h1 class="Liste">Favori</h1>
            <button onclick='afficherFavori()' id="afficherFavoris">Favoris</button>
            <button onclick='afficherTous()' id="afficherTous">Map</button>


            <!-- <button onclick='afficherMap()' id="afficherTous">Map</button> -->


            <ul id="liste_favori"></ul>

        </div>

    </div>


    <script>
        var map = L.map('map').setView([48.856613, 2.352222], 13);

        var markersLayer = L.layerGroup().addTo(map);


        // var liste = [];
        var tabFavori = [];

        var tabMarqueur = [];

        var markers = [];

        // Récupération de l'élément <ul> dans le DOM
        let ul = document.getElementById("liste_favori");




        // carte les tuiles

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        // Récupération des données JSON à partir de l'URL





        // fonction pour tout afficher 




        // fonction n'afficher que les favoris 

        function afficherFavori() {
            markers.splice(0, markers.length);
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }

            });
            console.log(tabMarqueur);

            for (var y = 0; y < tabMarqueur.length; y++) {
                var marker = L.marker([tabMarqueur[y]._latlng.lat, tabMarqueur[y]._latlng.lng]).addTo(map);
                marker.bindPopup(tabMarqueur[y]._popup._content); // Ajouter une popup avec le titre du marqueur
                console.log(tabMarqueur[y]._popup._content);
            }

        }

        function afficherTous() {
            markers.splice(0, markers.length);
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            for (var i = 0; i < mon_tableau.length; i++) {


                var marker = L.marker([mon_tableau[i][6], mon_tableau[i][7]]).addTo(map);
                marker.bindPopup(mon_tableau[i][1] + "<br>" + // stationnom 
                    "Il y a " + mon_tableau[i][2] + " bornettes " + "<br>" + // nombredebornette
                    "Le numéro de la station : " + mon_tableau[i][0] + "<br>" + // id 
                    "Vélos disponibles : " + mon_tableau[i][3] + "<br>" +
                    "Mécanique : " + mon_tableau[i][5] + "<br>" +
                    "Électrique : " + mon_tableau[i][4] + "<br>" +
                    "<div class='containerBouton'><button onclick=\"ajoutFavori('" + encodeURIComponent(mon_tableau[i][1]) + "', " + mon_tableau[i][6] + ", " + mon_tableau[i][7] + ")\">Favori</button></div>");


                markers.push(marker);
                // Ajouter la chaîne de caractères au tableau de marqueurs

            }

        }

        function ajoutFavori(nom, lat, long) {

            var nom = decodeURIComponent(nom);

            var test = 0;
            for (i = 0; i < tabMarqueur.length; i++) {
                if (tabMarqueur[i]._latlng.lat == lat && tabMarqueur[i]._latlng.lng == long) {
                    test = 1;
                }

            }
            if (test == 0) {
                tabFavori.push(nom, lat, long);
                for (i = 0; i < markers.length; i++) {
                    if (markers[i]._latlng.lat == lat && markers[i]._latlng.lng == long) {

                        tabMarqueur.push(markers[i]);
                        console.log(tabMarqueur);


                    }

                }

                var liste = document.getElementById("liste_favori");
                liste.innerHTML = ""; // Effacer le contenu de la liste avant de l'ajouter de nouveau
                for (var y = 0; y < tabFavori.length; y += 3) {
                    var nom = tabFavori[y];
                    var lat = tabFavori[y + 1];
                    var long = tabFavori[y + 2];
                    var texte = nom + " (" + lat + ", " + long + ")";
                    var li = document.createElement("li");
                    li.textContent = texte;
                    liste.appendChild(li);

                    // insertion dans la base 
                    let xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            let donnees2 = JSON.parse(xhr.responseText);
                            console.log(donnees2.length);
                            // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText
                            if (donnees2.length > 0) {



                            }
                        }

                    }
                    xhr.open("GET", "insertFavori.php?nom=" + nom + "&lat=" + lat + "&long=" + long , true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
                    xhr.send();

                }



            }
        }

        // Parcourir le tableau PHP et construire une chaîne de caractères pour chaque élément
        var mon_tableau = JSON.parse('<?php echo str_replace("'", "\\'", $mon_tableau); ?>');

        for (var i = 0; i < mon_tableau.length; i++) {


            var marker = L.marker([mon_tableau[i][6], mon_tableau[i][7]]).addTo(map);
            marker.bindPopup(mon_tableau[i][1] + "<br>" + // stationnom 
                "Il y a " + mon_tableau[i][2] + " bornettes " + "<br>" + // nombredebornette
                "Le numéro de la station : " + mon_tableau[i][0] + "<br>" + // id 
                "Vélos disponibles : " + mon_tableau[i][3] + "<br>" +
                "Mécanique : " + mon_tableau[i][5] + "<br>" +
                "Électrique : " + mon_tableau[i][4] + "<br>" +
                "<div class='containerBouton'><button onclick=\"ajoutFavori('" + encodeURIComponent(mon_tableau[i][1]) + "', " + mon_tableau[i][6] + ", " + mon_tableau[i][7] + ")\">Favori</button></div>");


            markers.push(marker);
            // Ajouter la chaîne de caractères au tableau de marqueurs

        }



        // Éxécuter chaque chaîne de caractères pour ajouter les marqueurs à la carte




        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    </script>




    <form method="post" action="deconnexion.php">
        <input type="submit" name="logout" value="Déconnexion">
    </form>

</body>

</html>