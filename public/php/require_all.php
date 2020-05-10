<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/

@session_start();

/*
 * je démarre la session dans toutes les pages, c'est plus simple que devoir s'en soucier...
 *
 * */

require_once(__DIR__."/class/Database.php");
require_once(__DIR__ . "/class/Eleve.php");
require_once(__DIR__ . "/class/Horaire.php");
require_once(__DIR__ . "/class/Cours.php");
require_once(__DIR__ . "/class/Type_cours.php");
require_once(__DIR__ . "/class/Tranches_horaires.php");
require_once(__DIR__ . "/class/Local.php");
require_once(__DIR__ . "/class/Enseignant.php");
require_once(__DIR__ . "/class/Config.php");
require_once(__DIR__ . "/fonctions.php");
