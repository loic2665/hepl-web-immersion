<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 28/04/2020             */
/***********************************************************/


@session_start();

$posts = array("utilisateur", "motdepasse");

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

if ($error) {

    $toReturn = array(
        "error" => true,
        "message" => $message,
        "input_error" => $input_error,  // pour savoir quoi mettre en rouge
    );

} else {

    $testUSER = "admin";
    $testPASS = "12345";

    if($data["utilisateur"] != $testUSER || $data["motdepasse"] != $testPASS){


        $toReturn = array(
            "error" => true,
            "message" => "Attention, login incorrect.",
            "input_error" => $posts, // on met tout les champs en rouge sinon ce serai un risque de securité de montrer ce qui va pas
        );

    }else{

        $toReturn = array(
            "error" => false,
            "message" => "Bienvenue " . $data["utilisateur"] . " ! Vous allez être redirigé.",
        );
    }





}
echo(json_encode($toReturn));