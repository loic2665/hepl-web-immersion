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
<script>

    $("#nom, #prenom, #interet, #etablissement, #jours").on("focus", function () {
        $(this).removeClass("is-invalid");
    });

    $("#send_btn").on("click", function () {

        $.ajax({
            type: "POST",                                    // type de requete
            url: "/api/welcome.php",                         // url de la requete
            data: {                                          // data de la requetes, les paramètres
                nom: $("#nom").val(),
                prenom: $("#prenom").val(),
                interet: $("#interet").val(),
                etablissement: $("#etablissement").val(),
                jours: $("#jours").val(),
            },
            dataType: "json",                                 // le type de data attendu par jquery
            success: function (result, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
                console.log(result, xhrStatus);
                if(xhrStatus.status === 200){
                    if(result.error === true){
                        toastr["warning"](result.message, "Erreur");              // on affiche le toast
                        result.input_error.forEach(element => $("#"+element).addClass("is-invalid"));  // pour chaque element des input en erreur j'ajoute la classe d'invalidité du champs
                    }else{                                                                             // merci bootsrap
                        toastr["success"](result.message, "Succès");              // on affiche le toast
                        setTimeout(function(){ window.location = "/inscription.php" }, 2000);
                    }
                }
            },
            error: function (result) {
                toastr["error"]("Oops !", "Erreur !"); // toast..
            },
            complete: function(result){ // on execute le quoi que ce soit une erreur ou non

            },
        });

    });


</script>
</html>

