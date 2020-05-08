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

    /*insérer un élève dans la base de données*/
    public static function insertStudent($nom, $prenom, $email, $etablissement, $indus, $gestion, $reseau)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO eleves (nom, prenom, email, etablissement, indus, gestion, reseau) 
            VALUES ('".$nom."', '".$prenom."', '".$email."', '".$etablissement."', '".$indus."', '".$gestion."', '".$reseau."')" );

        return $result;
    }

    /*mettre à jour un élève dans la base de données*/
    public static function updateStudent($id, $nom, $prenom, $email, $etablissement, $indus, $gestion, $reseau)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE eleves 
            SET nom = '".$nom."',
                prenom = '".$prenom."',
                email = '".$email."',
                etablissement = '".$etablissement."',
                indus = '".$indus."',
                gestion = '".$gestion."',
                reseau = '".$reseau."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*supprimer un élève dans la base de données*/
    public static function deleteStudent($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM eleves
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }
}