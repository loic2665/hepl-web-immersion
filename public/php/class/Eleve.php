<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Eleve
{
    /*récupérer l'élève de la base de données selon l'identifiant*/
    public static function getStudentById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM eleves
        WHERE id = '".$id."'" );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*récupérer l'élève de la base de données selon l'adresse e-mail*/
    public static function getStudentByMail($email)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $email = addslashes(htmlspecialchars($email));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM eleves
        WHERE email = '".$email."'" );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }


    /*enregistrer un élève dans la base de données*/
    public static function registerStudent($student)
    {

        //code pour ajouter l'élève a la BD
        //voir comment faire par après

    }


    /*récupérer le nombre d'élèves de la base de données*/
    public static function countStudents()
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT COUNT(*)
        FROM eleves" );
        $line = $result->fetch();

        return $line[0];
    }

    /*récupérer les 5 derniers élèves inscrits de la base de données*/
    public static function getFiveLastStudents()
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM eleves
        ORDER BY id DESC
        LIMIT 5" );
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }
}