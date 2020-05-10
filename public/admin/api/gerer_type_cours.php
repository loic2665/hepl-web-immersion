<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 10/05/2020             */
/***********************************************************/


@session_start();
require_once(__DIR__."/../../php/require_all.php");

/* Premier switch pour récuperer l'action et définir les champs requis */

switch($_POST["action"])
{
    case "add":
        $posts = array("action", "type");
        break;

    case "get":
        $posts = array("action", "id");
        break;

    case "modif":
        $posts = array("action", "id", "type");
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
    if (!isset($_POST[$post]) || empty($_POST[$post])) {
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
    $toReturn["error"] = false;

    switch ($_POST["action"])
    {

        case "add":
            if(Type_cours::insertType($data["type"])){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le type ".$data["type"]."à bien été insérer.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de l'ajout du type.";
            }
            break;

        case "get":
            $toReturn["data"] = Type_cours::getTypeById($data["id"]);
            break;

        case "delete":
            if(Type_cours::deleteType($data["id"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le type a bien été supprimé.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la suppression du type.";
            }
            break;

        case "modif":
            if(Type_cours::updateType($data["id"], $data["type"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le type ".$data["type"]."à bien été modifier.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la modification du type.";
            }
            break;

        default:

            break;
    }
}

echo(json_encode($toReturn));
