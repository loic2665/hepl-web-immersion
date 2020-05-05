<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

require_once(__DIR__ . "/../../php/require_all.php");


$posts = array("date", "tranche");
$data = array();

/*
 * Ici mon couteau suisse est utile,
 * car il y a + que 1 champ, et puis le message d'erreur se construit tout seul.
 *
 */

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



/*
 * si on a des champs qui sont pas ok, alors on tombe dans le if (erreur)
 * et on va pas plus loin, le message étant construit tout seul
 * il pourra s'afficher à l'aide de toastr comme d'hab
 *
 * */


if ($error) {

    $toReturn = array(
        "error" => true,
        "message" => $message,
    );

} else {

    $date_user = addslashes(htmlspecialchars($_POST["date"]));
    $tranche_user = addslashes(htmlspecialchars($_POST["tranche"]));

    $dates = Horaire::getLessonsByDateAndTrancheHoraire($date_user, $tranche_user);

    $dataToReturn = array();

    foreach ($dates as $date) {
        array_push($dataToReturn, array(
            "cours_id" => $date["id"],
            "intitule" => $date["intitule"],
            "bloc" => $date["bloc"],
            "type" => $date["type"],
            "gestion" => $date["gestion"],
            "indus" => $date["indus"],
            "reseau" => $date["reseau"],
            "heure_debut" => $date["heure_debut"],
            "heure_fin" => $date["heure_fin"],
        ));
    }

    /*
     * un peu le même trip que pour les dates, sauf que j'utilise des colonnes différentes. rien de spécial en faite.
     *
     * */

    $toReturn["error"] = false;
    $toReturn["data"] = $dataToReturn;
    $toReturn["message"] = "Les cours du ".$date_user." de la tranche horaire ".$tranche_user." ont bien été chargé.";

}

echo(json_encode($toReturn));


