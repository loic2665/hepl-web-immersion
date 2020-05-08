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
        toastr["success"](result.message, "Succès");
    }

    requeteAjax.requeteAjax("POST", "/admin/api/gererEnseignant.php", tableau, "json", successCallback, null, null);

/*    $.ajax({
        type: "POST",                                    // type de requete
        url: "/admin/api/gererEnseignant.php",           // url de la requete
        data: {                                          // data de la requetes, les paramètres
            action: "add",
            nom: tableau.nom,
            prenom: tableau.prenom,
            sexe: tableau.sexe,
        },
        dataType: "json",                                 // le type de data attendu par jquery
        success: function (result, data, xhrStatus){      // si il correspond pas ou code http != 200 => callback dans error
            toastr["success"](result.message, "Succès");

        },
        error: function (result){
            toastr["error"]("Oops !", "Erreur !"); // toast..
        },
        complete: function(result){ // on execute le quoi que ce soit une erreur ou non

        },
    });*/
}

export function modifier(tableau){
    console.log("modifier");
    console.log(tableau.id);
    console.log(tableau.nom);
    console.log(tableau.prenom);
    console.log(tableau.sexe);
}

export function supprimer(){
    console.log("supprimer");
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
    inputs = $('input[type=radio]');                          // on récupere les differents types d'input radio du formulaire
    for( let input of inputs){                                // boucle pour check le bon bouton radio
        input.checked = false;
    }
}

/* Fonction qui permet de récupérer les données de */
/* l'enseignants et de remplir le formulaire avec  */
export function remplirForm(id){
    $.ajax({
        type: "POST",                                    // type de requete
        url: "/admin/api/gererEnseignant.php",           // url de la requete
        data: {                                          // data de la requetes, les paramètres
            action: "get",
            id: id,
        },
        dataType: "json",                                 // le type de data attendu par jquery
        success: function (result, data, xhrStatus){      // si il correspond pas ou code http != 200 => callback dans error
            if(xhrStatus.status === 200){
                if(result.error === true){
                    toastr["warning"](result.message, "Erreur");              // on affiche le toast
                }else{                                                        // merci bootsrap
                    toastr["success"](result.message, "Succès");              // on affiche le toast

                    let inputs = $('input[type=text]');                       // on récupere les differents types d'input text du formulaire
                    for( let input of inputs){                                // boucle pour remplir les champs texte
                        input.value = result.data[input.name];
                    }
                    inputs = $('input[type=radio]');                          // on récupere les differents types d'input radio du formulaire
                    for( let input of inputs){                                // boucle pour check le bon bouton radio
                        if(input.value === result.data[input.name])
                            input.checked = true;
                    }
                }
            }
        },
        error: function (result){
            toastr["error"]("Oops !", "Erreur !"); // toast..
        },
        complete: function(result){ // on execute le quoi que ce soit une erreur ou non

        },
    });
}