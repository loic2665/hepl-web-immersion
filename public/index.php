<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 28/04/2020          -->
<!-- ---------------------------------------------------- -->

<?php require_once(__DIR__."/php/require_all.php"); ?>


<html>
<head>
    <title>Immersion HEPL - Accueil</title>
    <?php require_once(__DIR__."/inc/head.php"); ?>

</head>
<body>

<?php require_once(__DIR__."/inc/nav.php"); ?>

<section id="content">

    <h1>Pré-requis</h1>

    <?php

    $champs = array(
        array(
            "id" => "nom",
            "type" => "text",
            "placeholder" => "Nom",
            "label" => "Nom",
            "name" => "nom"
        ),
        array(
            "id" => "prenom",
            "type" => "text",
            "placeholder" => "Prénom",
            "label" => "Prénom",
            "name" => "prenom",
        ),
        array(
            "id" => "etablissement",
            "type" => "text",
            "placeholder" => "Votre établissement scolaire actuel",
            "label" => "Établissement scolaire actuel",
            "name" => "etablissement",
        ),
        array(
            "id" => "interet",
            "type" => "select",
            "label" => "Quel est votre intêret ?",
            "name" => "interet",
            "options" => [
                ["value" => "gestion", "text" => "Informatique de gestion"],
                ["value" => "reseau", "text" => "Informatique réseau télécom"],
                ["value" => "indus", "text" => "Informatique industrielle"],
            ],
        ),
        array(
            "id" => "jours",
            "type" => "number",
            "label" => "Combien de jours allez-vous participer ?",
            "name" => "jours",
            "min" => 1,
            "max" => 10,
            "step" => 1,
            "placeholder" => "Nombre de jours"
        ),
    );
    ?>

    <fieldset>
        <legend>Qui êtes-vous ?</legend>
        <?php generateForm($champs); ?>
    </fieldset>



    <button class="btn btn-success" id="send_btn">Commencer</button>



</section>
</body>
<script type="module" src="/js/prerequis.js"></script>
</html>

