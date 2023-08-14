<?php

require_once("connection.php");
require_once("connectionConstantes.php");

// faire un script php qui fait une page html fixe qui  affiche tous les agents a la suite trié par ordre alpha
// nom prenom numéro et direction

/*avant de te lancer dans le script pour générer la page HTML, nous voudrions que tu crées en dur la page HTML qui sera généré

donc créer un fichier HTML, avec du CSS, pour intégrer par exemple les agents du service EPGA de la DSIT

faire une page jolie, accessible et validée sur le validator W3C

la page doit etre aussi responsive
*/



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau</title>
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    
</head>

<body>
    <a href="trie.php"><button id="Filtrage">Filtrage</button></a>
    <a href="pageTableau.php"><button id="page">PAGE</button></a>
    <table id="agentTable" class="display agent-table" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Mat</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Titre</th>
            </tr>
        </thead>
    </table>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        function format(d) {
            
            return (`
        <div class="text-bg-dark p-3 collapse" id="collapse-id-${d.mat}">
            <div style="display:flex;">
                <div class="card text-bg-secondary p-3">
                    <div class="card-header">Présentation :</div>
                        <div class="card-body">
                            <p><b>Matricule : </b>${d.mat}</p>
                            <p><b>Titre : </b>${d.titre}</p>
                            <p><b>Personne : </b>${d.nom, d.prenom}</p>
                            <p><b>Nom naissance : </b>${d.nompat}</p>
                            <p><b>Secteur : </b>${d.sect}</p>
                            <p><b>Section : </b>${d.section}</p>
                        </div>
                </div>
                <div class="card text-bg-secondary p-3">
                    <div class="card-header">Entreprise :</div>
                        <div class="card-body">
                            <p><b>Collectivitée : </b>${d.cdeta}</p>
                            <p><b>Service : </b>${d.srv}</p>
                            <p><b>Matricule directeur : </b>${d.directeur}</p>
                            <p><b>Matricule directeur général : </b>${d.dg}</p>
                            <p><b>Sous directeur : </b>${d.sousdirecteur}</p>
                            <p><b>Direction : </b>${d.dir}</p>
                        </div>
                </div>
                <div class="card text-bg-secondary p-3">
                    <div class="card-header">Collectivité :</div>
                        <div class="card-body">
                            <p><b>Pôle : </b>${d.pole}</p>  
                            <p><b>Relai direction : </b> ${d.relai_direction}</p>
                            <p><b>Relai service : </b>${d.relai_service}</p>
                            <p><b>Relai section : </b>${d.relai_section}</p>
                        </div>
                </div>
            </div>
        </div>
        `)
        }





        $(document).ready(function() {
            var dt = $('#agentTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "processing": true,
                "serverSide": true,
                "ajax": "Ajax/Ajax.php",
                columns: [{
                        class: 'details-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'mat'
                    },
                    {
                        data: 'nom'
                    },
                    {
                        data: 'prenom'
                    },
                    {
                        data: 'titre'
                    },
                   
                ],
                language: {
                    url: 'Json/dataTables-FR.json',
                },
            });


            $('#agentTable tbody').on('click', 'tr td.details-control', function() {
                var tr = $(this).closest('tr');
                var id = tr.attr('id').split('row_')[1]
                var collapse = $(`#collapse-id-${id}`)
                bootstrap.Collapse.getInstance($(`#collapse-id-${id}`)).toggle()
                
            });

            dt.on('draw', function() {
                dt.rows().every(function() {
                    
                    var rowData = this.data()
                    var trId = rowData.DT_RowId
                    var tr = $(`#${trId}`)

                    this.child(format(rowData)).show()
                    this.child().children()
                        .css('padding', '0')
                        .css('border-top', '0')

                    var collapse = this.child().find('.collapse')
                    var bsCollapse = new bootstrap.Collapse(collapse, {
                        toggle: false
                    })
                    collapse.on('shown.bs.collapse', function(e){
                        tr.addClass('details')
                    })
                    collapse.on('hidden.bs.collapse', function(e){
                        tr.removeClass('details')
                    })
                });
            });
        });
    </script>



</body>

</html>