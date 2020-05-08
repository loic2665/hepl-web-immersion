<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

@session_start();

$posts = array("nom", "prenom", "interet", "etablissement", "jours");
$data = array();



$message = "Attention, les champs ";
$error = false;
$input_error = array();
foreach($posts as $post){
    if(!isset($_POST[$post]) || empty($_POST[$post])){
        $message .= $post.", ";
        array_push($input_error, $post);
        $error = true;
    }else{
        $data[$post] = addslashes(htmlspecialchars($_POST[$post]));
    }
}
$message .= " ne sont pas défini.";

if($error){

    $toReturn = array(
        "error" => true,
        "message" => $message,
        "input_error" => $input_error,
    );

}else{

    $toReturn = array(
        "error" => false,
        "message" => "Bienvenue ".$data["prenom"]." ! Le programme peut commencer.",
    );

    $_SESSION["jours"] = $data["jours"];
    $_SESSION["currJour"] = 0;
    $_SESSION["data_jours"] = array();

    for($i = 0; $i < $_SESSION["jours"]; $i++){

        $_SESSION["data_jours"][$i] = array();
        $_SESSION["data_jours"][$i]["date"] = "";
        $_SESSION["data_jours"][$i]["cours"] = array();

    }

}
echo(json_encode($toReturn));