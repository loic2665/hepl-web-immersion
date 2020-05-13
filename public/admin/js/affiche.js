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
        let id = $("#id_eleves option:selected").val();

        let tableau = {
            action: "affiche",
            id:id,
        };

        function successCallback(result){
            if(result.error === false){
                toastr["success"](result.message, "Succès");
                if(result.data.length > 0){
                    $("#nomEleve").text(result.data[0].nom+" "+result.data[0].prenom);
                    $("#tables").empty();
                    createTab(result.data);
                }

            } else {
                toastr["warning"](result.message, "Attention");
            }
        }

        requeteAjax.requeteAjax("POST", "/admin/api/gerer_eleves_horaires.php", tableau, "json", successCallback, null, null);

    });

    function createTab(data){

        let div = document.querySelector("#tables");
        let table;
        let jour;
        let jourtemplate;
        let date = '0';

        data.forEach((line) =>
        {
            if(date.localeCompare(line.date) != 0) {

                if(date.localeCompare("0") != 0)
                {
                    div.appendChild(jour);
                }
                date = line.date;
                jourtemplate = document.querySelector("#templateTable");
                jour = document.importNode(jourtemplate.content, true);

                jour.querySelector(".date").innerHTML = line.date;
                table = jour.querySelector(".tbody");
            }

            let tr = document.createElement("tr");

            let td = document.createElement('td');
            td.innerHTML = line.tranche_horaire;
            tr.appendChild(td);

            td = document.createElement('td');
            td.innerHTML = line.heure_debut+" - "+line.heure_fin;
            tr.appendChild(td);

            td = document.createElement('td');
            td.innerHTML = line.intitule;
            tr.appendChild(td);

            td = document.createElement('td');
            td.innerHTML = line.local;
            tr.appendChild(td);

            table.appendChild(tr);
        })

        div.appendChild(jour);
    }
});