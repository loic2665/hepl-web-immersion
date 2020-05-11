/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 11/05/2020             */
/***********************************************************/

import * as requeteAjax from "/js/requeteAjax.js"

/* Fonction pour récupérer le GET */
function $_GET(param){
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function( m, key, value ) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );

    if ( param ) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}

export function ajouter(tableau){
    tableau.action = "add";

    let table = $_GET('gerer');

    console.log(table);

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gerer_"+table+".php", tableau, "json", successCallback, null, null);
}

export function modifier(tableau){
    tableau.action = "modif";

    let table = $_GET('gerer');

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gerer_"+table+".php", tableau, "json", successCallback, null, null);
}

export function supprimer(id){
    let tableau = {
        action: "delete",
        id:id,
    };

    let table = $_GET('gerer');

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gerer_"+table+".php", tableau, "json", successCallback, null, null);
}

export function visible(id){
    let tableau = {
        action: "visible",
        id:id,
    };

    let table = $_GET('gerer');

    function successCallback(result){
        if(result.error === false){
            toastr["success"](result.message, "Succès");
        } else {
            toastr["warning"](result.message, "Attention");
        }
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gerer_"+table+".php", tableau, "json", successCallback, null, null);

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
    for( let input of inputs){                                // boucle pour vider les champs email
        input.value = "";
    }

    inputs = $('input[type=number]');                       // on récupere les differents types d'input number du formulaire
    for( let input of inputs){                                // boucle pour vider les champs number
        input.value = "";
    }

    inputs = $('input[type=date]');                          // on récupere les differents types d'input date du formulaire
    for( let input of inputs){                                // boucle pour vider les champs date
        input.value = "";
    }

    inputs = $('input[type=radio]');                          // on récupere les differents types d'input radio du formulaire
    for( let input of inputs){                                // boucle pour les déssélectionner
        input.checked = false;
    }

    inputs = $('select');                                     // on récupere les differents types select du formulaire
    for( let input of inputs){                                // boucle pour mettre la valeur par defaut
        $(input).val($("#"+ input.id +" option:first").val());
    }
}

/* Fonction qui permet de récupérer les données de */
/* l'eleve et de remplir le formulaire avec  */
export function remplirForm(id){
    let tableau = {
        action: "get",
        id:id,
    };

    let table = $_GET('gerer');

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

            inputs = $('input[type=number]');                       // on récupere les differents types d'input number du formulaire
            for( let input of inputs){                                // boucle pour remplir les champs number
                input.value = result.data[input.name];
            }

            inputs = $('input[type=date]');                          // on récupere les differents types d'input date du formulaire
            for( let input of inputs){                                // boucle pour remplir les champs date
                input.value = result.data[input.name];
            }

            inputs = $('input[type=radio]');                          // on récupere les differents types d'input radio du formulaire
            for( let input of inputs){                                // boucle pour check le bon bouton radio
                if(input.value === result.data[input.name])
                    input.checked = true;
            }

            inputs = $('select');                                     // on récupere les differents types select du formulaire
            for( let input of inputs){                                // boucle pour check le bon choix
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

    requeteAjax.requeteAjax("POST", "/admin/api/gerer_"+table+".php", tableau, "json", successCallback, null, null);

}

