<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style/style_ajout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <title>SAINT-QUENTREE - Ajout d'arbre</title>
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
        <h1>Votre arbre a-t-il bien été ajouté à notre base de données<span class="material-symbols-outlined">forest</span></h1>
        <?php
        $servername = "localhost";
        $username = "etu1105";
        #$password = private; not in the public repo
        $dbname = "etu1105";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        # Récupération des valeurs du formulaire
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $id_stadedev = $_POST['stade_developpement'];
        $id_nomtech = $_POST['nom_technique'];
        $nombre_diagnostics = $_POST['nombre_diagnostics'];
        $hauteur_tronc = $_POST['hauteur_tronc'];
        $diametre_tronc = $_POST['diametre_tronc'];
        $hauteur_totale = $_POST['hauteur_totale'];
        $id_feuillage = $_POST['feuillage'];

        # Requêtre pour ajouter un arbre
        $sql = "INSERT INTO Arbre (longitude, latitude, id_stadedev, id_nomtech, clc_nbr_diag, haut_tronc, tronc_diam, haut_tot, id_feuillage, remarquable, revetement, identifiant, id_port, id_villeca, id_pied, id_situation, id_arbreetat, id_secteur, id_quartier)
                VALUES ('$longitude', '$latitude', '$id_stadedev', '$id_nomtech', '$nombre_diagnostics', '$hauteur_tronc', '$diametre_tronc', '$hauteur_totale', '$id_feuillage', 'Non', 'Non', 'user1', '1', '1', '1', '1', '1', '1', '1')";

        if ($conn->query($sql) === TRUE) {
            echo "Les données ont été ajoutées avec succès.";
            $last_id = $conn->insert_id; // recupère l'identifiant du dernier arbre
        } else {
            echo "Erreur : " . $conn->error;
        }

        # Récupérer les données du dernier arbre ajouté
        $sql_last = "SELECT * FROM Arbre WHERE id_arbre = '$last_id'";
        $result = $conn->query($sql_last);
        $last_tree = $result->fetch_assoc();

        $conn->close();
        ?>
        <p>Retrouvez dès à présent votre arbre sur la carte</p>
        <a href="prediction_cluster.php"><button style="width: 20%;
    margin-top: 2%;
    margin-bottom: 2%;
    padding: 1em;
    background: black;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 1em;
    cursor: pointer;">Prediction du cluster de l'arbre que vous venez de rentrer</button></a>
        <div id="map" style="width: 100%; height: 100vh;"></div>
        <script>
        // Fonction pour charger les données du dernier arbre
        function loadLastTree() {
            const latitude = <?php echo $last_tree['latitude']; ?>;
            const longitude = <?php echo $last_tree['longitude']; ?>;
            plotMap(latitude, longitude);
        }

        // Fonction pour tracer la carte avec Plotly
        function plotMap(latitude, longitude) {
            var data = [{
                type: 'scattermapbox',
                lat: [latitude],
                lon: [longitude],
                mode: 'markers',
                marker: {size: 10, color: 'green'}
            }];
            var layout = {
                mapbox: {style: 'open-street-map', center: {lat: latitude, lon: longitude}, zoom: 12},
                margin: {r: 0, t: 0, l: 0, b: 0}
            };
            Plotly.newPlot('map', data, layout);
        }
        loadLastTree();
        </script>
    </div>
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
</body>
</html>
