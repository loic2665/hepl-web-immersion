<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

@session_start();

require_once(__DIR__."/../php/require_all.php");

$error = false;
$joursChoisis = array();
$listErrors = array();

foreach ($_SESSION["data_jours"] as $jour) {

    if (in_array($jour["date"], $joursChoisis)) {
        $error = true;
        array_push($listErrors, "Le jour " . $jour["date"] . " est spécifié à deux jours différent.");
    } else {
        array_push($joursChoisis, $jour["date"]);
        for ($i = 1; $i <= 4; $i++) {

            if ($jour["cours"][$i - 1] != 0 && !Horaire::checkHoraireAndId($jour["cours"][$i - 1], $jour["date"], $i)) {
                $error = true;
                array_push($listErrors, "Incohérence entre " . $jour["date"] . " - Cours : " . $jour["cours"][$i - 1] . " et tranche : " . $i);
            }

        }
    }

}

$message = "";

if($error){
    foreach ($listErrors as $erreur){
        $message .= $erreur."<br />";
    }

    $toReturn = array(
        "error" => true,
        "message" => "Désolé, votre inscription n'a pas pu être validée. Veuillez corriger les erreurs : <br/>".$message,
    );
}else{



    /*
     *
     * SAVING SECTION !!!!
     *
     */


    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $etab = $_SESSION["etablissement"];
    $email = $_SESSION["email"];

    $interet = $_SESSION["interet"];

    $indus = 0;
    $gestion = 0;
    $reseau = 0;

    if($interet == "indus"){
        $indus = 1;
    }else if($interet == "gestion"){
        $gestion = 1;
    }else if($interet == "reseau"){
        $reseau = 1;
    }

    $db = new Database();
    $db->conn->query("LOCK TABLE eleves;");
    $result = $db->conn->query("INSERT INTO eleves VALUE (NULL, '".$email."', '".$nom."', '".$prenom."', '".$etab."', '".$indus."', '".$gestion."', '".$reseau."' );");
    $db->conn->query("UNLOCK TABLE eleves;");

    if(!$result){
        $toReturn = array(
            "error" => true,
            "message" => "Une erreur est survenue lors de l'enregistrement de vos coordonnées.",
        );
    }else{

        $db = new Database();
        $result = $db->conn->query("SELECT max(id) FROM eleves;");

        $id = $result->fetch()[0];


        $listCourses = array();

        foreach ($_SESSION["data_jours"] as $jour){
            foreach ($jour["cours"] as $cours){
                array_push($listCourses, $cours);
            }
        }


        $toReturn = array(
            "error" => false,
            "message" => "L'inscription s'est terminée correctement.",
        );


        // esce qu'il a assez de place partout ?
        $dispo = true;

        foreach ($listCourses as $cours){
            if($cours != 0){
                if(Horaire::getPlaceByHoraireId($cours) <= 0){
                    $toReturn = array(
                        "error" => true,
                        "message" => "Il y n'y a plus de place disponible dans le cours '(".Horaire::getLabelById($cours).")'.",
                    );
                    $dispo = false;
                    break;
                }
            }
        }

        if($dispo) {
            foreach ($listCourses as $cours) {
                if ($cours != 0) {
                    Eleves_horaires::insertEleveHoraire($cours, $id);
                    if (!$result) {
                        $toReturn = array(
                            "error" => true,
                            "message" => "Une erreur est survenue lors de l'enregistrement des cours. (" . $cours . ") => " . $db->conn->errorInfo()[2],
                        );
                        break;
                    }
                }
            }
        }


    }

}

echo(json_encode($toReturn));