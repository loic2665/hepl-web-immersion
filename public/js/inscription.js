//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

import * as requetes from '/js/requeteAjax.js'

$("#dateJour").on("change", function () {

    dateChoisie = $(this).val();
    // récupère la valeur du select

    cours1 = 0;
    cours2 = 0;
    cours3 = 0;
    cours4 = 0;

    function createCoursElement(cours_id, intitule, bloc, gestion, indus, reseau, heure_debut, heure_fin, type, tranche){

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
        let a_class = ["list-group-item", "list-group-item-action", "clickable", "tranche"+tranche];
        a_class.forEach(classElement => $(a).addClass(classElement));

        a.setAttribute("data-cours-id", cours_id);
        a.setAttribute("data-cours-name", intitule + " - " + type + " - " + heure_debut + "~" + heure_fin);
        a.setAttribute("data-tranche", tranche);

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
        p.innerText = "Bloc "+ bloc +" | Type de cours : " + type;


        p.innerText += " | Finalités : ";
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


    function updateSelect(){
        // on va faire 4 req. ajax, chaque vont peupler les select correpondant

        let data = {
            date: dateChoisie
        }

        function callbackSuccess(result){

            if(result.error === true){
                toastr["warning"](result.message, "Erreur");              // on affiche le toast
            }else{
                toastr["success"](result.message, "Succès");              // on affiche le toast

                for(let i = 0; i < result.data.length; i++){

                    if((i === 2 || i === 3) && nbJours > 1){
                        $('#liste-cours-horaire-tranche-'+(i+1)).find('a:not(:first)').remove();
                    }else{
                        $('#liste-cours-horaire-tranche-'+(i+1)).find('a').remove();
                    }
                    // dans le selecteur de dateJour, je veux trouver tout les tag options (sauf le premier), je veux ensuite les enelever,
                    result.data[i].forEach(horaire => $('#liste-cours-horaire-tranche-'+(i+1)).append(createCoursElement(
                        horaire.cours_id,
                        horaire.intitule,
                        horaire.bloc,
                        horaire.gestion,
                        horaire.indus,
                        horaire.reseau,
                        horaire.heure_debut,
                        horaire.heure_fin,
                        horaire.type,
                        i+1,
                    )));

                }
                createEvents();

            }

        }

        requetes.requeteAjax("POST", "/api/inscription/getAllHorairesByDate.php", data, "json", callbackSuccess, null, null);

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

    updateSelect();

});

function createEvents(){

    $(".clickable").off("click").on("click", function (e) {

        e.preventDefault();
        var tranche = $(this).data("tranche");
        $(".tranche"+tranche).removeClass("active");
        $(this).addClass("active");
        var cours = $(this).data("cours-id");
        $("#list-cours-"+tranche).text($(this).data("cours-name"));

        switch (tranche) {
            case 1:
                cours1 = cours;
                break;
            case 2:
                cours2 = cours;
                break;
            case 3:
                cours3 = cours;
                break;
            case 4:
                cours4 = cours;
                break;
            default:
                toastr["warning"]("Tranche invalide ! ("+tranche+")", "Attention !");
                break;
        }

        //console.log(tranche, cours1, cours2, cours3, cours4);


    });


}

$("#prev_button").on("click", function () {

    if(currJour <= 0){
        toastr["success"]("Retour au pré-requis.", "D'accord !");
        $("#next_button").addClass("disabled");
        setTimeout(function(){ window.location = "/index.php" }, 2000);
    }else{

        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");
            }else{
                toastr["success"](result.message, "Succès");
                setTimeout(function(){ location.reload() }, 500);
            }
        }


        requetes.requeteAjax("GET", "/api/inscription/getBackOneDay.php", {}, "json", callbackSuccess, null, null);

    }

});


$("#next_button").on("click", function () {

    function SaveAndGoToNextDay(last) {
        $("#next_button").addClass("disabled");

        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");
            }else{
                toastr["success"](result.message, "Succès");
                if(!last){
                    setTimeout(function(){ location.reload() }, 2000);
                }else{
                    setTimeout(function(){ window.location = "/enregistrement.php" }, 2000);
                }
            }
        }

        function callbackError(result){
            toastr["error"]("Oops !", "Erreur !"); // toast..
            $("#next_button").removeClass("disabled");
        }

        let data = {
            cours1: cours1,
            cours2: cours2,
            cours3: cours3,
            cours4: cours4,
            date: dateChoisie,
        };

        requetes.requeteAjax("POST", "/api/inscription/saveUserDataInSession.php", data, "json", callbackSuccess, callbackError, null);

    }

    if(currJour >= nbJours){
        $("#prev_button").addClass("disabled");
        SaveAndGoToNextDay(true);
        toastr["success"]("Terminé, passons à l'enregistrement.", "D'accord !");
    }else{

        if(nbJours > 1){
            if(cours1 === 0 || cours2 === 0){
                toastr["warning"]("Veuillez choisir un cours pour la première et deuxième tranche horaire.", "Attention...");
            }else{
                SaveAndGoToNextDay(false);
            }
        }else{
            if(cours1 === 0 || cours2 === 0 || cours3 === 0){
                toastr["warning"]("Veuillez choisir un cours pour la première, deuxième et troisième tranche horaire.", "Attention...");
            }else{
                if(cours3 === 0 && cours4 !== 0){
                    toastr["warning"]("Vous ne pouvez pas selectionner de 4ème cours si vous ne prenez pas de 3ème cours.", "Attention...");
                }else{
                    SaveAndGoToNextDay(false);
                }
            }
        }

    }

});

