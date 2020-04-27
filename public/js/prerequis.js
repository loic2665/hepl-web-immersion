//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : 24/04/2020          -->
//-- ---------------------------------------------------- -->


$(document).ready(function () {


    // init fan and functions

    var screens = [
        "step-welcome",
        "step-nb-days",
    ];

    var inscrption = {};
    inscrption.currentStep = 0;

    function changeScreen(num){

        if(num < 0 && inscrption.currentStep - num - 1 <= 0){
            console.log("alors, je veux bien changer de pages, mais... là je vais sortir du tableau et tout vas planter (neg)");
            return;
        }else if(num > 0 && inscrption.currentStep + num >= screens.length){
            console.log("alors, je veux bien changer de pages, mais... là je vais sortir du tableau et tout vas planter (pos)");
            return;
        }else if(num === 0){
            console.log("alors, je veux bien changer de pages, mais... faut me donner un nombre non nul...");

        }

        $("#"+screens[inscrption.currentStep]).css("visibility", "hidden");
        $("#list-step-"+screens[inscrption.currentStep]).css("font-weight", "normal");
        inscrption.currentStep += num;
        $("#"+screens[inscrption.currentStep]).css("visibility", "visible");
        $("#list-step-"+screens[inscrption.currentStep]).css("font-weight", "bold");


        console.log(inscrption.currentStep);
    }

    function verifPrev(){
            changeScreen(-1);
    }
    function verifNext(){
        changeScreen(1);
        if(inscrption.currentStep === screens.length - 1){
            $("#nb-days").change(function () {
                let value = $(this).val();
                console.log(value);
                window.location = "./inscription.php?nbDay="+value;
            });

        }
    }


    // preparation

    $("#"+screens[0]).css("visibility", "visible");
    $("#list-step-"+screens[0]).css("font-weight", "bold");

    // start routine


    $(".prev-button").on("click", verifPrev);
    $(".suiv-button").on("click", verifNext);

    $("#nb-days").change(function () {
        inscrption.nbWantedDays = 0;
    });

});

