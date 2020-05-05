<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 28/04/2020             */
/***********************************************************/

require_once(__DIR__ . "/php/require_all.php");

define("premier", 1);
define("deuxieme", 2);
define("troisieme", 3);
define("quatrieme", 4);

$class = "";

?>


<html>
<head>
    <?php require_once(__DIR__ . "/inc/head.php"); ?>
</head>
<body ng-app="myApp">

<?php require_once(__DIR__ . "/inc/nav.php"); ?>

<section>

    <header>
        <h1>Liste des cours</h1>
    </header>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Bloc</th>
            <th scope="col">Nom du cours</th>
            <th scope="col">Type de cours</th>
            <th scope="col">Voir</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $courses = Horaire::getAllLessons();

        ?>

        <?php foreach ($courses as $ligne){ ?>
        <tr class="table">
            <th scope="row"><?php echo($ligne["bloc"]); ?></th>
            <th scope="row"><?php echo($ligne["intitule"]); ?></th>
            <th scope="row"><?php echo($ligne["type"]); ?></th>
            <th scope="row"><a class="btn btn-outline-secondary"  data-course-id="<?php echo($ligne["id"]); ?>">Ajouter</a></th>
        </tr>
        <?php } ?>

        </tbody>
    </table>
</section>



<script>


</script>
</body>
</html>
