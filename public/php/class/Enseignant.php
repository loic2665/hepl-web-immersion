<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Enseignant
{

    /*récupérer tous les professeurs de la base de données*/
    public static function getAllTeachers()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM enseignants ;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les professeurs de la base de données selon le nom ou le prénom*/
    public static function getTeachersByName($name)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $name = addslashes(htmlspecialchars($name));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM enseignants
        WHERE nom like '%".$name."%'
        OR prenom like '%".$name."%';" );

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer le professeur de la base de données selon l'identifiant*/
    public static function getTeacherById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM enseignants
        WHERE id = '".$id."';" );

        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }


    /*récupérer les professeurs de la base de données selon l'identifiant d'un cours*/
    public static function getTeacherBySubjectId($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM enseignants
            INNER JOIN enseignants_cours e_c on enseignants.id = e_c.id_enseignant
        WHERE e_c.id_cours = '".$id."';" );

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer le nombre de professeurs de la base de données*/
    public static function countTeachers()
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT COUNT(*)
        FROM enseignants;" );

        $line = $result->fetch();

        return $line[0];
    }

    /*insérer un professeur dans la base de données*/
    public static function insertTeacher($nom, $prenom, $sexe)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO enseignants (nom, prenom, sexe) 
            VALUES ('".$nom."', '".$prenom."', '".$sexe."');" );

        return $result;
    }

    /*mettre à jour un professeur dans la base de données*/
    public static function updateTeacher($id, $nom, $prenom, $sexe)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE enseignants 
            SET nom = '".$nom."',
                prenom = '".$prenom."',
                sexe = '".$sexe."'
        WHERE id = '".$id."' ;" );

        return $result->rowCount();
    }

    /*supprimer un professeur dans la base de données*/
    public static function deleteTeacher($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM enseignants
        WHERE id = '".$id."' ;" );

        return $result->rowCount();
    }
    // ...

}