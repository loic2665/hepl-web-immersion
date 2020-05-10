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
        $posts = array("action", "intitule", "bloc");
        break;

    case "get":
        $posts = array("action", "id");
        break;

    case "modif":
        $posts = array("action", "id", "intitule", "bloc");
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
    switch ($_POST["action"])
    {

        case "add":
            if(Cours::insertSubject($data["intitule"], $data["bloc"])){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le cours ".$data["intitule"]."à bien été insérer.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de l'ajout du cours.";
            }
            break;

        case "get":
            $toReturn["data"] = Cours::getSubjectById($_POST["id"]);
            break;

        case "delete":
            if(Cours::deleteSubject($data["id"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le cours a bien été supprimé.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la suppression du cours.";
            }
            break;

        case "modif":
            if(Cours::updateSubject($data["id"], $data["intitule"], $data["bloc"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "Le cours ".$data["intitule"]."à bien été modifier.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la modification du cours.";
            }
            break;

        default:

            break;
    }
    $toReturn["error"] = false;
}

echo(json_encode($toReturn));
