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

@session_start();

$error = false;
$registration = file_get_contents(__DIR__."/../../config/settings.conf");

if($error){

    $toReturn = array(
        "error" => $error,
        "message" => "Le site rencontre des problèmes, il se peut qu'il ne fonctionne pas comme prévu.",
        "data" => array(
            "registrationOpen" => true, // Config::areRegistrationOpen();
        )
    );

}else{
    $toReturn = array(
        "error" => $error,
        "data" => array(
            "registrationOpen" => true, // Config::areRegistrationOpen();
        )
    );

}


echo(json_encode($toReturn));
