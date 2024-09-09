const params = new URLSearchParams(window.location.search);

// Utiliser la méthode get() pour récupérer la valeur du paramètre 'id_arbre'
const id_arbre = params.get('id_arbre');

console.log(id_arbre); 

ajaxRequest("GET", "../php/request.php/age/"+id_arbre, showAges);


function showAges(modeles) {
    console.log(modeles)
    //alert("L'age de l'arbre est de " + response.age + " ans.");

    compt_modele=0
    compt_age = 0
    $("#predictions_age").html("Résultat des prédictions en fonction des modèles :");
    Object.keys(modeles).forEach(function(nomModele){
        compt_modele++;
        compt_age += modeles[nomModele]
        let html = `<p>Modèle : ${nomModele} => ${modeles[nomModele]}</p>`;
        $("#predictions_age").append(html);
    });

    let moyenne = compt_age/compt_modele;
    $("#predictions_age").append(`<p>Moyenne des prédictions : ${moyenne}</p>`);
    
    

}