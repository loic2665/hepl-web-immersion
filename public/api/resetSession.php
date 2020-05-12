<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

@session_start();


$_SESSION["data_jours"] = array();

for($i = 0; $i < $_SESSION["jours"]; $i++){

    $_SESSION["data_jours"][$i] = array();
    $_SESSION["data_jours"][$i]["date"] = "";
    $_SESSION["data_jours"][$i]["cours"] = array();
    for($j = 0; $j <= 3; $j++){
        $_SESSION["data_jours"][$i]["cours"][$j] = 0;
    }

}

$toReturn = array(
    "error" => false,
    "message" => "Session réinitiliasée.",
);

echo(json_encode($toReturn));