//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : 24/04/2020          -->
//-- ---------------------------------------------------- -->


$(document).ready(function () {


    // init fan and functions
    console.log("pret");

    // preparation

    $("#"+screens[0]).css("visibility", "visible");
    $("#list-step-"+screens[0]).css("font-weight", "bold");

    // start routine


    $(".prev-button").on("click", verifPrev);
    $(".suiv-button").on("click", verifNext);

});

