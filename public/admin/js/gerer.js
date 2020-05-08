/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

//import {ajouter, modifier} as enseignants from "./enseignants.js" Permet d'import juste une partie de la librairie

import * as cours from "./cours.js"
import * as eleves from "./eleves.js"
import * as horaires from "./horaires.js"
import * as enseignants from "./enseignants.js"


/* Évenement qui attends que la page soit entièrement chargée */
$(document).ready(function () {

    /* mets l'article 'ajout_modif en caché */
    $('#ajout_modif').css("display", "none");

    let tab;
    let idModif;
    let table = $('#page').val();
    let action; // pour pouvoir différencier un ajout à une modification dans le bouton valider
    let pluriel = 'erreur';
    let singulier = 'erreur';

    /* permet de mettre le titre selon la page ouverte */
    switch (table){
        case 'enseignants':
            pluriel = 'professeurs';
            singulier = 'professeur';
            tab = enseignants; // tab référencie la librairie enseignants maintenant
            break;

        case 'eleves':
            pluriel = 'élèves';
            singulier = 'élèves';
            tab = eleves;
            break;

        case 'cours':
            pluriel = 'cours';
            singulier = 'cours';
            tab = cours;
            break;

        case 'horaires' :
            pluriel = 'horaires';
            singulier = 'horaire';
            tab = horaires;
            break;

    }
    $('#entete_gestion').text('Gestion des '+pluriel);


    /***************************************/
    /*                                     */
    /*          Boutons modifier           */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton modifier pour eleves */
    $(".modif").on("click", function () {
        action = "modif";
        idModif = $(this).data("course-id");
        tab.remplirForm(idModif);
        $('#entete_ajout_modif').text('Modifier un '+singulier);


        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");
    });


    /***************************************/
    /*                                     */
    /*          Boutons ajouter            */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton ajouter */
    $(".add-row").on("click", function () {
        action = "ajout";
        $('#entete_ajout_modif').text('Ajouter un '+singulier);

        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");
    });


    /***************************************/
    /*                                     */
    /*          Boutons supprimer          */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton supprimer */
    $(".del").on("click", function () {


    });

    /***************************************/
    /*                                     */
    /*           Boutons annuler           */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton annuler */
    $(".annul").on("click", function () {
        tab.initForm();
        $('#table_list').css("display", "block");
        $('#ajout_modif').css("display", "none");
    });


    /***************************************/
    /*                                     */
    /*           Boutons valider           */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton valider */
    $(".valid").on("click", function () {

        let tableau = {};

        if(tab.formValid()) {
            if(action === "ajout"){ // si on ajoute
                switch (table){
                    case 'enseignants':
                        tableau.nom = $('#nom').val();
                        tableau.prenom = $('#prenom').val();
                        tableau.sexe = $('input[name=sexe]:checked').val();
                        break;

                    case 'élèves':

                        break;

                    case 'cours':

                        break;

                    case 'horaires' :

                        break;
                }
                tab.ajouter(tableau);
            } else {                // si on modifie
                switch (table){
                    case 'enseignants':
                        tableau.id = idModif;
                        tableau.nom = $('#nom').val();
                        tableau.prenom = $('#prenom').val();
                        tableau.sexe = $('input[name=sexe]:checked').val();
                        break;

                    case 'eleves':

                        break;

                    case 'cours':

                        break;

                    case 'horaires' :

                        break;

                }
                tab.modifier(tableau)
            }
            tab.initForm();
            $('#table_list').css("display", "block");
            $('#ajout_modif').css("display", "none");
        } else {

        }
    });

});