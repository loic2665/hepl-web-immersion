<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


class Cours
{
    //avoir tt les cours + type
    /*récupérer tous les professeurs de la base de donnée*/
    public static function getAllTeachers()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM enseignants 
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    
    //avoir tt les cours + type selon intitule

    //avoir tt les cours + type selon id

}