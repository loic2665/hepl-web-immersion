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
    /*récupérer tous les cours et leur type de la base de données*/
    public static function getAllSubjects()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM  cours
            INNER JOIN type_cours t_c on cours.type_cours = t_c.id
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les cours et leur type de la base de données selon l'intitulé*/
    public static function getAllSubjectsByName($name)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $name = addslashes(htmlspecialchars($name));

        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM  cours
            INNER JOIN type_cours t_c on cours.type_cours = t_c.id
        WHERE cours.intitule like '%".$name."%'
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer un cours et son type de la base de données selon l'id*/
    public static function getSubjectById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM  cours
        WHERE id = '".$id."'
        ");
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*récupérer le nombre de cours de la base de données*/
    public static function countSubjects()
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT COUNT(*)
        FROM cours" );
        $line = $result->fetch();

        return $line[0];
    }

    /*insérer un cours dans la base de données*/
    public static function insertSubject($intitule, $bloc)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO cours (intitule, bloc) 
            VALUES ('".$intitule."', '".$bloc."')" );

        return $result;
    }

    /*mettre à jour un cours dans la base de données*/
    public static function updateSubject($id, $intitule, $bloc)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE cours 
            SET intitule = '".$intitule."',
                bloc = '".$bloc."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*supprimer un cours dans la base de données*/
    public static function deleteSubject($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM cours
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }
}