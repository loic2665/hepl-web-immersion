<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/


require_once(__DIR__."/Database.php");

class Horaire
{

    /*récupérer tous les cours de l'horaire dans la base de données*/
    public static function getAllLessons()
    {

        $db = new Database();

        $result = $db->conn->query("
        SELECT * 
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
        WHERE horaires.archive = 0;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les cours de l'horaire dans la base de données pour un affichage propre*/
    public static function getAllLessonsDisplay()
    {

        $db = new Database();

        $result = $db->conn->query("
        SELECT  horaires.id AS id, c.intitule AS id_cours, CONCAT(e.nom, ' ', e.prenom) AS id_enseignants,
                tc.type AS id_type_cours, horaires.date_cours AS date_cours, 
                CONCAT(th.heure_debut, ' - ',th.heure_fin) AS id_tranches_horaires, l.local AS id_locaux,
                horaires.inscription AS inscription, horaires.inscription_max AS inscription_max, 
                CASE
                    WHEN horaires.indus = 1
                        THEN 'Oui'
                        ELSE 'Non'
                    END AS indus,
                CASE
                    WHEN horaires.gestion = 1
                        THEN 'Oui'
                        ELSE 'Non'
                    END AS gestion,
                CASE
                    WHEN horaires.reseau = 1
                        THEN 'Oui'
                        ELSE 'Non'
                    END AS reseau,
                CASE
                    WHEN horaires.visible = 1
                        THEN 'Oui'
                        ELSE 'Non'
                    END AS visible  
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN enseignants e on horaires.id_enseignants = e.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
            INNER JOIN locaux l on horaires.id_locaux = l.id    
        WHERE horaires.archive = 0;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }

    /*récupérer tous les cours de l'horaire dans la base de données d'après l'intitulé*/
    public static function getLessonsByName($name)
    {

        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $name = addslashes(htmlspecialchars($name));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
        WHERE intitule like '%".$name."%'
        AND horaires.archive = 0 ;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;
    }
    /* recupere tout les cours de l'horaire d'après le bloc */
    public static function getLessonsDateByBloc($bloc){

        $bloc = addslashes(htmlspecialchars($bloc));

        $db = new Database();
        $result = $db->conn->query("
        SELECT DISTINCT date_cours
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
        WHERE bloc = ".$bloc."
        AND horaires.archive = 0;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;

    }
    /* recupère les cours par date et tranche horaire*/
    public static function getLessonsByDate($date){

        $date = addslashes(htmlspecialchars($date));

        $db = new Database();
        $result = $db->conn->query("
        SELECT horaires.id, th.tranche_horaire, c.intitule, c.bloc, tc.type, horaires.gestion, horaires.indus, horaires.reseau, th.heure_debut, th.heure_fin
        FROM horaires
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
        WHERE date_cours = '".$date."'
        AND horaires.archive = 0;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;

    }

    /* recupère toutes les dates de cours dispo et affichable */
    public static function getAllDateLessons(){

        $db = new Database();
        $result = $db->conn->query("
        SELECT DISTINCT date_cours
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
        WHERE horaires.archive = 0
        AND horaires.visible = 1;");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        return $array;

    }

    /*récupérer l'horaire de la base de données selon l'identifiant*/
    public static function getHoraireById($id)
    {
        /* evite les attaques SQL (securite)  échape --> ' " \ */
        $id = addslashes(htmlspecialchars($id));

        $db = new Database();
        $result = $db->conn->query("
        SELECT *
        FROM horaires
        WHERE id = '".$id."'
        AND archive = 0;");

        $line = $result->fetch(PDO::FETCH_ASSOC);

        return $line;
    }

    /* Javascript text */
    public static function getLabelById($id){

        $db = new Database();
        $result = $db->conn->query("
        SELECT c.intitule, tc.type, th.heure_debut, th.heure_fin
        FROM horaires
            INNER JOIN cours c on horaires.id_cours = c.id
            INNER JOIN type_cours tc on horaires.id_type_cours = tc.id
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id 
        WHERE horaires.id = ".$id."
        AND horaires.archive = 0;");

        $array = $result->fetch(PDO::FETCH_ASSOC);

        return $array["intitule"]." - ".$array["type"]." - ".$array["heure_debut"]."~".$array["heure_fin"];

    }
    
    /*insérer un horaire dans la base de données*/
    public static function insertHoraire($id_cours, $id_enseignants, $id_type_cours, $date_cours, $id_tranches_horaires, $id_locaux, $inscription, $inscription_max, $indus, $gestion, $reseau, $visible)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO horaires ( id_cours, id_enseignants, id_type_cours, date_cours, id_tranches_horaires, id_locaux, inscription, inscription_max, indus, gestion, reseau, visible) 
            VALUES ('".$id_cours."', '".$id_enseignants."', '".$id_type_cours."', '".$date_cours."', '".$id_tranches_horaires."', '".$id_locaux."', '".$inscription."', '".$inscription_max."', '".$indus."', '".$gestion."', '".$reseau."', '".$visible."')" );

        return $result;
    }

    /*mettre à jour un horaire dans la base de données*/
    public static function updateHoraire($id, $id_cours, $id_enseignants, $id_type_cours, $date_cours, $id_tranches_horaires, $id_locaux, $inscription, $inscription_max, $indus, $gestion, $reseau, $visible)
    {
        $db = new Database();
        $result = $db->conn->query("
        UPDATE horaires 
            SET id_cours = '".$id_cours."',
                id_enseignants = '".$id_enseignants."',
                id_type_cours = '".$id_type_cours."',
                date_cours = '".$date_cours."',
                id_tranches_horaires = '".$id_tranches_horaires."',
                id_locaux = '".$id_locaux."',
                inscription = '".$inscription."',
                inscription_max = '".$inscription_max."',
                indus = '".$indus."',
                gestion = '".$gestion."',
                reseau = '".$reseau."',
                visible = '".$visible."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*supprimer un horaire dans la base de données*/
    public static function deleteHoraire($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        DELETE FROM horaires
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }

    /*mettre à jour la visibilitée d'un horaire dans la base de données*/
    public static function setvisibilityHoraire($id)
    {
        $db = new Database();

        $result = $db->conn->query("
        SELECT visible
        FROM horaires
        WHERE id = '".$id."' " );

        $line = $result->fetch(PDO::FETCH_ASSOC);

        if($line['visible'] == 1)
        {
            $visible = 0;
        }
        else
        {
            $visible = 1;
        }

        $result = $db->conn->query("
        UPDATE horaires 
            SET visible = '".$visible."'
        WHERE id = '".$id."' " );

        return $result->rowCount();
    }


    /* fonction qui verifie si le cours se donne bien à cette date (les petits malin peuvent avoir changé le cours en JS lol
       si le cours n'existe pas, alors il renvoie faux, comme si le cours ne se donnait pas a cette date, c'est normal    */

    public static function checkHoraireAndId($id, $date, $tranche){


        $db = new Database();
        $result = $db->conn->query("
        SELECT horaires.date_cours, th.tranche_horaire
        FROM horaires
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
        WHERE horaires.id = ".$id."
        AND horaires.archive = 0;");

        $array = $result->fetch(PDO::FETCH_ASSOC);

        if($array["date_cours"] == $date && $array["tranche_horaire"] == $tranche){
            return true;
        } else {
            return false;
        }
    }

    /* Fonction qui permet de retourner le nombre de places disponible selon un horaire pour la redirection d'élèves*/
    public static function getPlacesDispoHoraireId($id)
    {
        $db = new Database();
        $result = $db->conn->query("
        SELECT horaires.inscription, horaires.inscription_max
        FROM horaires
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
        WHERE horaires.id <> ".$id."
        AND date_cours = (SELECT date_cours
                          FROM horaires
                          WHERE horaires.id = ".$id."
                          AND horaires.archive = 0)
        AND th.tranche_horaire = (SELECT tranche_horaire
                                    FROM horaires
                                        INNER JOIN tranches_horaires on horaires.id_tranches_horaires = tranches_horaires.id
                                    WHERE horaires.id = ".$id."
                                    AND horaires.archive = 0);");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        $placesdispo = 0;

        foreach ($array as $ligne)
        {
            $placesdispo = $placesdispo + ($ligne["inscription_max"] - $ligne["inscription"]);
        }

        return $placesdispo;
    }

    /* Fonction qui permet d'ajouter un inscrit a l'id de horraire*/
    public static function IncIsc($id)
    {
        $db = new Database();
        $result = $db->conn->query("
            SELECT inscription 
            FROM horaires
            WHERE id = '".$id."';" );
        $insc = $result->fetch(PDO::FETCH_ASSOC);

        $inscit = $insc["inscription"] + 1;

        $result = $db->conn->query("
            UPDATE horaires 
            SET inscription = '".$inscit."'
            WHERE id = '".$id."';" );
    }

    /* Fonction qui permet d'ajouter un inscrit a l'id de horraire*/
    public static function DecIsc($id)
    {
        $db = new Database();
        $result = $db->conn->query("
            SELECT inscription 
            FROM horaires
            WHERE id = '".$id."';" );
        $insc = $result->fetch(PDO::FETCH_ASSOC);

        $inscit = $insc["inscription"] - 1;

        $result = $db->conn->query("
            UPDATE horaires 
            SET inscription = '".$inscit."'
            WHERE id = '".$id."';" );
    }


    /* Fonction qui permet de déplacer les élèves d'après l'id de horraire*/
    public static function DoDeplacement($id, $eleves)
    {
        $db = new Database();
        foreach ($eleves as $eleve)
        {
            /* on récupère l'id du premier cours où il y à de la place*/
            $result = $db->conn->query("
            SELECT horaires.id as id
            FROM horaires
                INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
            WHERE horaires.id <> ".$id."
            AND date_cours = (SELECT date_cours
                              FROM horaires
                              WHERE horaires.id = ".$id.")
            AND th.tranche_horaire = (SELECT tranche_horaire
                                        FROM horaires
                                            INNER JOIN tranches_horaires on horaires.id_tranches_horaires = tranches_horaires.id
                                        WHERE horaires.id = ".$id.")
            AND horaires.inscription < horaires.inscription_max
            LIMIT 1;");
            $line = $result->fetch(PDO::FETCH_ASSOC);

            /* ici on assigne l'élève à ce cours */
            Eleves_horaires::insertEleveHoraire($line["id"], $eleve["id"]);

            /* supprime l'élève de l'ancien cours */
            Eleves_horaires::deleteEleveHoraire($id, $eleve["id"]);

        }
        return 1;
    }



}