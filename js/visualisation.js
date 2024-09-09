$("#tableau").click(function (event) { 
    console.log("click")
    ajaxRequest("GET", "../php/request.php/arbres/" , loadTableau)
    $('#map-container').hide();
    $('#tableau_load').show();
    $('#recherche').show();
    $('#tri').show();
})

console.log("visualisation.js")

// à mettre dans ta fonction load tableau pour que ce ne soit pas affiché comme de la merde au

var keys = ['id_arbre', 'longitude', 'latitude', 'nom_stadedev', 'nomtech', 'clc_nbr_diag', 'haut_tot', 'haut_tronc', 'tronc_diam', 'nom_feuillage'];

var fieldOptions = '';
keys.forEach(function(key) {
    fieldOptions += '<option value="' + key + '">' + key + '</option>';
});

// var html = '<span>Trier par: </span><select id="sortField">' + fieldOptions + '</select>';
// html += '<span>Par ordre: </span><select id="sortOrder"><option value="asc">Croissant</option><option value="desc">Décroissant</option></select>';
// html += '<button id="trier" class="ok">Trier</button>';

// $("#tri").html(html);


var html = '<span>Filtrer par: </span><select id="filtreField">' + fieldOptions + '</select>';
html+= '<input type="text" id="barre_recherche" placeholder="recherche">';
html += '<div id="filtre"></div>';

$("#recherche").html(html);


compt_page = 0 //nombre de page
var treesPerPage = 5; // Nombre d'arbres à afficher par page


function loadTableau(trees_original) {
    // console.log(trees_original);
    //copie le tableau trees
    trees = trees_original.slice();
    // console.log(trees);
    
    var filterField = $("#filtreField").val();
    var searchString = $("#barre_recherche").val().toLowerCase();

    // Filtre le tableau trees en fonction du champ sélectionné et de la chaîne de recherche
    if (searchString) {
        trees = trees.filter(function(tree) {
            // Convertit la valeur du champ en chaîne et la compare à la chaîne de recherche
            return tree[filterField].toString().toLowerCase().includes(searchString);
        });
    }
    
    //PROBLEME AVEC LE TRI, FAISAIT PARFOIS CRASH

    // Application du tri en fonction des options sélectionnées
    // var sortField = $("#sortField").val();
    // var sortOrder = $("#sortOrder").val();

    // //trie le tableau trees dans l'ordre du sortOrder, à partir de la colonne sortField
    // trees.sort(function(a, b) {
    //     // Si nous trions par 'id_arbre', convertissons les valeurs en nombres
    //     if (sortField === 'id_arbre') {
    //         // Convertir en entiers pour comparer numériquement
    //         return (sortOrder === 'asc' ? 1 : -1) * (parseInt(a[sortField]) - parseInt(b[sortField]));
    //     }
    
    //     // Pour les autres champs, continuez avec le tri lexicographique
    //     if (a[sortField] < b[sortField]) {
    //         return sortOrder === 'asc' ? -1 : 1;
    //     }
    //     if (a[sortField] > b[sortField]) {
    //         return sortOrder === 'asc' ? 1 : -1;
    //     }
    //     return 0;
    // });
    
    var startIndex = compt_page * treesPerPage;
    var endIndex = startIndex + treesPerPage;
    var slicedTrees = trees.slice(startIndex, endIndex); // Ne prend que les arbres pour la page actuelle
    html = ""
    html += "<table>";
    // rajoute la ligne titre avec les differentes colonnes
    html += "<tr>";
    keys.forEach(function(key) {
        html += "<th>"+key+"</th>";
    });
    html += "<th>Action</th>";
    html += "</tr>";


    slicedTrees.forEach(function(tree) {
        html += "<tr>";
        html += "<td>"+tree.id_arbre+"</td>";
        html += "<td>"+tree.longitude+"</td>";
        html += "<td>"+tree.latitude+"</td>";
        html += "<td>"+tree.nom_stadedev+"</td>";
        html += "<td>"+tree.nomtech+"</td>";
        html += "<td>"+tree.clc_nbr_diag+"</td>";
        html += "<td>"+tree.haut_tot+"</td>";
        html += "<td>"+tree.haut_tronc+"</td>";
        html += "<td>"+tree.tronc_diam+"</td>";
        html += "<td>"+tree.nom_feuillage+"</td>";
        html += "<td><button id_arbre="+ tree.id_arbre + " class=bouton_age>predire_age</button></td>";
        html += "</tr>";
    });
    html += "</table>";

    html += "<button id='avant' class='ok'>Avant</button>";
    html += "Page : <input type='number' id='num_page' min='1' style='width: 60px;' value='"+(compt_page+1)+"'>";
    html += "<button id='apres' class='ok'>Après</button>";

    $("#tableau_load").html(html);

    // Gestion des clics sur les boutons de pagination
    $("#avant").click(function() {
        if (compt_page > 0) {
            console.log(compt_page)

            compt_page--;
            loadTableau(trees_original); // Recharger la table avec la nouvelle page
        }
    });

    $("#apres").click(function() {
        if (endIndex < trees.length) {
            console.log(compt_page)

            compt_page++;
            loadTableau(trees_original); // Recharger la table avec la nouvelle page
        }
    });

    $("#num_page").on("change", function() {
        var requestedPage = parseInt($(this).val()) - 1; // Convertit en index basé sur zéro
        compt_page = requestedPage;
        loadTableau(trees_original);
        
    });

    // // Écouteur d'événements pour les sélections de tri
    // $("#trier").click(function() {
    //     compt_page = 0
    //     loadTableau(trees_original); // Recharger le tableau avec les nouvelles options de tri
    // });

    //on desactive cet event car il va être rappelé (évite des les "empiler" et d'en rajouter un à chaque fois) (impossibilité de le mettre en dehors de la fonction car besoin du tableau tree_original)
    $("#barre_recherche").off('input');
    $("#barre_recherche").on("input",function() {
        compt_page = 0
        loadTableau(trees_original);
    });

    $("#filtreField").change(function() {
        compt_page=0;
        loadTableau(trees_original);
    });

    
}


