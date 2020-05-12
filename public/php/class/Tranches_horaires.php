<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Tranches_horaires
{

    /*récupérer toutes les tranches horaires de la base de données*/
    public static function getAllTranchesHoraires()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM tranches_horaires
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer le local de la base de données selon l'identifiant*/
    public static function getTrancheHoraireById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM tranches_horaires
        WHERE id = '".$id."'" );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*insérer un local dans la base de données*/
    public static function insertTrancheHoraire($heure_debut, $heure_fin, $tranche_horaire)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO tranches_horaires (heure_debut, heure_fin, tranche_horaire)
            VALUES ('".$heure_debut."', '".$heure_fin."', '".$tranche_horaire."')" );

        return $result;
    }

    /*mettre à jour un local dans la base de données*/
    public static function updateTrancheHoraire($id, $heure_debut, $heure_fin, $tranche_horaire)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE tranches_horaires 
            SET heure_debut = '".$heure_debut."',
                heure_fin = '".$heure_fin."',
                tranche_horaire = '".$tranche_horaire."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*supprimer un local dans la base de données*/
    public static function deleteTrancheHoraire($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM tranches_horaires
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }
}