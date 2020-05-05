<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

/*
 * Le but de cet api est de récupérer les dates ou il y a des horaire par le bloc,
 * on apelle ça quand on clique sur le bloc.
 *
 * Le but de ces fichiers est de convertir les données de la bas de données en JSON
 * on va l'utiliser PARTOUT, ça va être notre bel ami.
 *
 *
 *
 * */

require_once(__DIR__."/../../php/require_all.php");


// je défini un tableau par defaut, j'assume qu'il y a pas d'erreur au debut
$toReturn = array(
    "error" => false,
    "message" => '',
);


if(!isset($_POST["bloc"]) || empty($_POST["bloc"])){

    /*
     * Je vérifie si le $_POST bloc qu'on attends est présent et pas vide,
     *
     * pourquoi j'utilise pas ma boucle comme dans /api/welcome.php ?
     *
     * simplement parce que faire un couteau suisse pour une entrée c'est chiant...
     * mais le principe est le même, on prévient que la valeur attendue
     * n'as pas été définie ou est vide...
     *
     * */

    $toReturn["error"] = true;
    $toReturn["message"] = "Le champ 'bloc' n'est pas défini ou est vide.";
}else{

    $bloc = addslashes(htmlspecialchars($_POST["bloc"]));

    $dates = Horaire::getLessonsDateByBloc($bloc);

    // j'apelle la fonction que tu as fais

    $dataToReturn = array();
    //  je crée un tableau avec les données que je vais renvoyer dont j'ai besoin, je n'ai pas besoin d'autre chose.

    foreach ($dates as $date){
        array_push($dataToReturn, array("value" => $date["date_cours"], "text" =>  $date["date_cours"]));
        // on ajoute justement l'élément courant dans le tableau
    }

    $toReturn["data"] = $dataToReturn;
    // on defini le data pour savoir quoi retourner en + du json
    $toReturn["message"] = "Cours du bloc ".$bloc." chargé avec succès";
    // un petit message de succès fait toujours plaisir

}
// et on envoie. :)
echo(json_encode($toReturn));
?>

