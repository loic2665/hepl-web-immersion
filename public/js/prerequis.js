//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

import * as requetes from '/js/requeteAjax.js'

$("#nom, #prenom, #interet, #etablissement, #jours").on("focus", function () {
    $(this).removeClass("is-invalid");
});

$("#send_btn").on("click", function () {


    function callbackSuccess(result){
        if(result.error === true){
            toastr["warning"](result.message, "Erreur");              // on affiche le toast
            result.input_error.forEach(element => $("#"+element).addClass("is-invalid"));  // pour chaque element des input en erreur j'ajoute la classe d'invalidité du champs
        }else{                                                                             // merci bootsrap
            toastr["success"](result.message, "Succès");              // on affiche le toast
            setTimeout(function(){ window.location = "/inscription.php" }, 2000);
        }
    }

    let data = {                                          // data de la requetes, les paramètres
        nom: $("#nom").val(),
        prenom: $("#prenom").val(),
        interet: $("#interet").val(),
        etablissement: $("#etablissement").val(),
        jours: $("#jours").val(),
    };

    requetes.requeteAjax("POST", "/api/welcome.php", data, "json", callbackSuccess, null, null);

});