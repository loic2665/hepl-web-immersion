<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Local
{

    /*récupérer tous les locaux de la base de données*/
    public static function getAllLocals()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM locaux
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

}