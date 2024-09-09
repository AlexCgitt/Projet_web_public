<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/style_contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <title>Connexion - Saint Quentree</title>
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
            <h1>Contact <span class="material-symbols-outlined">forest</span></h1>
            <p>Découvrez l'équipe de développement</p>
        </div>
        <section class="team">
            <!-- Image à chager -->
            <div class="team-member">
                <a href="https://www.linkedin.com/in/maxime-bellenger-3b4a24260/">
                    <img src="../img/visu.jpg" alt="Maxime">
                </a>
                <h3>Maxime</h3>
                <p>Click</p>
            </div>
            <!-- Image à chager -->
            <div class="team-member">
                <a href="https://www.linkedin.com/in/alexandre-cavaro-a3b854252/">
                    <img src="../img/visu.jpg" alt="Alexandre">
                </a>
                <h3>Alexandre</h3>
                <p>Click</p>
            </div>
            <!-- Demander à Emir son linkedin-->
             <!-- Image à chager -->
            <div class="team-member">
                <a href="https://www.linkedin.com/in/emir-yavuz-340916260?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app">
                    <img src="../img/visu.jpg" alt="Emir">
                </a>
                <h3>Emir</h3>
                <p>Click</p>
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