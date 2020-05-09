<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 07/05/2020             */
/***********************************************************/


@session_start();
require_once(__DIR__."/../../php/require_all.php");

/* Premier switch pour récuperer l'action et définir les champs requis */

switch($_POST["action"])
{
    case "add":
        $posts = array("action", "id_cours", "id_enseignants", "id_type_cours", "date_cours", "id_tranches_horaires", "id_locaux", "inscription_max", "indus", "gestion", "reseau");
        break;

    case "get":
        $posts = array("action", "id");
        break;

    case "modif":
        $posts = array("action", "id", "id_cours", "id_enseignants", "id_type_cours", "date_cours", "id_tranches_horaires", "id_locaux", "inscription_max", "indus", "gestion", "reseau");
        break;

    case "delete":
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
    if (!isset($_POST[$post])) {
        $message .= $post . ", ";
        array_push($input_error, $post);
        $error = true;
    } else {
        $data[$post] = addslashes(htmlspecialchars($_POST[$post]));
    }
}
$message .= " ne sont pas défini.";

if ($error) /* Si erreur */
{

    $toReturn = array(
        "error" => true,
        "message" => $message,
        "input_error" => $input_error,  // pour savoir quoi mettre en rouge
    );

}
else /* Effectuer la requete demandée */
{
    switch ($_POST["action"])
    {

        case "add":
            if(Horaire::insertHoraire($data["id_cours"], $data["id_enseignants"], $data["id_type_cours"], $data["date_cours"], $data["id_tranches_horaires"], $data["id_locaux"], $data["inscription_max"], $data["indus"], $data["gestion"], $data["reseau"])){
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire à bien été insérer.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de l'ajout de l'horaire.";
            }
            break;

        case "get":
            $toReturn["data"] = Horaire::getHoraireById($_POST["id"]);
            break;

        case "delete":
            if(Horaire::deleteHoraire($data["id"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire a bien été supprimé.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la suppression de l'horaire.";
            }
            break;

        case "modif":
            if(Horaire::updateHoraire($data["id"], $data["id_cours"], $data["id_enseignants"], $data["id_type_cours"], $data["date_cours"], $data["id_tranches_horaires"], $data["id_locaux"], $data["inscription_max"], $data["indus"], $data["gestion"], $data["reseau"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire à bien été modifier.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la modification de l'horaire.";
            }
            break;

        default:

            break;
    }
    $toReturn["error"] = false;
}

echo(json_encode($toReturn));
