/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

export function requeteAjax(type, url, data, dataType, callbackSuccess, callbackError, callbackComplete){

    $("#loader-spinner").show();

    $.ajax({
        type: type,                                       // type de requete
        url: url,                                         // url de la requete
        data: data,                                       // data de la requetes, les paramètres
        dataType: dataType,                               // le type de data attendu par jquery
        success: function (result){      // si il correspond pas ou code http != 200 => callback dans error
             if(callbackSuccess !== null){
                 callbackSuccess(result);
             }
        },
        error: function (result){
            if(callbackError !== null){
                callbackError(result);
            } else {
                toastr["error"]("Oops !", "Erreur !");
            }
        },
        complete: function(result){ // on execute le quoi que ce soit une erreur ou non
            if(callbackComplete !== null){
                callbackComplete(result);
            }

            $("#loader-spinner").hide();
        },
    });
}