<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 12/05/2020          -->
<!-- ---------------------------------------------------- -->


<html>
<head>
    <title>Liste des élèves</title>
    <?php require_once(__DIR__."/../inc/head.php"); ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="section-0">
    <a class="navbar-brand" href="#"><img class="nav-logo" alt="HEPL IMMERSION" src="/img/logo.png"/></a>
</nav>

<?php
$array = json_decode($_GET["tab"]);
?>
<section id="content">
        <article>
            <h2>Liste des élèves qui ont été déplacés</h2>

            <table class="table table-hover">
                <thead>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($array as $object){ ?>
                    <tr class="table">
                        <th scope="row"><?php echo($object->id); ?></th>
                        <th scope="row"><?php echo($object->nom); ?></th>
                        <th scope="row"><?php echo($object->prenom); ?></th>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </article>
</section>
</body>
</html>