$("#carte").click(function (event) { 
    console.log("click")
    ajaxRequest("GET", "../php/request.php/arbres/" , loadCarte)
    $('#map-container').show();
    $('#tableau_load').hide();
    $('#recherche').hide();
    $('#tri').hide();
})



function loadCarte(trees) {
    const latitude = trees.map(tree => parseFloat(tree.latitude));
    const longitude = trees.map(tree => parseFloat(tree.longitude));

    var data = [{
        type: 'scattermapbox',
        lat: latitude,
        lon: longitude,
        mode: 'markers',
        marker: {size: 10, color: 'green'}
    }];

    var layout = {
        mapbox: {
            style: 'open-street-map', 
            center: {lat: 49.847066, lon: 3.2874}, 
            zoom: 12
        },
        margin: {r: 0, t: 0, l: 0, b: 0}
    };

    Plotly.newPlot('map2', data, layout);

    // Affichez la carte et masquez les autres éléments si nécessaire
    
}

$("#tableau_carte").click(function (event) { 
    console.log("click")
    ajaxRequest("GET", "../php/request.php/arbres/" , LoadAll)
})

function LoadAll(trees){
    loadTableau(trees)
    loadCarte(trees)

    $('#recherche').show();
    $('#tri').show();
    $('#tableau_load').show();
    $('#map-container').show();
}

// Gestion des clics sur les boutons de prediction de l'age
$("#tableau_load").on("click", ".bouton_age",function() {
    console.log("click age")
    var id_arbre = $(this).attr("id_arbre");
    window.location.href = "../vues/prediction_age.php?id_arbre=" + id_arbre;
});