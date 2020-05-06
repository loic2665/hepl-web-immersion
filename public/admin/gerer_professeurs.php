<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 05/05/2020          -->
<!-- ---------------------------------------------------- -->


<?php require_once(__DIR__."/../php/require_all.php"); ?>


<html>
    <head>
        <title>Immersion HEPL - Accueil</title>
        <?php require_once(__DIR__."/../inc/head.php"); ?>
    </head>
    <body>
        <?php require_once(__DIR__."/../inc/nav_admin.php"); ?>
        <section id="content">
            <article>

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
                        "id" => "sexe",
                        "type" => "select",
                        "label" => "Sexe",
                        "name" => "sexe",
                        "options" => [
                            ["value" => "m", "text" => "Homme"],
                            ["value" => "f", "text" => "Femme"],
                        ],
                    ),
                    array(
                        "id" => "image",
                        "type" => "text",
                        "placeholder" => "Photo",
                        "label" => "image",
                        "name" => "image"
                    ),
                );
                ?>

                <fieldset>
                    <legend>Ajouter un professeur</legend>
                    <?php generateForm($champs); ?>
                </fieldset>

                <button class="btn btn-success" id="send_btn">Valider</button>
                <button class="btn btn-danger" id="cancel_btn">Annuler</button>

            </article>
            <article>
                <legend>Liste des professeurs</legend>
                <a class="btn btn-info">Ajouter</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Sexe</th>
                            <th scope="col">Photo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $professeurs = Enseignant::getAllTeachers();
                        ?>
                        <?php foreach ($professeurs as $ligne){ ?>
                        <tr class="table">
                            <th scope="row"><?php echo($ligne["id"]); ?></th>
                            <th scope="row"><?php echo($ligne["nom"]); ?></th>
                            <th scope="row"><?php echo($ligne["prenom"]); ?></th>
                            <th scope="row"><?php echo($ligne["sexe"]); ?></th>
                            <th scope="row"><?php echo($ligne["image"]); ?></th>
                            <th scope="row"><a class="btn btn-success"  data-course-id="<?php echo($ligne["id"]); ?>">Modifier</a></th>
                            <th scope="row"><a class="btn btn-danger"  data-course-id="<?php echo($ligne["id"]); ?>">Supprimer</a></th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </article>
        </section>
    </body>
    <script>

        $("#nom, #prenom, #sexe, #image").on("focus", function () {
            $(this).removeClass("is-invalid");
        });

        $("#send_btn").on("click", function () {

            $.ajax({
                type: "POST",                                    // type de requete
                url: "/api/welcome.php",                         // url de la requete
                data: {                                          // data de la requetes, les paramètres
                    nom: $("#nom").val(),
                    prenom: $("#prenom").val(),
                    sexe: $("#sexe").val(),
                    image: $("#image").val(),
                },
                dataType: "json",                                 // le type de data attendu par jquery
                success: function (result, data, xhrStatus) {     // si il correspond pas ou code http != 200 => callback dans error
                    if(xhrStatus.status === 200){
                        if(result.error === true){
                            toastr["warning"](result.message, "Erreur");              // on affiche le toast
                            result.input_error.forEach(element => $("#"+element).addClass("is-invalid"));  // pour chaque element des input en erreur j'ajoute la classe d'invalidité du champs
                        }else{                                                                             // merci bootsrap
                            toastr["success"](result.message, "Succès");              // on affiche le toast
                           // setTimeout(function(){ window.location = "/inscription.php" }, 2000);
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