/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 13/05/2020             */
/***********************************************************/

import * as requeteAjax from "/js/requeteAjax.js"

$(document).ready(function () {

    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).data('value')
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(this.Counter.toFixed(0));
            }
        });
    });

    /* Évenement au click sur le bouton supprimer */
    $(".arch").on("click", function () {


        let tableau = {
            action: "archive",
        };

        function successCallback(result){
            if(result.error === false){
                toastr["success"](result.message, "Succès");
                location.reload();
            } else {
                toastr["warning"](result.message, "Attention");
            }
        }

        requeteAjax.requeteAjax("POST", "/admin/api/gerer_eleves_horaires.php", tableau, "json", successCallback, null, null);

    });


    $(".date_debut").on("click", function () {

        let data = {
            what: "date_debut",
            date: $("#date_debut").val(),
            switch: "",
        }
        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");              // on affiche le toast
            }else{
                toastr["success"](result.message, "Succès");              // on affiche le toast
            }
        }

        requeteAjax.requeteAjax("POST", "./api/config/updateConfig.php", data, "json", callbackSuccess, null, null);

    });
    $(".date_fin").on("click", function () {

        let data = {
            what: "date_fin",
            date: $("#date_fin").val(),
            switch: "",
        }
        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");              // on affiche le toast
            }else{
                toastr["success"](result.message, "Succès");              // on affiche le toast
            }
        }

        requeteAjax.requeteAjax("POST", "./api/config/updateConfig.php", data, "json", callbackSuccess, null, null);

    });

    // switchs



    $("#switch_close").on("click", function () {

        let value = "";

        if($("#switch_close:checked").val() === undefined){
            value = "";
        }else{
            value = $("#switch_close:checked").val();
        }

        let data = {
            what: "force_close",
            date: "",
            switch: value,

        }

        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");              // on affiche le toast
            }else{
                toastr["success"](result.message, "Succès");              // on affiche le toast
            }
        }

        requeteAjax.requeteAjax("POST", "./api/config/updateConfig.php", data, "json", callbackSuccess, null, null);

    });

    $("#switch_active").on("click", function () {

        let value = "";

        if($("#switch_active:checked").val() === undefined){
            value = "";
        }else{
            value = $("#switch_active:checked").val();
        }

        let data = {
            what: "force_active",
            date: "",
            switch: value,

        }

        function callbackSuccess(result){
            if(result.error === true){
                toastr["warning"](result.message, "Erreur");              // on affiche le toast
            }else{
                toastr["success"](result.message, "Succès");              // on affiche le toast
            }
        }

        requeteAjax.requeteAjax("POST", "./api/config/updateConfig.php", data, "json", callbackSuccess, null, null);

    });

});
