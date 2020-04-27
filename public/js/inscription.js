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

    var screens = [
        "step-welcome",
        "stp-nb-days", // decaler l'index
        "step-day-horaire-1",
        "step-day-horaire-2",
        "step-day-horaire-3",
        "step-day-horaire-4",
        "step-summary",
        "step-register",
    ];

    var inscription = new Object(); // ou step = {} mais c'est moche et pas lisible...

    inscription.currentStep = 0;

    // preparation

    $("#"+screens[0]).css("visibility", "visible");
    $("#list-step-"+screens[0]).css("font-weight", "bold");

    // start routine


    $(".prev-button").on("click", verifPrev);
    $(".suiv-button").on("click", verifNext);

});

