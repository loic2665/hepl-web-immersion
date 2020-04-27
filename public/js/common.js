//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

var inscription = {};
inscription.currentStep = 0;

function changeScreen(num){

    if(num < 0 && inscription.currentStep - num - 1 <= 0){
        console.log("alors, je veux bien changer de pages, mais... là je vais sortir du tableau et tout vas planter (neg)");
        return;
    }else if(num > 0 && inscription.currentStep + num >= screens.length){
        console.log("alors, je veux bien changer de pages, mais... là je vais sortir du tableau et tout vas planter (pos)");
        return;
    }else if(num === 0){
        console.log("alors, je veux bien changer de pages, mais... faut me donner un nombre non nul...");

    }

    $("#"+screens[inscription.currentStep]).css("visibility", "hidden");
    $("#list-step-"+screens[inscription.currentStep]).css("font-weight", "normal");

    inscription.currentStep += num;

    $("#"+screens[inscription.currentStep]).css("visibility", "visible");
    $("#list-step-"+screens[inscription.currentStep]).css("font-weight", "bold");


    console.log(inscription.currentStep);
}

function verifPrev(){
    changeScreen(-1);
}
function verifNext(){
    changeScreen(1);
    if(inscription.currentStep === screens.length - 1){
        $("#nb-days").change(function () {
            let value = $(this).val();
            console.log(value);
            window.location = "./inscription.php?nbDay="+value;
        });

    }
}