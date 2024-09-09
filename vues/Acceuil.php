<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/style_acceuil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <title>SAINT-QUENTREE</title>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="./Acceuil.php">
                <img src="../img/logo.png" alt="logo">
            </a>
        </div>
        <ul>
            <li><a href="./Ajout.php">Ajout d'arbres</a></li>
            <li><a href="./visualisation.php">Visualisation</a></li>
            <li><a href="./prediction.php">Prediction</a></li>
            <li><a href="./contact.php">Contact</a></li>
        </ul>
        <div class="login">
            <a href="./Login.php">log in</a>/<a href="logout.php">log out</a>

        </div>
    </nav>
    
    <main>
        <div class="title-section">
            <div>
                <h1>SAINT-QUENTREE</h1>
                <p>Le but du projet a été de concevoir et de développer une application de gestion du patrimoine arboré pour la ville de Saint-Quentin (Aisne). Tout d'abord, une partie analyse avec la réalisation d'une maquette figma avec la charte graphique, la réalisation d'un MCD, et une partie conceptuel avec le front-end. Enfin une partie back-end, avec des scripts python, que ce soit les imports des données initiales, la visualisation d'une carte détaillé avec les clusters, et la visualisation des arbres dans un tableau avec la prédiction de l'âge.</p>
            </div>
            <img src="../img/saint_quentree.png">
        </div>
        <section class="grid-container">
            <div class="grid-item">
                <a href="./Ajout.php">
                    <img src="../img/ajout.jpg" alt="Ajout d'arbres">
                </a>
                <h2>Ajout d'arbres</h2>
                <p>Vous venez de planter un arbre, ajoutez-le au site</p>  
            </div>
            <div class="grid-item">
                <a href="visualisation.php">
                    <img src="../img/visu.jpg" alt="Visualisation">
                </a>
                <h2>Visualisation</h2>
                <p>Visualisez les arbres de la ville de Saint-Quentin dans un tableau ou sur une carte.</p>
                
            </div>
            <div class="grid-item">
                <a href="./prediction.php">
                    <img src="../img/prediction.jpg" alt="Prediction">
                </a>
                <h2>Prediction</h2>
                <p>Prédisez l'emplacement des arbres et leur cluster.</p>
                
            </div>
            <div class="grid-item">
                <a href="./contact.php">
                    <img src="../img/contact.jpg" alt="Contact">
                </a>
                <h2>Contact</h2>
                <p>En cas de problème, n'hésitez pas à contacter l'équipe.</p>
            </div>
        </section>
    </main>

    <footer>
        <p class="centre">SAINT-QUENTREE</p>
        <div class="colonnes">
            <div class="colonne">
                <p class="centre">Contact</p>
                <div class="social-icons">
                    <a class="facebook" href="https://www.facebook.com/villedesaintquentin.OFFICIEL/?locale=fr_FR"><i class="fa-brands fa-facebook"></i></a>
                    <a class="twitter" href="https://x.com/a_saint_quentin"><i class="fa-brands fa-twitter"></i></a>
                    <a class="insta" href="https://www.instagram.com/villesaintquentin/"><i class="fa-brands fa-instagram"></i></a>
                    <a class="internet" href="https://www.saint-quentin.fr/"><i class="fa-brands fa-internet-explorer"></i></a>   
                </div>
            </div>
            <div class="colonnes">
                <div id="map" style="width: 50%; height: 30vh;"></div>
            </div>
            <div class="colonne">
                <p>Adresse</p>
                <p>1 rue des arbres</p>
                <p>02100 Saint-Quentin</p>
            </div>
        </div>
    </footer>
    <script>var data = [{
                type: 'scattermapbox',
            }];var layout = {
    mapbox: {style: 'open-street-map', center: {lat: 49.847066, lon: 3.2874}, zoom: 12},
    margin: {r: 0, t: 0, l: 0, b: 0}
    }; Plotly.newPlot('map', data, layout);</script>
    
</body>
</html>
