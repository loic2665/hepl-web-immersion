<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

/*
 * N'est jamais cencé planter, permet de garder les cookies de session en vie > 20 mins
 */
require_once(__DIR__."/../php/require_all.php");
@session_start();

$error = false;

if($error){

    $toReturn = array(
        "error" => $error,
        "message" => "Le site rencontre des problèmes, il se peut qu'il ne fonctionne pas comme prévu.",
        "data" => array(
            "registrationOpen" => Config::areRegistrationOpen(), // Config::areRegistrationOpen();
        )
    );

}else{
    $toReturn = array(
        "error" => $error,
        "data" => array(
            "registrationOpen" => Config::areRegistrationOpen(), // Config::areRegistrationOpen();
        )
    );

}


echo(json_encode($toReturn));
