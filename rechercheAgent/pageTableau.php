<?php 
    require_once("connection.php");
    require_once("connectionConstantes.php");

    $sqlQuerry = 'SELECT * FROM agent';
    $agentStatement = $db->prepare($sqlQuerry);
    $agentStatement->execute();
    $agents = $agentStatement->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau</title>
    <link rel="stylesheet" type="text/css" href="css/tableau.css">

</head>

<a href="index.php"> Retour</a>
    <h1>Tableau</h1>

    <div class="tableau">
        <table id="agentTable" class="display agent-table" style="width:100%">
                <thead>
                    <tr>            
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Numéro de téléphone</th>
                        <th scope="col">Direction</th>
                    </tr>
                    <tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($agents as $agent) {
                    ?>
                        <tr>
                            <td><?php echo $agent['nom']; ?></td>
                            <td><?php echo $agent['prenom']; ?></td>
                            <td><?php echo $agent['telephone']; ?></td>
                            <td><?php echo $agent['cdeta']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>   
        </table>
    </div>    
</body>

</html>