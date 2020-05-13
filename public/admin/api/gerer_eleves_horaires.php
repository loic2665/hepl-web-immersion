<?php

/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 11/05/2020             */
/***********************************************************/


@session_start();
require_once(__DIR__ . "/../../php/require_all.php");

/* Premier switch pour récuperer l'action et définir les champs requis */

switch ($_POST["action"]) {
    case "add":
        $posts = array("action", "id_horaires", "id_eleves");
        break;

    case "get":
        $posts = array("action", "id");
        break;

    case "modif":
        $posts = array("action", "id", "id_horaires", "id_eleves");
        break;

    case "delete":
        $posts = array("action", "id");
        break;

    case "affiche":
        $posts = array("action", "id");
        break;

    default:

        break;
}

/* Vérification que les données requises sont bien présentes */

$data = array();
$message = "Attention, les champs ";
$error = false;
$input_error = array();
foreach ($posts as $post) {
    if (!isset($_POST[$post]) || empty($_POST[$post])) {
        $message .= $post . ", ";
        array_push($input_error, $post);
        $error = true;
    } else {
        $data[$post] = addslashes(htmlspecialchars($_POST[$post]));
    }
}
$message .= " ne sont pas défini.";

if ($error) /* Si erreur */ {

    $toReturn = array(
        "error" => true,
        "message" => $message,
        "input_error" => $input_error,  // pour savoir quoi mettre en rouge
    );

} else /* Effectuer la requete demandée */ {
    $toReturn["error"] = false;
    switch ($_POST["action"]) {

        case "add":
            if (Eleves_horaires::insertEleveHoraire($data["id_horaires"], $data["id_eleves"])) {
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire à bien été insérer.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de l'horaire.";
            }
            break;

        case "get":
            $toReturn["data"] = Eleves_horaires::getEleveHoraireById($data["id"]);
            break;

        case "delete":
            if (Eleves_horaires::deleteEleveHoraire($data["id"]) > 0) {
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire a bien été supprimé.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la suppression de l'horaire.";
            }
            break;

        case "modif":
            if (Eleves_horaires::updateEleveHoraire($data["id"], $data["id_horaires"], $data["id_eleves"]) > 0) {
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire à bien été modifier.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la modification de l'horaire.";
            }
            break;

        case "affiche":
            $toReturn["data"] = Eleves_horaires::getAllEleveHoraireAffiche($data["id"]);
            break;

        default:

            break;
    }
}

echo(json_encode($toReturn));
