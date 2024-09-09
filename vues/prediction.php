<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/style_prediction.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <title>SAINT-QUENTREE - prediction</title>
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
            <h1>Prédiction <span class="material-symbols-outlined">forest</span></h1>
            <p>Quelle prédiction souhaitez vous observer</p>
        </div>
        <section class="display-choice">
            <h2>Choisissez la prédiction que vous souhaitez observer</h2>
            <div class="grid-container">
                <div id="tableau" class="grid-item">
                    <a href="prediction_age.php">
                        <img src="../img/pred_age.jpg" alt="prediccion">
                    </a>
                    <h3>Prédiction de l'âge</h3>
                    <p>Click</p>
                </div>
                <div id="carte" class="grid-item">
                    <a href="prediction_cluster.php">
                        <img src="../img/arbre_cluster.jpg" alt="Clusterr">
                    </a>
                    <h3>Prediction du cluster</h3>
                    <p>Click</p>
                </div>
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
