/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

import * as requeteAjax from "/js/requeteAjax.js"

export function ajouter(tableau){
    tableau.action = "add";

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gererEleve.php", tableau, "json", successCallback, null, null);
}

export function modifier(tableau){
    tableau.action = "modif";

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gererEleve.php", tableau, "json", successCallback, null, null);
}

export function supprimer(id){
    let tableau = {
        action: "delete",
        id:id,
    };

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gererEleve.php", tableau, "json", successCallback, null, null);
}

/* Fonction qui vérifie si le formulaire est bien rempli */
export function formValid(){
    return true;
}

/* Fonction qui vide le formulaire  */
export function initForm(){
    let inputs = $('input[type=text]');                       // on récupere les differents types d'input text du formulaire
    for( let input of inputs){                                // boucle pour remplir les champs texte
        input.value = "";
    }
    inputs = $('input[type=email]');                          // on récupere les differents types d'input email du formulaire
    for( let input of inputs){                                // boucle pour remplir les champs email
        input.value = "";
    }
    inputs = $('select');                                     // on récupere les differents types d'input radio du formulaire
    for( let input of inputs){                                // boucle pour check le bon bouton radio
        $(input).val($("#"+ input.id +" option:first").val());// on défini la val selectionner à la première valeur de ce même premier element
    }
}

/* Fonction qui permet de récupérer les données de */
/* l'eleve et de remplir le formulaire avec  */
export function remplirForm(id){
    let tableau = {
        action: "get",
        id:id,
    };

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");

            let inputs = $('input[type=text]');                       // on récupere les differents types d'input text du formulaire
            for( let input of inputs){                                // boucle pour remplir les champs texte
                input.value = result.data[input.name];
            }
            inputs = $('input[type=email]');                          // on récupere les differents types d'input email du formulaire
            for( let input of inputs){                                // boucle pour remplir les champs email
                input.value = result.data[input.name];
            }
            inputs = $('select');                                     // on récupere les differents types d'input radio du formulaire
            for( let input of inputs){                                // boucle pour check le bon bouton radio
                let options = $(input).find('option');

                for( let option of options){
                    if(option.value === result.data[input.name])
                        option.selected = true;
                }
            }
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gererEleve.php", tableau, "json", successCallback, null, null);

}