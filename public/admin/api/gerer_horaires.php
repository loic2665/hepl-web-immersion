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

redirectIfnotLoggedIn();

/* Premier switch pour récuperer l'action et définir les champs requis */

switch($_POST["action"])
{
    case "add":
        $posts = array("action", "id_cours", "id_enseignants", "id_type_cours", "date_cours", "id_tranches_horaires", "id_locaux", "inscription", "inscription_max", "indus", "gestion", "reseau", "visible");
        break;

    case "get":
        $posts = array("action", "id");
        break;

    case "delete":
        $posts = array("action", "id");
        break;

    case "visible":
        $posts = array("action", "id");
        break;

    case "depeleves":
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
    $toReturn["error"] = false;
    switch ($_POST["action"])
    {

        case "add":
            $data["inscription_max"] = Config::getConfigTypeCours()[Type_cours::getTypeTypeById($data["id_type_cours"])]; //recupere le nombre d'inscriptions selon le type

            if(Horaire::insertHoraire($data["id_cours"], $data["id_enseignants"], $data["id_type_cours"], $data["date_cours"], $data["id_tranches_horaires"], $data["id_locaux"], $data["inscription"], $data["inscription_max"], $data["indus"], $data["gestion"], $data["reseau"], $data["visible"])){
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

        case "visible":
            if(Horaire::setvisibilityHoraire($data["id"]) > 0){
                $toReturn["error"] = false;
                $toReturn["message"] = "L'horaire à bien été modifier.";
            } else {
                $toReturn["error"] = true;
                $toReturn["message"] = "Une erreur s'est produite lors de la modification de l'horaire.";
            }
            break;

        case "depeleves":
            $eleves = Eleves_horaires::getEleveByHoraireId($data["id"]);
            $nombreEleves = count($eleves);

            if(Horaire::getPlacesDispoHoraireId($data["id"]) >= $nombreEleves)//verifie le nombre de places disponible
            {
                if(Horaire::DoDeplacement($data["id"], $eleves)){
                    $toReturn["error"] = false;
                    $toReturn["message"] = "Les élèves ont été déplacé.";
                    $toReturn["eleves"] = $eleves;
                } else {
                    $toReturn["error"] = true;
                    $toReturn["message"] = "Une erreur s'est produite lors du déplacement des élèves.";
                }
            }
            else
            {
                $toReturn["error"] = true;
                $toReturn["message"] = "Le déplacement des élèves est impossible!";
            }


            break;
        default:

            break;
    }
}

echo(json_encode($toReturn));
