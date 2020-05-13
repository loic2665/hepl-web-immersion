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

});