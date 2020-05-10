/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 06/05/2020             */
/***********************************************************/

//import {ajouter, modifier} as repartir from "./repartir.js" Permet d'import juste une partie de la librairie

import * as repartir from "./repartir.js"


/* Évenement qui attends que la page soit entièrement chargée */
$(document).ready(function () {


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
            tab = repartir; // tab référencie la librairie enseignants maintenant
            break;

        case 'eleves':
            pluriel = 'élèves';
            singulier = 'élèves';
            tab = repartir;
            break;

        case 'cours':
            pluriel = 'cours';
            singulier = 'cours';
            tab = repartir;
            break;

        case 'horaires' :
            pluriel = 'horaires';
            singulier = 'horaire';
            tab = repartir;
            break;

        case 'locaux' :
            pluriel = 'locaux';
            singulier = 'local';
            tab = repartir;
            break;

        case 'type_cours' :
            pluriel = 'types de cours';
            singulier = 'type de cours';
            tab = repartir;
            break;

        case 'tranches_horaires' :
            pluriel = 'tranches horaires';
            singulier = 'tranche horaire';
            tab = repartir;
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

        $('#table_list').addClass("hidden");
        $('#ajout_modif').removeClass("hidden");
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

        $('#table_list').addClass("hidden");
        $('#ajout_modif').removeClass("hidden");
    });


    /***************************************/
    /*                                     */
    /*          Boutons supprimer          */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton supprimer */
    $(".del").on("click", function () {
        tab.supprimer($(this).data("course-id"));

    });

    /***************************************/
    /*                                     */
    /*           Boutons annuler           */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton annuler */
    $(".annul").on("click", function () {
        tab.initForm();

        $('#ajout_modif').addClass("hidden");
        $('#table_list').removeClass("hidden");
    });


    /***************************************/
    /*                                     */
    /*           Boutons valider           */
    /*                                     */
    /***************************************/

    /* Évenement au click sur le bouton valider */
    $(".valid").on("click", function () {

        let tableau = {};

        console.log(table);

        if(tab.formValid()) {
            switch (table){
                case 'enseignants':
                    tableau.nom = $('#nom').val();
                    tableau.prenom = $('#prenom').val();
                    tableau.sexe = $('input[name=sexe]:checked').val();
                    break;

                case 'eleves':
                    tableau.nom = $('#nom').val();
                    tableau.prenom = $('#prenom').val();
                    tableau.email = $('#email').val();
                    tableau.etablissement = $('#etablissement').val();
                    tableau.indus = $("#indus option:selected").val();
                    tableau.gestion = $("#gestion option:selected").val();
                    tableau.reseau = $("#reseau option:selected").val();
                    break;

                case 'cours':
                    tableau.intitule = $('#intitule').val();
                    tableau.bloc = $('#bloc').val();
                    break;

                case 'horaires' :
                    tableau.id_cours = $("#id_cours option:selected").val();
                    tableau.id_enseignants = $("#id_enseignants option:selected").val();
                    tableau.id_type_cours = $("#id_type_cours option:selected").val();
                    tableau.date_cours = $('#date_cours').val();
                    tableau.id_tranches_horaires = $("#id_tranches_horaires option:selected").val();
                    tableau.id_locaux = $("#id_locaux option:selected").val();
                    tableau.inscription_max = $('#inscription_max').val();
                    tableau.indus = $("#indus option:selected").val();
                    tableau.gestion = $("#gestion option:selected").val();
                    tableau.reseau = $("#reseau option:selected").val();
                    break;

                case 'locaux':
                    tableau.local = $('#local').val();
                    break;

                case 'type_cours':
                    tableau.type = $('#type').val();
                    break;

                case'tranches_horaires':
                    tableau.heure_debut = $('#heure_debut').val();
                    tableau.heure_fin = $('#heure_fin').val();
                    tableau.tranche_horaire = $('#tranche_horaire').val();
            }
            if(action === "ajout"){ // si on ajoute
                tab.ajouter(tableau);
            } else {                // si on modifie
                tableau.id = idModif;
                tab.modifier(tableau)
            }
            tab.initForm();
            $('#ajout_modif').addClass("hidden");
            $('#table_list').removeClass("hidden");
        } else {

        }
    });

});