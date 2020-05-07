/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

export function ajouter()
{
    console.log("ajouter");
}

export function modifier()
{
    console.log("modifier");
}

export function supprimer()
{
    console.log("supprimer");
}

/* Fonction qui permet de récupérer les données de */
/* l'eleve et de remplir le formulaire avec  */
export function remplirForm(id){
    $.ajax({
        type: "POST",                                    // type de requete
        url: "/admin/api/gererEleve.php",                // url de la requete
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