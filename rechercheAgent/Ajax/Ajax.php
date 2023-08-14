<?php
// info de connection de la base de donnée 

$dbDetails = array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db' => 'agent'
);

/* 
cdeta = collectivitée 
srv = service 
chef_service = matricule de chef de service (a voir plus tard)
cdsrv = on s'en fou 
cdsouvir = pareil 
sousdir = sous direction (à renseigner que si elle est affichée)
sousdirecteur = matricule de sous directeur 
cddir = on s'en fou 
dir = direction 
directeur = matricule du directeur 
cddg = on sn'e fou 
dg = matricule du directeur général adjoint 
adjoints = (plus tard) liste des matricules des personnes en question 
cdsect = on s'en fou 
sect = secteur 
resps = liste des responsbles de l'agent en question (plus tard)
section = matricule du responsable du secteur 
relai_direction = liste des matricules des relais de l'agent (secrétaire exemple de relai)
cdpole = on s'en fou 
pole = pôle de l'agent dans lequel il est 
rédacteur = on s'en fou 
autorité terri = on s'en fou 
nonpat = nom de naissance 
dgs = on s'en fou 


à ajouter dans la table = numéro de tel, date de naissance, adresse mail, nom du responsable hiérarchique 
*/



// DB table to use 

$table = 'agent';

// la primary key de la base 
$primaryKey = 'mat';



$columns = array(
    array(
        'db' => 'mat',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),

    array( 'db' => 'mat', 'dt' => 'mat' ),
    array( 'db' => 'nom',  'dt' => 'nom' ),
    array( 'db' => 'prenom', 'dt' => 'prenom' ),
    array( 'db' => 'titre', 'dt' => 'titre' ), 
    array( 'db' => 'cdeta', 'dt' => 'cdeta' ), 
    array( 'db' => 'srv', 'dt' => 'srv' ), 
    array( 'db' => 'dg', 'dt' => 'dg' ),
    array( 'db' => 'sousdirecteur', 'dt' => 'sousdirecteur' ),
    array( 'db' => 'dir', 'dt' => 'dir' ),
    array( 'db' => 'directeur', 'dt' => 'directeur' ),
    array( 'db' => 'sect', 'dt' => 'sect' ),
    array( 'db' => 'section', 'dt' => 'section' ),
    array( 'db' => 'relai_direction', 'dt' => 'relai_direction' ),
    array( 'db' => 'relai_service', 'dt' => 'relai_service' ),
    array( 'db' => 'relai_section', 'dt' => 'relai_section' ),
    array( 'db' => 'pole', 'dt' => 'pole' ),
    array( 'db' => 'nompat', 'dt' => 'nompat' ),
    array( 'db' => 'dtnais', 'dt' => 'dtnais' ),
    array( 'db' => 'mail', 'dt' => 'mail' ),
    array( 'db' => 'responsable', 'dt' => 'responsable' ),
    array( 'db' => 'telephone', 'dt' => 'telephone' ),


);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* If you just want to use the basic configuration for DataTables with PHP
* server-side, there is no need to edit below this line.
*/

require( 'ssp.class.php' );



// output data as json format  
// $where = "SELECT mat, nom, prenom, titre from agent where cdeta='ESAD'";
echo json_encode(
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)

);

?>

