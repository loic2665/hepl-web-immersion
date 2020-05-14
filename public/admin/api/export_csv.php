<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

require_once(__DIR__."/../../php/require_all.php");

redirectIfnotLoggedIn();

$date = date("y_m_d_h_i_s", time());

header("Content-type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=export_inscriptions_".$date.".csv");
header("Pragma: no-cache");
header("Expires: 0");

$collumns = array("email_eleve", "nom", "prenom", "date_cours", "intitule", "type_cours", "heure_debut", "heure_fin", "local", "nom_prof", "prenom_prof");

$header = "";

foreach ($collumns as $col){
    $header .= '"'.$col.'";';
}

$header = substr($header, 0, strlen($header)-1);
$header .= "\r\n";
echo($header);

$db = new Database();
$result = $db->conn->query("
SELECT e.email, e.nom, e.prenom, h.date_cours, c.intitule, tc.type, th.heure_debut, th.heure_fin, l.local, e2.nom, e2.prenom
FROM eleves_horaires
    INNER JOIN eleves e on eleves_horaires.id_eleves = e.id
    INNER JOIN horaires h on eleves_horaires.id_horaires = h.id
    INNER JOIN cours c on h.id_cours = c.id
    INNER JOIN enseignants e2 on h.id_enseignants = e2.id
    INNER JOIN type_cours tc on h.id_type_cours = tc.id
    INNER JOIN tranches_horaires th on h.id_tranches_horaires = th.id
    INNER JOIN locaux l on h.id_locaux = l.id
WHERE 1;
");

$all = $result->fetchAll(PDO::FETCH_NUM);
foreach ($all as $ligne){
    $data = "";
    foreach ($ligne as $l){
        $data .= '"'.$l.'";';
    }
    $data = substr($data, 0, strlen($data)-1);
    $data .= "\r\n";
    echo($data);
}

?>