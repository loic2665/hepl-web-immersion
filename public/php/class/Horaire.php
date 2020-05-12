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
        ");
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
        WHERE intitule like '%".$name."%';");
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
        WHERE bloc = ".$bloc.";");
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
        WHERE date_cours = '".$date."';");
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
        WHERE 1;");
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
        WHERE id = '".$id."'" );
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
        WHERE horaires.id = ".$id.";");
        $array = $result->fetch(PDO::FETCH_ASSOC);

        return $array["intitule"]." - ".$array["type"]." - ".$array["heure_debut"]."~".$array["heure_fin"];

    }
    
    /*insérer un horaire dans la base de données*/
    public static function insertHoraire($id_cours, $id_enseignants, $id_type_cours, $date_cours, $id_tranches_horaires, $id_locaux, $inscription_max, $indus, $gestion, $reseau)
    {
        $db = new Database();
        $result = $db->conn->query("
        INSERT INTO horaires ( id_cours, id_enseignants, id_type_cours, date_cours, id_tranches_horaires, id_locaux, inscription_max, indus, gestion, reseau) 
            VALUES ('".$id_cours."', '".$id_enseignants."', '".$id_type_cours."', '".$date_cours."', '".$id_tranches_horaires."', '".$id_locaux."', '".$inscription_max."', '".$indus."', '".$gestion."', '".$reseau."')" );

        return $result;
    }

    /*mettre à jour un horaire dans la base de données*/
    public static function updateHoraire($id, $id_cours, $id_enseignants, $id_type_cours, $date_cours, $id_tranches_horaires, $id_locaux, $inscription_max, $indus, $gestion, $reseau)
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
                inscription_max = '".$inscription_max."',
                indus = '".$indus."',
                gestion = '".$gestion."',
                reseau = '".$reseau."'
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


    /* fonction qui verifie si le cours se donne bien à cette date (les petits malin peuvent avoir changé le cours en JS lol
       si le cours n'existe pas, alors il renvoie faux, comme si le cours ne se donnait pas a cette date, c'est normal    */

    public static function checkHoraireAndId($id, $date, $tranche){


        $db = new Database();
        $result = $db->conn->query("
        SELECT horaires.date_cours, th.tranche_horaire
        FROM horaires
            INNER JOIN tranches_horaires th on horaires.id_tranches_horaires = th.id
        WHERE horaires.id = ".$id.";");
        $array = $result->fetch(PDO::FETCH_ASSOC);

        if($array["date_cours"] == $date && $array["tranche_horaire"] == $tranche){
            return true;
        } else {
            return false;
        }


    }
}