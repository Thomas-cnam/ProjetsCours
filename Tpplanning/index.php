<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Planning</title>
        <meta charset="UTF-8" /> 
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    
    <?php 
    require_once("constantes.inc.php");
      
    $datejour = date('d/m/Y');
      
    ?>
    <body>

        <script type="application/javascript" >
        
            function charger() {
                var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
                xhr.onreadystatechange = function() {
                    // gestion de la réponse du serveur            
                    if (xhr.readyState==4 && xhr.status==200) {
                        document.getElementById("corps").innerHTML = xhr.responseText; // modification du contenu de la page web
                    }
                }            
                
                var choixDate = document.getElementById("choixDate").value;
                alert(choixDate);
                xhr.open("GET", "recherche2.php?date=" + choixDate, true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
                xhr.send(); // envoi de la requête HTTP
            }
            
            
            
             function Reserver() {
                 prompt("Nom","");
                 prompt("Prénom","");
                 prompt("Age","");
                 const ajout  = document.querySelector('.plus');
                 console.log(ajout);


                 const td = document.querySelector("td");
                 console.log(td);
                 

                 document.body.addEventListener("click", (e) => {
                    console.log(e.targed);

                 });
                }

                 function Supprimer() {
                 const suppression = document.querySelector('.moins');
                 const td2 = document.querySelector("td");
                 console.log(td2);

                 td2.addEventListener("click", (e) => {
                    console.log(e);

                 });
                 


                }

                var choixDate = document.getElementById("choixDate").value;
                alert(choixDate);
                xhr.open;

        </script>

        
        <h1>Planning</h1>
        
        <form action="index.php" method="GET" name="formulaire">
        
        
        <select name="creneau">
            <option value="9h"> 9h </option>
            <option value="10h"> 10h </option>
            <option value="11h"> 11h </option>
            <option value="12h"> 12h </option>
            <option value="13h"> 13h </option>
            <option value="14h"> 14h </option>
            <option value="15h"> 15h </option>
            <option value="16h"> 16h </option>
            <option value="17h"> 17h </option>
            <option value="18h"> 18h </option>
            
        </select>
            
        <button type="button" onclick="charger()">Réservation</button>
        
        <input type="date" id="choixDate" name="choixDate" />
        <button type="button" onclick="charger()">Refresh</button>
        
        <input type="text" id="nom" name="nom" />
        <button type="button" onclick="charger()">Choix du nom</button>
        
        </form>
            
    
        
        
     
        <table> 
            <thead>
                </thead>

                    <tbody>
                    
<?php 

echo "<td></td><td>$datejour </td>", "\n";

$today = time();
$time = $today;

for($i = 1; $i <= 6; $i++){
    $time += 86400; // On incrémente au timestamp 86400 s par jour

    echo " <td>", date('d/m/Y',$time),"</td>", "\n";
}
//     86400

for ($i=9; $i<19; $i++) {
    echo "<tr><td> $i","h </td>", "\n";

    for ($j=0; $j <= 6; $j++){

        echo "<td>
                 <button class='plus' onclick=\"Reserver()\">+</button>
                 <button class='moins' onclick=\"Supprimer()\">-</button>

            </td>";

    }
    echo "</tr>";



}
?>
    </tbody>
</table>
            
         
       
       
    </body>
</html>


