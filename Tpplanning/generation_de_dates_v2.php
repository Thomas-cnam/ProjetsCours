<?php
// version 2
// génére une série de rendez-vous sans doublons




/***** programme principal *****/

//$tab[][] = ;

// Les créneaux possibles sont : 9h-10h, 10h-11h, ..., 17h-18h.
for($i = 0; $i < 10; $i++) {
    do {
        $date = genererDate(20, 5, 2022, 25, 5, 2022);
        $creneau = genererDebutCreneau(9, 17);
    } while (isset($tab[$date][$creneau]));
    
    $tab[$date][$creneau] = true;
    
    echo $i, " -->  ", date("Y-m-d", $date), " à ", $creneau, "h00\n";
}



/***** fonctions *****/

/*
 * Cette fonction génère, sous forme de timestamp, une date compris entre un jour de début et un jour de fin.
 */
function genererDate($pJourDebut, $pMoisDebut, $pAnneeDebut, $pJourFin, $pMoisFin, $pAnneeFin) {
    $lJourDebut = mktime(0, 0, 0, $pMoisDebut, $pJourDebut, $pAnneeDebut); // heure, minute, seconde, mois, jour, année
    $lJourFin = mktime(0, 0, 0, $pMoisFin, $pJourFin, $pAnneeFin); // heure, minute, seconde, mois, jour, année
    
    $duree = $lJourFin - $lJourDebut; // en secondes
    
    $hasard = rand(0, $duree);
    
    // 86400 : nombres de secondes dans une journée
    $decalage = intdiv($hasard,  86400) * 86400;
    
    return $lJourDebut + $decalage;
}

/*
 * 
 */
function genererDebutCreneau($pPremiereHeure, $pDernireHeure) {
    return rand($pPremiereHeure, $pDernireHeure);
}

