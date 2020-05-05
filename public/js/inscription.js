//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

var blocChoisi = 1;
var canUseDate = false;

$(".bloc").on("click", function () {

    // quand je clique sur n'importe quel élément qui a la classe .bloc alors...

    $(".bloc").removeClass("active");
    // je retire à tout les tag qui ont la classe 'bloc' la classe active (pour le visuel) => tout est blanc
    $(this).addClass("active");
    // je touche à celui que j'ai cliqué (mal gres le même nom de classe, le this permet de prendre l'element courant
    // je lui ajoute la classe 'active' et donc visuellement il devient bleu
    blocChoisi = $(this).data("bloc");
    // je récupère le data du bloc
    /*
    * Explication time !
    *
    * Pas de stress, j'utilise la méthode .data() qui me permet de récuperer des valeur personnalisée dans l'attribut du bloc
    * c'est utilie quand on veut récupérer un chiffre sans vouloir forcément l'afficher.
    *
    * l'attribut dans l'html s'appelle 'data-bloc', jQuery vas se charger de diviser cet attribut data-bloc en deux
    * grace au '-' et donc il va pouvoir récupérer la valeur avec l'attribut 'bloc'
    *
    * tout ça évidemment toujours avec l'opérateur this qui touche seulement à l'objet actuel.
    *
    * */

    $.ajax({
        type: "POST",                                    // type de requete
        url: "/api/inscription/getAllHorairesByBloc.php",// url de la requete
        data: {                                          // data de la requetes, les paramètres
            bloc: blocChoisi,
        },
        dataType: "json",                                 // le type de data attendu par jquery
        success: function (result, data, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
            if(xhrStatus.status === 200){
                if(result.error === true){
                    toastr["warning"](result.message, "Erreur");              // on affiche le toast
                    canUseDate = false;
                    }else{
                    toastr["success"](result.message, "Succès");              // on affiche le toast

                    $('#dateJour').find('option:not(:first)').remove();
                    // dans le selecteur de dateJour, je veux trouver tout les tag options (sauf le premier), je veux ensuite les enelever,
                    result.data.forEach(date => $('#dateJour').append($('<option>').val(date.value).text(date.text)));
                    canUseDate = true;

                }
            }
        },
        error: function (result) {
            toastr["error"]("Oops !", "Erreur !"); // toast..
            canUseDate = false;
        },
        complete: function(result){ // on execute le quoi que ce soit une erreur ou non

        },
    });

});

$("#dateJour").on("change", function () {

    let dateChoisie = $(this).val();
    // récupère la valeur du select

    function updateSelect(tranche){
        // on va faire 4 req. ajax, chaque vont peupler les select correpondant
        $.ajax({
            type: "POST",                                           // type de requete
            url: "/api/inscription/getAllHorairesByDate.php",       // url de la requete
            data: {                                                 // data de la requetes, les paramètres
                bloc: blocChoisi,
                date: dateChoisie,
                tranche: tranche,
            },
            dataType: "json",                                 // le type de data attendu par jquery
            success: function (result, data, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
                if(xhrStatus.status === 200){
                    if(result.error === true){
                        toastr["warning"](result.message, "Erreur");              // on affiche le toast
                    }else{
                        toastr["success"](result.message, "Succès");              // on affiche le toast

                        $('#cours'+tranche).find('option:not(:first)').remove();
                        // dans le selecteur de dateJour, je veux trouver tout les tag options (sauf le premier), je veux ensuite les enelever,
                        result.data.forEach(horaire => $('#cours'+tranche).append($('<option>').val(horaire.value).text(horaire.text)));

                    }
                }
            },
            error: function (result) {
                toastr["error"]("Oops !", "Erreur !"); // toast..
            },
            complete: function(result){ // on execute le quoi que ce soit une erreur ou non

            },
        });
    }

    /*
    * Pourquoi ne pas avoir executé le code plusieur fois dans la boucle ?
    *
    * Simplement car je l'ai testé. Le problème était le parralelisme, quand j'avais fait mes 4
    * requetes, ma variable iHoraire était = à 5, lors du callback, je prenais cette valeur là
    * mais la valeur était à 5 et donc le selecteur était invalide.
    *
    * Solution, créer la fonction, avec comme paramètre le numéro de la tranche horaire
    * pour ne pas que cette valeur ne change , et si elle change, apres l'appel à la fct
    * alors ça ne causera pas de soucis.
    * */

    let iHoraire = 1;
    while(iHoraire <= 4){
        updateSelect(iHoraire);
        iHoraire++;
    }

});
