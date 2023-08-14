<!DOCTYPE html>
<html>
  <head>
    <title>PixiJS - Couleurs avec Ajax - 2</title>
    <meta charset="UTF-8" />
    <script src="bibliotheques/pixi.js"></script>
  </head>
  <body>

    <p>Cliquez sur les triangles</p>
    <script>
        // création de l'application Pixi
        const appli = new PIXI.Application({ width: 1000, height: 800, backgroundColor: 0xeeeeee, antialias: true, clearBeforeRender: true }); // largeur, hauteur
        document.body.appendChild(appli.view);

        // x, y : position du triangle
        // p : coordonnées des points pour le dessin du triangle
        // g : le graphique au sens Pixi
        let t1 = {x: 100, y: 50, p: [0, 0, 30, 70, -30, 70], g: new PIXI.Graphics()};
        let t2 = {x: 150, y: 50, p: [0, 0, 30, 70, -30, 70], g: new PIXI.Graphics()};
        let t3 = {x: 200, y: 50, p: [0, 0, 30, 70, -30, 70], g: new PIXI.Graphics()};

        let tabTriangles = [t1, t2, t3]; // permet de manipuler les triangles sous forme d'une collection

        initialiser();
        dessiner();

        function initialiser() {
            // pour chaque triangle
            for(let i = 0; i < tabTriangles.length; i++) {
                tabTriangles[i].g.x = tabTriangles[i].x;
                tabTriangles[i].g.y = tabTriangles[i].y;
                tabTriangles[i].g.interactive = true; // on peut cliquer sur le triangle
                tabTriangles[i].g.on("pointertap", () => {
                    // traitement quand on clique sur le triangle
                    changerCouleur(tabTriangles[i]);
                });

                //appli.stage.addChild(tabTriangles[i].g);
            }
        }

        function dessiner() {
            // pour chaque triangle
            for(let i = 0; i < tabTriangles.length; i++) {
                tabTriangles[i].g.beginFill(0x7FFFD4);
                tabTriangles[i].g.drawPolygon(tabTriangles[i].p);
                tabTriangles[i].g.endFill();
                appli.stage.addChild(tabTriangles[i].g);
            }

        }

        function changerCouleur(triangle) {
            var xhr = new XMLHttpRequest(); // instanciation d'un objet XMLHttpRequest
            xhr.onreadystatechange = function() {
                // gestion de la réponse du serveur

                if (xhr.readyState == 4  &&  xhr.status == 200) {
                    // récupération de la réponse du serveur au format JSON contenu dans xhr.responseText
                    var donnees = JSON.parse(xhr.responseText); // normalement un tableau à 3 éléments

                    triangle.g.beginFill(donnees[0] * donnees[1] * donnees[2]); // choix d'une couleur au hasard fourni par le serveur
                    triangle.g.drawPolygon(triangle.p);
                    triangle.g.endFill();
                }
            }

            xhr.open("GET", "traitement.php", true); // préparation de la requête HTTP (ici la méthode GET, appel d'un script PHP avec un paramètre)
            xhr.send(); // envoi de la requête HTTP
        }

    </script>

  </body>
</html>
