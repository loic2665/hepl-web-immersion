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

    /*récupérer le local de la base de données selon l'identifiant*/
    public static function getLocalById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM locaux
        WHERE id = '".$id."'" );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*insérer un local dans la base de données*/
    public static function insertLocal($local)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO locaux (local)
            VALUES ('".$local."')" );

        return $result;
    }

    /*mettre à jour un local dans la base de données*/
    public static function updateLocal($id, $local)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE locaux 
            SET local = '".$local."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*supprimer un local dans la base de données*/
    public static function deleteLocal($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM locaux
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }
}

