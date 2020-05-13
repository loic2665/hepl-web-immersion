<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->



require_once(__DIR__."/../../../php/require_all.php");

$posts = array("what", "date", "switch");

$data = array();
$message = "Attention, les champs ";
$error = false;
$input_error = array();
foreach ($posts as $post) {
    if (!isset($_POST[$post])) {
        $message .= $post . ", ";
        array_push($input_error, $post);
        $error = true;
    } else {
        $data[$post] = addslashes(htmlspecialchars($_POST[$post]));
    }
}
$message .= " ne sont pas défini.";

if($data["what"] == "date_debut"){

    Config::setDateDebut($data["date"]);
    $toReturn = array(
        "error" => false,
        "message" => "Nouvelle date de debut : ".$data["date"].".",
    );


}else if($data["what"] == "date_fin"){

    Config::setDateFin($data["date"]);

    $toReturn = array(
        "error" => false,
        "message" => "Nouvelle date de fin : ".$data["date"].".",
    );

}else if($data["what"] == "force_active"){

    Config::setForceActive($data["switch"]);

    $toReturn = array(
        "error" => false,
        "message" => "Enregistré !",
    );


}else if($data["what"] == "force_close"){

    Config::setForceClose($data["switch"]);

    $toReturn = array(
        "error" => false,
        "message" => "Enregistré !",
    );


}


echo(json_encode($toReturn));