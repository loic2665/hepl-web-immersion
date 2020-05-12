<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 11/05/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Eleves_horaires
{

    /*récupérer tous les horaires d'élèves de la base de données*/
    public static function getAllElevesHoraire()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT *
        FROM eleves_horaires
        ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les cours de l'horaire dans la base de données pour un affichage propre*/
    public static function getAllEleveHoraireDisplay()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT  eleves_horaires.id AS id, CONCAT(eleves_horaires.id_horaires, ' - ',h.date_cours, ' à ', th.heure_debut, ' : ', c.intitule) AS id_horaires,
                CONCAT(eleves_horaires.id_eleves, ' - ', e.nom, ' ', e.prenom) AS id_eleves      
        FROM eleves_horaires
            INNER JOIN horaires h on eleves_horaires.id_horaires = h.id
            INNER JOIN eleves e on eleves_horaires.id_eleves = e.id
            INNER JOIN tranches_horaires th on h.id_tranches_horaires = th.id
            INNER JOIN cours c on h.id_cours = c.id ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les cours de l'horaire dans la base de données pour un affichage propre*/
    public static function getAllEleveHoraireAffiche()
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT el.id as id, el.nom as nom, el.prenom as prenom, ho.date_cours as date, th.tranche_horaire as tranche_horaire,
               th.heure_debut as heure_debut, th.heure_fin as heure_fin, co.intitule as intitule
        FROM eleves_horaires ec
            INNER JOIN eleves el on ec.id_eleves = el.id
            INNER JOIN horaires ho on ec.id_horaires = ho.id
            INNER JOIN cours co on ho.id_cours = co.id
            INNER JOIN locaux lo on ho.id_locaux = lo.id
            INNER JOIN tranches_horaires th on ho.id_tranches_horaires = th.id
        ORDER BY el.nom DESC, ho.date_cours, th.tranche_horaire; ");
        $array = $result->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

        return $array;
    }

    /*récupérer un horaire d'élève de la base de données selon l'identifiant*/
    public static function getEleveHoraireById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM eleves_horaires
        WHERE id = '".$id."'" );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /*insérer un horaire d'élève dans la base de données*/
    public static function insertEleveHoraire($id_horaires, $id_eleves)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO eleves_horaires (id_horaires, id_eleves)
            VALUES ('".$id_horaires."', '".$id_eleves."')" );

        Horaire::IncIsc($id_horaires);

        return $result;
    }

    /*mettre à jour un  horaire d'élève dans la base de données*/
    public static function updateEleveHoraire($id, $id_horaires, $id_eleves)
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT id_horaires
        FROM eleves_horaires
        WHERE id = '".$id."' " );
        $line = $result->fetch(PDO::FETCH_ASSOC);

        Horaire::DecIsc($line["id_horaires"]);

        $result = $db->conn->query("
        UPDATE eleves_horaires 
            SET id_horaires = '".$id_horaires."',
                id_eleves = '".$id_eleves."'
        WHERE id = '".$id."' " );

        Horaire::IncIsc($id_horaires);

        return $result->rowCount();
    }

    /*supprimer un  horaire d'élève dans la base de données*/
    public static function deleteEleveHoraire($id_horaires, $id_eleves)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM eleves_horaires
        WHERE id_horaires = '".$id_horaires."'
        AND id_eleves = '".$id_eleves."' " );

        Horaire::DecIsc($id_horaires);

        return $result->rowCount();
    }

    /*récupérer les élèves de la base de données selon l'identifiant d'un horaire*/
    public static function getEleveByHoraireId($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT eleves.id AS id, eleves.nom AS nom, eleves.prenom AS prenom
        FROM eleves_horaires
            INNER JOIN eleves on eleves_horaires.id_eleves = eleves.id
        WHERE eleves_horaires.id_horaires = '".$id."'" );
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }
}

/*
        $result = $db->conn->query("
        SELECT el.id as id, el.nom as nom, el.prenom as prenom, ho.date_cours as date, th.tranche_horaire as tranche_horaire,
               th.heure_debut as heure_debut, th.heure_fin as heure_fin, co.intitule as intitule
        FROM eleves_horaires ec
            INNER JOIN eleves el on ec.id_eleves = el.id
            INNER JOIN horaires ho on ec.id_horaires = ho.id
            INNER JOIN cours co on ho.id_cours = co.id
            INNER JOIN locaux lo on ho.id_locaux = lo.id
            INNER JOIN tranches_horaires th on ho.id_tranches_horaires = th.id
        ORDER BY el.nom DESC, ho.date_cours, th.tranche_horaire; ");
        $array = $result->fetchAll(PDO::FETCH_ASSOC);*/