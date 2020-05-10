<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->


@session_start();
if($_SESSION["currJour"] <= 0){
    $toReturn = array(
        "error" => true,
        "message" => "Oops, on est déja au premier jour...",
    );

}else{
    $_SESSION["currJour"] -= 1;
    $toReturn = array(
        "error" => false,
        "message" => "Et on retourne au jour ".($_SESSION["currJour"]+1)." !",
    );
}



echo(json_encode($toReturn));