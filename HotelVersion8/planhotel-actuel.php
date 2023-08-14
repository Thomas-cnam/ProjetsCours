<!DOCTYPE html>
<html>

<head>
    <title>Hôtel Roosevelt</title>
    <meta charset="UTF-8" />
    <script src="bibliotheques/pixi.js"></script> <!-- permet d'utiliser PixiJS -->
</head>

<body style="text-align: center">
    <h1>Hôtel Roosevelt</h1>
    <p>Date : <input id="date" type="date" onchange="traiter_date()" /></p>

    <script>
        // création de l'application Pixi en spécifiant notamment la largeur, hauteur
        const appli = new PIXI.Application({
            width: 1450,
            height: 800,
            backgroundColor: 0xeeeeee,
            antialias: true,
            clearBeforeRender: true
        }); // antialias c'est pour lisser les textures
        document.body.appendChild(appli.view); // ajout de l'appli Pixi dans la page web


        // style
        const style1 = new PIXI.TextStyle({

            fontFamily: "Arial",
            fontSize: 15
        });

        const style2 = new PIXI.TextStyle({

            fontFamily: "Arial",
            fontSize: 12
        });


        // batiment

        const rectangle = new PIXI.Graphics(); // rectangle rue du haut
        rectangle.beginFill(0x808080); // important de mettre le 0x devant le code couleur pour que cela affiche la bonne couleur
        rectangle.drawRect(200, 35, 1070, 70); // (x, y, largeur, hauteur)
        rectangle.endFill();

        appli.stage.addChild(rectangle); // ajout à la scène et donc sera dessiné


        const rectangleParc = new PIXI.Graphics(); // rectangle rue du haut
        rectangleParc.beginFill(0x32CD32); // couleur rgb
        rectangleParc.drawRect(850, 138, 350, 520); // (x, y, largeur, hauteur)
        rectangleParc.endFill();

        appli.stage.addChild(rectangleParc); // ajout à la scène et donc sera dessiné



        const rectangleTerasse = new PIXI.Graphics(); // rectangle rue du haut
        rectangleTerasse.beginFill(0x808080); // couleur rgb
        rectangleTerasse.drawRect(220, 350, 350, 80); // (x, y, largeur, hauteur)
        rectangleTerasse.endFill();

        appli.stage.addChild(rectangleTerasse); // ajout à la scène et donc sera dessiné


        const rectanglePiscine = new PIXI.Graphics(); // rectangle rue du haut
        rectanglePiscine.beginFill(0x87CEFA); // couleur rgb
        rectanglePiscine.drawRect(240, 450, 300, 150); // (x, y, largeur, hauteur)
        rectanglePiscine.endFill();

        appli.stage.addChild(rectanglePiscine); // ajout à la scène et donc sera dessiné


        const rectangleEtage = new PIXI.Graphics();
        rectangleEtage.lineStyle(4, 0x000000);
        rectangleEtage.beginFill(0xFFFFFF);
        rectangleEtage.drawPolygon([
            235, 140,
            830, 140,
            830, 590,
            630, 590,
            630, 325,
            235, 325

        ]);
        rectangleEtage.endFill();

        appli.stage.addChild(rectangleEtage);



        // chataigné

        let hauteur = 200;


        for (let i = 0; i < 8; i++) {

            const ellipse = new PIXI.Graphics();

            ellipse.beginFill(0x582900, 1); // 0.5 = transparence
            ellipse.drawEllipse(150, hauteur, 15, 15); // position horizontale, vertical, largeur, hauteur
            ellipse.endFill();

            appli.stage.addChild(ellipse);

            hauteur = hauteur + 50;

        }



        // Noms affichés

        const messageRue = new PIXI.Text("Rue", style1);
        messageRue.x = 700;
        messageRue.y = 65;
        appli.stage.addChild(messageRue);

        const messageParc = new PIXI.Text("Parc", style1);
        messageParc.x = 860;
        messageParc.y = 138;
        appli.stage.addChild(messageParc);

        const messagePiscine = new PIXI.Text("Piscine", style1);
        messagePiscine.x = 370;
        messagePiscine.y = 530;
        appli.stage.addChild(messagePiscine);


        const messageTerasse = new PIXI.Text("Terasse", style1);
        messageTerasse.x = 375;
        messageTerasse.y = 390;
        appli.stage.addChild(messageTerasse);

        const messageChataigner = new PIXI.Text("Châtaigner", style1);
        messageChataigner.x = 120;
        messageChataigner.y = 570;
        appli.stage.addChild(messageChataigner);

        const messageSapins = new PIXI.Text("Sapins", style1);
        messageSapins.x = 450;
        messageSapins.y = 690;
        appli.stage.addChild(messageSapins);

        const Reception = new PIXI.Graphics(); // rectangle rue du haut
        Reception.lineStyle(4, 0x000000);
        Reception.beginFill(0xFFFFFF); // couleur rgb
        Reception.drawRect(740, 150, 75, 165); // (x, y, largeur, hauteur)
        Reception.interactive = true;
        Reception.endFill();

        // Numéro chambre rez de chaussée






        // Sapins

        let tabSapin = [{
                x: 400,
                y: 640
            }, {
                x: 495,
                y: 633
            }, {
                x: 460,
                y: 680
            }, {
                x: 550,
                y: 675
            }, {
                x: 590,
                y: 620
            }, {
                x: 645,
                y: 655
            }, {
                x: 600,
                y: 710
            },
            {
                x: 680,
                y: 690
            }, {
                x: 690,
                y: 620
            }, {
                x: 735,
                y: 655
            }, {
                x: 770,
                y: 685
            }, {
                x: 800,
                y: 635
            }, {
                x: 850,
                y: 670
            }, {
                x: 875,
                y: 630
            }, {
                x: 915,
                y: 655
            }, {
                x: 920,
                y: 600
            }, {
                x: 960,
                y: 630
            }, {
                x: 930,
                y: 560
            }, {
                x: 980,
                y: 580
            }, {
                x: 1020,
                y: 605
            }, {
                x: 1000,
                y: 540
            }, {
                x: 1050,
                y: 560
            }, {
                x: 960,
                y: 515
            }, {
                x: 980,
                y: 480
            }, {
                x: 1040,
                y: 510
            }, {
                x: 1105,
                y: 500
            }, {
                x: 1050,
                y: 465
            }, {
                x: 1125,
                y: 455
            }, {
                x: 1170,
                y: 420
            }, {
                x: 1175,
                y: 380
            }, {
                x: 1100,
                y: 540
            }
        ]; 


        for (let i = 0; i < tabSapin.length; i++) {


            const sapin = new PIXI.Graphics();
            sapin.beginFill(0x556B2F, 1); // 0.5 = transparence
            sapin.drawEllipse(tabSapin[i].x, tabSapin[i].y, 27, 13); // position horizontale, vertical, largeur, hauteur
            sapin.endFill();

            appli.stage.addChild(sapin);

        }


        // création d'étages


        document.body.appendChild(appli.view);

        // rez de chaussée étage
        //ch1 = {x: 100, y: 50, l: 75; h: 75, g: new PIXI.Graphics()};
        let ch1 = {
            n: 1,
            x: 125,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch2 = {
            n: 2,
            x: 125,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch3 = {
            n: 3,
            x: 170,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch4 = {
            n: 4,
            x: 170,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch5 = {
            n: 5,
            x: 220,
            y: 75,
            l: 165,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch6 = {
            n: 6,
            x: 220,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch7 = {
            n: 7,
            x: 265,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch8 = {
            n: 8,
            x: 320,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch9 = {
            n: 9,
            x: 320,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch10 = {
            n: 10,
            x: 320,
            y: 165,
            l: 75,
            h: 165,
            g: new PIXI.Graphics()
        };

        let ch11 = {
            n: 11,
            x: 370,
            y: 165,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch12 = {
            n: 12,
            x: 370,
            y: 210,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch13 = {
            n: 13,
            x: 320,
            y: 252,
            l: 175,
            h: 75,
            g: new PIXI.Graphics()
        };
        let reception = {
            n: 14,
            x: 370,
            y: 75,
            l: 75,
            h: 165,
            g: new PIXI.Graphics()
        };

        //premier étage

        let ch101 = {
            n: 101,
            x: 125,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch102 = {
            n: 102,
            x: 170,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch103 = {
            n: 103,
            x: 125,
            y: 120,
            l: 165,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch104 = {
            n: 104,
            x: 220,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch105 = {
            n: 105,
            x: 220,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch106 = {
            n: 106,
            x: 265,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch107 = {
            n: 107,
            x: 265,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch108 = {
            n: 108,
            x: 320,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch109 = {
            n: 109,
            x: 320,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch110 = {
            n: 110,
            x: 370,
            y: 75,
            l: 75,
            h: 165,
            g: new PIXI.Graphics()
        };

        let ch111 = {
            n: 111,
            x: 320,
            y: 165,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch112 = {
            n: 112,
            x: 370,
            y: 165,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch113 = {
            n: 113,
            x: 320,
            y: 215,
            l: 175,
            h: 150,
            g: new PIXI.Graphics()
        };

        // deuxième étage 

        let ch201 = {
            n: 201,
            x: 125,
            y: 75,
            l: 175,
            h: 165,
            g: new PIXI.Graphics()
        };

        let ch202 = {
            n: 202,
            x: 220,
            y: 75,
            l: 165,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch203 = {
            n: 203,
            x: 220,
            y: 120,
            l: 165,
            h: 75,
            g: new PIXI.Graphics()
        };


        let ch204 = {
            n: 204,
            x: 320,
            y: 75,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch205 = {
            n: 205,
            x: 320,
            y: 120,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch206 = {
            n: 206,
            x: 370,
            y: 75,
            l: 75,
            h: 165,
            g: new PIXI.Graphics()
        };
        let ch207 = {
            n: 207,
            x: 320,
            y: 165,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };

        let ch208 = {
            n: 208,
            x: 370,
            y: 165,
            l: 75,
            h: 75,
            g: new PIXI.Graphics()
        };
        let ch209 = {
            n: 209,
            x: 320,
            y: 215,
            l: 175,
            h: 150,
            g: new PIXI.Graphics()
        };









        // DeuxiemeEtage étage


        var tabRezDeChaussee = [ch1, ch2, ch3, ch4, ch5, ch6, ch7, ch8, ch9, ch10, ch11, ch12, ch13];
        var tabPremierEtage = [ch101, ch102, ch103, ch104, ch105, ch106, ch107, ch108, ch109, ch110, ch111, ch112, ch113];
        var tabDeuxiemeEtage = [ch201, ch202, ch203, ch204, ch205, ch206, ch207, ch208, ch209];
        var tableauCouleur = [];




        // les numéros de chambre 

        const messageChambre1 = new PIXI.Text("1", style1);
        messageChambre1.x = 285
        messageChambre1.y = 180

        const messageChambre2 = new PIXI.Text("2", style1);
        messageChambre2.x = 285;
        messageChambre2.y = 270;

        const messageChambre3 = new PIXI.Text("3", style1);
        messageChambre3.x = 380;
        messageChambre3.y = 180;

        const messageChambre4 = new PIXI.Text("4", style1);
        messageChambre4.x = 380;
        messageChambre4.y = 270;

        const messageChambre5 = new PIXI.Text("5", style1);
        messageChambre5.x = 530;
        messageChambre5.y = 180;

        const messageChambre6 = new PIXI.Text("6", style1);
        messageChambre6.x = 480;
        messageChambre6.y = 270;

        const messageChambre7 = new PIXI.Text("7", style1);
        messageChambre7.x = 570;
        messageChambre7.y = 270;

        const messageChambre8 = new PIXI.Text("8", style1);
        messageChambre8.x = 670;
        messageChambre8.y = 270;

        const messageChambre9 = new PIXI.Text("9", style1);
        messageChambre9.x = 670;
        messageChambre9.y = 180;

        const messageChambre10 = new PIXI.Text("10", style1);
        messageChambre10.x = 669;
        messageChambre10.y = 400;

        const messageChambre11 = new PIXI.Text("11", style1);
        messageChambre11.x = 770;
        messageChambre11.y = 360;

        const messageChambre12 = new PIXI.Text("12", style1);
        messageChambre12.x = 770;
        messageChambre12.y = 450;

        const messageChambre13 = new PIXI.Text("13", style1);
        messageChambre13.x = 720;
        messageChambre13.y = 535;

        const messageReception = new PIXI.Text("Reception", style2);
        messageReception.x = 750;
        messageReception.y = 225;

        // étage 1 

        const messageChambre101 = new PIXI.Text("101", style1);
        messageChambre101.x = 275;
        messageChambre101.y = 180;

        const messageChambre102 = new PIXI.Text("102", style1);
        messageChambre102.x = 375;
        messageChambre102.y = 180;

        const messageChambre103 = new PIXI.Text("103", style1);
        messageChambre103.x = 325;
        messageChambre103.y = 270;

        const messageChambre104 = new PIXI.Text("104", style1);
        messageChambre104.x = 475;
        messageChambre104.y = 180;

        const messageChambre105 = new PIXI.Text("105", style1);
        messageChambre105.x = 475;
        messageChambre105.y = 270;

        const messageChambre106 = new PIXI.Text("106", style1);
        messageChambre106.x = 565;
        messageChambre106.y = 180;

        const messageChambre107 = new PIXI.Text("107", style1);
        messageChambre107.x = 565;
        messageChambre107.y = 270;

        const messageChambre108 = new PIXI.Text("108", style1);
        messageChambre108.x = 665;
        messageChambre108.y = 180;

        const messageChambre109 = new PIXI.Text("109", style1);
        messageChambre109.x = 665;
        messageChambre109.y = 270;

        const messageChambre110 = new PIXI.Text("110", style2);
        messageChambre110.x = 750;
        messageChambre110.y = 225;

        const messageChambre111 = new PIXI.Text("111", style1);
        messageChambre111.x = 665;
        messageChambre111.y = 370;

        const messageChambre112 = new PIXI.Text("112", style1);
        messageChambre112.x = 765;
        messageChambre112.y = 370;

        const messageChambre113 = new PIXI.Text("113", style1);
        messageChambre113.x = 700;
        messageChambre113.y = 450;

        // étage 2

        const messageChambre201 = new PIXI.Text("201", style1);
        messageChambre201.x = 335;
        messageChambre201.y = 235;

        const messageChambre202 = new PIXI.Text("202", style1);
        messageChambre202.x = 530;
        messageChambre202.y = 270;

        const messageChambre203 = new PIXI.Text("203", style1);
        messageChambre203.x = 530;
        messageChambre203.y = 180;

        const messageChambre204 = new PIXI.Text("204", style1);
        messageChambre204.x = 665;
        messageChambre204.y = 180;

        const messageChambre205 = new PIXI.Text("205", style1);
        messageChambre205.x = 665;
        messageChambre205.y = 270;

        const messageChambre206 = new PIXI.Text("206", style2);
        messageChambre206.x = 750;
        messageChambre206.y = 225;


        const messageChambre207 = new PIXI.Text("207", style1);
        messageChambre207.x = 665;
        messageChambre207.y = 370;

        const messageChambre208 = new PIXI.Text("208", style1);
        messageChambre208.x = 765;
        messageChambre208.y = 370;

        const messageChambre209 = new PIXI.Text("209", style1);
        messageChambre209.x = 720;
        messageChambre209.y = 500;





        initialiser();





        function traiter_date() {

            let datejour = document.getElementById("date").value;

        }



        function insertion(numero, nom, datejour) {

            var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
            xhr.onreadystatechange = function() {
                // gestion de la réponse du serveur

                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(numero);

                    verification = 0;
                    for (i = 0; i < tableauCouleur.length; i++) {
                        if (tableauCouleur[i] == numero) {
                            verification = 1;
                        }
                    }
                    if (verification == 0) {
                        tableauCouleur.push(numero); // ajouter a la fin du tableau
                    }

                    if (numero <= 13) {
                        dessinerRDZ();
                    }

                    if (numero <= 113 && numero >= 101) {
                        dessiner1er();
                    }

                    if (numero <= 201 && numero >= 209) {
                        dessiner2n();
                        console.log("prout");
                    }


                    // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText

                    // verification si l'insertion est bien passé 
                    // console.log(xhr.responseText + "oi")
                    // var donnees = JSON.parse(xhr.responseText); // normalement un tableau à 3 éléments

                }

            }

            xhr.open("GET", "insertion.php?numero=" + numero + "&nom=" + nom + "&datejour=" + datejour, true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
            xhr.send(); // envoi de la requête HTTP
        }

        function supprimer(numero, datejour) {

            var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
            xhr.onreadystatechange = function() {
                // gestion de la réponse du serveur

                if (xhr.readyState == 4 && xhr.status == 200) {
                    // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText
                    let xhrObjet = JSON.parse(xhr.responseText);
                    let reponseValeur = xhrObjet.reponse;


                    if (reponseValeur === "vrai") {
                        for (i = 0; i < tableauCouleur.length; i++) {
                            if (tableauCouleur[i] == numero) {
                                let index = tableauCouleur.indexOf(numero);
                                tableauCouleur.splice(index, 1)
                            }
                        }

                        if (numero <= 13) {
                            dessinerRDZ();
                        }

                        if (numero <= 113 && numero >= 101) {
                            dessiner1er();
                        }

                        if (numero <= 201 && numero >= 209) {
                            dessiner2n();
                        }




                        //                         verification = 0;
                        //                                     for (i=0; i<tableauCouleur.length; i++) {
                        //                                         console.log(tableauCouleur[i]);
                        //                                         if (tableauCouleur[i] == numero) {
                        //                                                 verification = 1;
                        //                                         }
                        //                                     }
                        //                                         if (verification == 0) {
                        //                                             tableauCouleur.pop(numero); // ajouter a la fin du tableau
                        //                                             console.log(tableauCouleur[i]);
                        //                                         }
                        var donnees = JSON.parse(xhr.responseText); // normalement un tableau à 3 éléments
                    }

                }
            }

            xhr.open("GET", "supprimer.php?numero=" + numero + "&datejour=" + datejour, true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
            xhr.send(); // envoi de la requête HTTP
            console.log("ok");




        }




        // function initialiser

        function initialiser() {
            // pour chaque triangle
            for (let i = 0; i < tabRezDeChaussee.length; i++) {
                colorVerif(tabRezDeChaussee[i].n, document.getElementById("date").value);
                // console.log(tableauCouleur);
                tabRezDeChaussee[i].g.x = tabRezDeChaussee[i].x;
                tabRezDeChaussee[i].g.y = tabRezDeChaussee[i].y;
                tabRezDeChaussee[i].g.interactive = true; // on peut cliquer sur le triangle
                tabRezDeChaussee[i].g.on("pointertap", () => {
                    // console.log(tableauCouleur.length);
                    let test = "libre";
                    for (let j = 0; j < tableauCouleur.length; j++) {
                        if (tabRezDeChaussee[i].n == tableauCouleur[j]) {
                            test = "occupee";
                        }
                        // console.log(tableauCouleur[j]);
                        // console.log(tabRezDeChaussee[i].n);

                    }


                    if (test == "libre") {
                        let nom = prompt("Nom du client :", "");

                        if (nom === null) {
                            console.log("L'utilisateur a cliqué sur Annuler");
                        } else {
                            console.log("Bonjour, " + nom);
                            let numero = tabRezDeChaussee[i].n;
                            let datejour = document.getElementById("date").value;
                            insertion(numero, nom, datejour);
                        }




                    }
                    if (test == "occupee") {
                        let datejour = document.getElementById("date").value;
                        let numero = tabRezDeChaussee[i].n;
                        if (window.confirm("Voulez vous supprimer")) {
                            supprimer(numero, datejour);

                            if (numero <= 13) {
                                dessinerRDZ();
                            }

                            if (numero <= 113 && numero >= 101) {
                                dessiner1er();
                            }

                            if (numero <= 201 && numero >= 209) {
                                dessiner2n();
                            }
                        }


                        //                         let sup = prompt("Voulez vous supprimer : ", "oui/non");
                        //                         if (sup == "oui") {
                        //                         supprimer(numero, datejour);
                        //                         console.log(test);
                        //                     }
                    }

                });


            }


            for (let i = 0; i < tabPremierEtage.length; i++) {
                colorVerif(tabPremierEtage[i].n, document.getElementById("date").value);

                tabPremierEtage[i].g.x = tabPremierEtage[i].x;
                tabPremierEtage[i].g.y = tabPremierEtage[i].y;
                tabPremierEtage[i].g.interactive = true;
                tabPremierEtage[i].g.on("pointertap", () => {
                    console.log(tableauCouleur.length);
                    let test = "libre";
                    for (let j = 0; j < tableauCouleur.length; j++) {
                        if (tabPremierEtage[i].n == tableauCouleur[j]) {
                            test = "occupee";
                        }
                        // console.log(tableauCouleur[j]);
                        // console.log(tabPremierEtage[i].n);

                    }
                    if (test == "libre") {
                        let nom = prompt("Nom du client :", "");

                        if (nom === null) {
                            console.log("L'utilisateur a cliqué sur Annuler");
                        } else {
                            console.log("Bonjour, " + nom);
                            let numero = tabPremierEtage[i].n;
                            let datejour = document.getElementById("date").value;
                            insertion(numero, nom, datejour);
                        }



                    }

                    if (test == "occupee") {
                        let datejour = document.getElementById("date").value;
                        let numero = tabPremierEtage[i].n;

                        if (window.confirm("Voulez vous supprimer")) {
                            supprimer(numero, datejour);

                            if (numero <= 13) {
                                dessinerRDZ();
                            }

                            if (numero <= 113 && numero >= 101) {
                                dessiner1er();
                            }

                            if (numero <= 201 && numero >= 209) {
                                dessiner2n();
                            }
                        }

                    }
                });


            }



            for (let i = 0; i < tabDeuxiemeEtage.length; i++) {
                colorVerif(tabDeuxiemeEtage[i].n, document.getElementById("date").value);
                tabDeuxiemeEtage[i].g.x = tabDeuxiemeEtage[i].x;
                tabDeuxiemeEtage[i].g.y = tabDeuxiemeEtage[i].y;
                tabDeuxiemeEtage[i].g.interactive = true;
                tabDeuxiemeEtage[i].g.on("pointertap", () => {
                    // console.log(tableauCouleur.length);
                    console.log(tableauCouleur);
                    let test = "libre";
                    for (let j = 0; j < tableauCouleur.length; j++) {
                        if (tabDeuxiemeEtage[i].n == tableauCouleur[j]) {
                            test = "occupee";
                        }
                        // console.log(tableauCouleur[j]);
                        // console.log(tabDeuxiemeEtage[i].n);

                    }

                    if (test == "libre") {
                        let nom = prompt("Nom du client :", "");

                        if (nom === null) {
                            console.log("L'utilisateur a cliqué sur Annuler");
                        } else {
                            console.log("Bonjour, " + nom);
                            let numero = tabDeuxiemeEtage[i].n;
                            let datejour = document.getElementById("date").value;
                            insertion(numero, nom, datejour);
                        }

                    }




                    if (test == "occupee") {
                        let datejour = document.getElementById("date").value;
                        let numero = tabDeuxiemeEtage[i].n;


                        if (window.confirm("Voulez vous supprimer")) {
                            supprimer(numero, datejour);

                            if (numero <= 13) {
                                dessinerRDZ();
                            }

                            if (numero <= 113 && numero >= 101) {
                                dessiner1er();
                            }

                            if (numero <= 201 && numero >= 209) {
                                dessiner2n();
                            }
                        }
                    }
                });

            }


        }


        // function dessiner rez de chaussé
        function color(numero, datejour, chambre, etage) {
            if (numero != 14) {
                var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
                xhr.onreadystatechange = function() {
                    // gestion de la réponse du serveur

                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText
                        // console.log(xhr.responseText);
                        var donnees = JSON.parse(xhr.responseText); // normalement un tableau à 3 éléments

                        chambre.g.beginFill("" + donnees[0]);
                        // console.log(donnees[0]);

                        // if (donnees[0] == "0xFF0000") {
                        //     tableauCouleur.push(numero);
                        // }


                        chambre.g.drawRect(chambre.x, chambre.y, chambre.l, chambre.h);
                        chambre.g.endFill();
                        appli.stage.addChild(chambre.g);

                        if (etage == 0) {
                            appli.stage.addChild(messageChambre1, messageChambre2, messageChambre3, messageChambre4, messageChambre5, messageChambre6, messageChambre7, messageChambre8,
                                messageChambre9, messageChambre10, messageChambre11, messageChambre12, messageChambre13, Reception, messageReception);






                        }
                        if (etage == 1) {
                            appli.stage.addChild(messageChambre101, messageChambre102, messageChambre103, messageChambre104, messageChambre105, messageChambre106, messageChambre107, messageChambre108,
                                messageChambre109, messageChambre110, messageChambre111, messageChambre112, messageChambre113);

                            appli.stage.removeChild(messageChambre1, messageChambre2, messageChambre3, messageChambre4, messageChambre5, messageChambre6, messageChambre7, messageChambre8,
                                messageChambre9, messageChambre10, messageChambre11, messageChambre12, messageChambre13, messageReception, Reception);

                            appli.stage.removeChild(messageChambre201, messageChambre202, messageChambre203, messageChambre204, messageChambre205, messageChambre206, messageChambre207, messageChambre208, messageChambre209);




                        }

                        if (etage == 2) {
                            appli.stage.addChild(messageChambre201, messageChambre202, messageChambre203, messageChambre204, messageChambre205, messageChambre206, messageChambre207, messageChambre208, messageChambre209);

                            appli.stage.removeChild(messageChambre1, messageChambre2, messageChambre3, messageChambre4, messageChambre5, messageChambre6, messageChambre7, messageChambre8,
                                messageChambre9, messageChambre10, messageChambre11, messageChambre12, messageChambre13, messageReception);


                            appli.stage.removeChild(messageChambre101, messageChambre102, messageChambre103, messageChambre104, messageChambre105, messageChambre106, messageChambre107, messageChambre108,
                                messageChambre109, messageChambre110, messageChambre111, messageChambre112, messageChambre113);



                        }


                    }
                }

                xhr.open("GET", "occupe.php?numero=" + numero + "&datejour=" + datejour, true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
                xhr.send(); // envoi de la requête HTTP
                //                     console.log("ok");
            }


        }

        function colorVerif(numero, datejour) {
            if (numero != 14) {
                var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
                xhr.onreadystatechange = function() {
                    // gestion de la réponse du serveur

                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText
                        // console.log(xhr.responseText);
                        var donnees = JSON.parse(xhr.responseText); // normalement un tableau à 3 éléments

                        // chambre.g.beginFill("" + donnees[0]);
                        console.log(donnees[0]);

                        console.log(numero);

                        if (donnees[0] == "0xFF0000") {
                            tableauCouleur.push(numero);
                        }


                    }
                }

                xhr.open("GET", "occupe.php?numero=" + numero + "&datejour=" + datejour, true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
                xhr.send(); // envoi de la requête HTTP
                //                     console.log("ok");
            }


        }




        function dessinerRDZ() {
            let datejour = document.getElementById("date").value;
            console.log(datejour);

            for (let i = 0; i < tabRezDeChaussee.length; i++) {
                // si besoin de faire les popus mettre ça 
                //     const chambre = tabRezDeChaussee[i];
                // et modifier en dessous la l'affichage de color en se référenciant à gtp 
                color(tabRezDeChaussee[i].n, datejour, tabRezDeChaussee[i], 0);


            }



            // faire les messages des chambres du rez de chaussée


            appli.stage.addChild(messageChambre1, messageChambre2, messageChambre3, messageChambre4, messageChambre5, messageChambre6, messageChambre7, messageChambre8,
                messageChambre9, messageChambre10, messageChambre11, messageChambre12, messageChambre13, messageReception);

            appli.stage.removeChild(messageChambre101, messageChambre102, messageChambre103, messageChambre104, messageChambre105, messageChambre106, messageChambre107, messageChambre108,
                messageChambre109, messageChambre110, messageChambre111, messageChambre112, messageChambre113);

            appli.stage.removeChild(messageChambre201, messageChambre202, messageChambre203, messageChambre204, messageChambre205, messageChambre206, messageChambre207, messageChambre208, messageChambre209);








            // on enlève le 1er étage
            for (let i = 0; i < tabPremierEtage.length; i++) {
                appli.stage.removeChild(tabPremierEtage[i].g);
            }



            // on enlève le 2ème étage
            for (let i = 0; i < tabDeuxiemeEtage.length; i++) {
                appli.stage.removeChild(tabDeuxiemeEtage[i].g);
            }





        }


        // function dessiner premier étage


        function dessiner1er() {

            // on enlèvre le RDZ
            for (let i = 0; i < tabRezDeChaussee.length; i++) {
                appli.stage.removeChild(tabRezDeChaussee[i].g);
            }

            // on enlève le 2 eme 

            for (let i = 0; i < tabDeuxiemeEtage.length; i++) {
                appli.stage.removeChild(tabDeuxiemeEtage[i].g);
            }

            let datejour = document.getElementById("date").value;
            for (let i = 0; i < tabPremierEtage.length; i++) {
                //alert();
                color(tabPremierEtage[i].n, datejour, tabPremierEtage[i], 1);
            }



        }


        // function dessiner deuxième étage

        function dessiner2n() {
            // on enlèvre le RDZ
            for (let i = 0; i < tabRezDeChaussee.length; i++) {
                appli.stage.removeChild(tabRezDeChaussee[i].g);
            }
            // on enleve le premier
            for (let i = 0; i < tabPremierEtage.length; i++) {
                appli.stage.removeChild(tabPremierEtage[i].g);
            }

            // on met le 2eme
            let datejour = document.getElementById("date").value;
            for (let i = 0; i < tabDeuxiemeEtage.length; i++) {
                //alert();
                color(tabDeuxiemeEtage[i].n, datejour, tabDeuxiemeEtage[i], 2);
            }


            appli.stage.addChild(messageChambre201, messageChambre202, messageChambre203, messageChambre204, messageChambre205, messageChambre206, messageChambre207, messageChambre208, messageChambre209);
            appli.stage.removeChild(messageChambre1, messageChambre2, messageChambre3, messageChambre4, messageChambre5, messageChambre6, messageChambre7, messageChambre8,
                messageChambre9, messageChambre10, messageChambre11, messageChambre12, messageChambre13, messageReception);

        }
    </script>


    <button id="bouton1" value="Rezdechaussee" name="Rezdechaussee" onclick="dessinerRDZ()">Rez de chaussée</button>
    <button id="bouton2" value="PremierEtage" name="PremierEtage" onclick="dessiner1er()">Premier Etage</button>
    <button id="bouton3" value="DeuxiemeEtage" name="DeuxiemeEtage" onclick="dessiner2n()">Deuxième Etage</button>


</body>

</html>