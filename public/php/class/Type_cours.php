<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Type_cours
{

    /*récupérer tous les types des cours de la base de données*/
    public static function getAllTypes()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM type_cours;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer le type de cours de la base de données selon l'identifiant*/
    public static function getTypeById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM type_cours
        WHERE id = '".$id."';");

        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*insérer un type de cours dans la base de données*/
    public static function insertType($type)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO type_cours (type)
            VALUES ('".$type."');");

        return $result;
    }

    /*mettre à jour un type de cours dans la base de données*/
    public static function updateType($id, $type)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE type_cours 
            SET type = '".$type."'
        WHERE id = '".$id."';");

        return $result->rowCount();
    }

    /*supprimer un type de cours dans la base de données*/
    public static function deleteType($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM type_cours
        WHERE id = '".$id."';");

        return $result->rowCount();
    }
}