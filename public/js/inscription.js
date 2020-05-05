//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

var cours1 = 0;
var cours2 = 0;
var cours3 = 0;
var cours4 = 0;


$(".clickable").on("click", function () {



});

$("#dateJour").on("change", function () {

    let dateChoisie = $(this).val();
    // récupère la valeur du select

    function createCoursElement(cours_id, intitule, bloc, gestion, indus, reseau, heure_debut, heure_fin, type, horaire){

        /*
        <a href="#" data-cours-id="0" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
            </div>
            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        </a>
        */


        let a = document.createElement("a");
        // a.tout ce que tu veux
        let a_class = ["list-group-item ", "list-group-item-action ", "clickable ", "horaire"+horaire];
        a_class.forEach(classElement => a.className += classElement);

        a.setAttribute("data-cours-id", cours_id);

        let div = document.createElement("div");
        //pareil
        let div_class = ["d-flex ", "w-100 ", "justify-content-between"];
        div_class.forEach(classElement => div.className += classElement);

        let h5 = document.createElement("h5");
        h5.innerText = intitule;
        let h5_class = ["mb-1 "];
        h5_class.forEach(classElement => h5.className += classElement);


        let small = document.createElement("small");
        small.innerText = heure_debut + "~" + heure_fin;
        let small_class = ["mb-1 "];
        small_class.forEach(classElement => small.className += classElement);

        div.appendChild(h5);
        div.appendChild(small);


        let p = document.createElement("p");
        p.innerText = "Type de cours : " + type;


        p.innerText += " / Finalités : ";
        if(gestion === "1"){
            p.innerText += "Gestion ";
        }
        if(reseau === "1"){
            p.innerText += "Réseaux ";
        }
        if(indus === "1"){
            p.innerText += "Indus ";
        }

        let p_class = ["mb-1 "];
        p_class.forEach(classElement => p.className += classElement);

        a.appendChild(div);
        a.appendChild(p);

        return a;
    }


    function updateSelect(tranche){
        // on va faire 4 req. ajax, chaque vont peupler les select correpondant
        $.ajax({
            type: "POST",                                           // type de requete
            url: "/api/inscription/getAllHorairesByDate.php",       // url de la requete
            data: {                                                 // data de la requetes, les paramètres
                date: dateChoisie,
                tranche: tranche,
            },
            dataType: "json",                                 // le type de data attendu par jquery
            success: function (result, data, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
                if(xhrStatus.status === 200){
                    if(result.error === true){
                        toastr["warning"](result.message, "Erreur");              // on affiche le toast
                    }else{
                        toastr["success"](result.message, "Succès");              // on affiche le toast



                        // dans le selecteur de dateJour, je veux trouver tout les tag options (sauf le premier), je veux ensuite les enelever,
                        result.data.forEach(horaire => $('#liste-cours-horaire-tranche-'+tranche).append(createCoursElement(
                            horaire.cours_id,
                            horaire.intitule,
                            horaire.bloc,
                            horaire.gestion,
                            horaire.indus,
                            horaire.reseau,
                            horaire.heure_debut,
                            horaire.heure_fin,
                            horaire.type,
                            tranche,
                        )));

                    }
                }
            },
            error: function (result) {
                toastr["error"]("Oops !", "Erreur !"); // toast..
            },
            complete: function(result){ // on execute le quoi que ce soit une erreur ou non

            },
        });
    }

    /*
    * Pourquoi ne pas avoir executé le code plusieur fois dans la boucle ?
    *
    * Simplement car je l'ai testé. Le problème était le parralelisme, quand j'avais fait mes 4
    * requetes, ma variable iHoraire était = à 5, lors du callback, je prenais cette valeur là
    * mais la valeur était à 5 et donc le selecteur était invalide.
    *
    * Solution, créer la fonction, avec comme paramètre le numéro de la tranche horaire
    * pour ne pas que cette valeur ne change , et si elle change, apres l'appel à la fct
    * alors ça ne causera pas de soucis.
    * */

    let iHoraire = 1;
    while(iHoraire <= 4){
        updateSelect(iHoraire);
        iHoraire++;
    }

});
