/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 13/05/2020             */
/***********************************************************/

import * as requeteAjax from "/js/requeteAjax.js"

$(document).ready(function () {

    $("#id_eleves").on("change", function () {
        console.log("test");
        let id = $("#id_eleves option:selected").val();
        console.log(id);

        let tableau = {
            action: "affiche",
            id:id,
        };

        function successCallback(result){
            if(result.error === false){
                toastr["success"](result.message, "Succès");
                console.log(result.data);
                $("#nomEleve").text(result.data[0].nom+" "+result.data[0].prenom);

                addRow();

            } else {
                toastr["warning"](result.message, "Attention");
            }
        }

        requeteAjax.requeteAjax("POST", "/admin/api/gerer_eleves_horaires.php", tableau, "json", successCallback, null, null);


        $("#nomEleve").text($("#id_eleves option:selected").val());
    });

    function addRow(){
        let tableau = $("#table");

        let ligne = tableau.insertAfter   insertRow(-1); // on ajoute une ligne

        let colonne1 = ligne.insertCell(0);
        colonne1.innerHTML += "azerty";

        let colonne2 = ligne.insertCell(1);
        colonne2.innerHTML += "le deux";
    }

});