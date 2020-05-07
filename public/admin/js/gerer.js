/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

//import {ajouter, modifier} as enseignants from "./enseignants.js" Permet d'import juste une partie de la librairie

import * as remplir from "./fonctions_remplir.js"
import * as eleves from "./eleves.js"
import * as enseignants from "./enseignants.js"

/*  */
function initFormEnseignant(){

}

/* Évenement qui attends que la page soit entièrement chargée */
$(document).ready(function () {

    $('#ajout_modif').css("display", "none");

    /* Évenement au click sur le bouton ajouter */
    $(".add-row").on("click", function () {
        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");
    });

    /* Évenement au click sur le bouton annuler */
    $("#cancel_btn").on("click", function () {
        $('#table_list').css("display", "block");
        $('#ajout_modif').css("display", "none");
    });

    /* Évenement au click sur le bouton modifier pour enseignants */
    $(".modif-enseignants").on("click", function () {
        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");

        enseignants.remplirForm($(this).data("course-id"));
    });

    /* Évenement au click sur le bouton modifier pour eleves */
    $(".modif-eleves").on("click", function () {
        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");

        eleves.remplirForm($(this).data("course-id"));
    });

    /* Évenement au click sur le bouton modifier pour cours */
    $(".modif-cours").on("click", function () {
        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");


    });

    /* Évenement au click sur le bouton modifier pour horaires */
    $(".modif-horaires").on("click", function () {
        $('#table_list').css("display", "none");
        $('#ajout_modif').css("display", "block");


    });

});