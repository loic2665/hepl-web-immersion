//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

import * as requete from '/js/requeteAjax.js'

$("#reset-button").on("click", function () {

    function callbackSuccess(result){

        if(result.error === true){
            toastr["warning"](result.message, "Erreur");
        }else{
            toastr["success"](result.message, "Succès");
            setTimeout(function(){ window.location = "/"; }, 2000);
        }

    }

    requete.requeteAjax("GET", "/api/resetSession.php", null, "json", callbackSuccess, null, null);



});

$("#confirm-button").on("click", function () {

    function callbackSuccess(result){

        if(result.error === true){
            toastr["warning"](result.message, "Erreur");
        }else{
            toastr["success"](result.message, "Succès");
            setTimeout(function(){ window.location = "/finalisation.php"; }, 2000);
        }
    }

    requete.requeteAjax("GET", "/api/finalisationInscription.php", null, "json", callbackSuccess, null, null);



});