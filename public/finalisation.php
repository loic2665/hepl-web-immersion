<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 28/04/2020             */
/***********************************************************/

require_once(__DIR__."/php/require_all.php");


?>


<html>
<head>
    <title>Immersion HEPL - Accueil</title>
    <?php require_once(__DIR__."/inc/head.php"); ?>

</head>
<body>

<?php require_once(__DIR__."/inc/nav.php"); ?>

<section id="content">


    <h1>Récapitulatif de votre inscription</h1>

    <?php
    $iJour = 1;
    ?>




    <?php foreach($_SESSION["data_jours"] as $jour){ ?>

        <h2>Journée N°<?php echo($iJour); ?> - <?php echo($jour["date"]); ?></h2>

        <p>La journée <?php echo($iJour); ?> est constituée de <?php $nbCours = 0; foreach($jour["cours"] as $cours){ if($cours != 0){ $nbCours++; } } echo($nbCours);?> cours.</p>

        <ul class="list-group">
            <?php foreach ($jour["cours"] as $cours){ ?>
                <?php if($cours != 0){ ?>
                    <li class="list-group-item"><?php echo(Horaire::getLabelById($cours)); ?></li>
                <?php } else { ?>
                    <li class="list-group-item">Aucun cours.</li>
                <?php } ?>
            <?php } ?>
        </ul>

        <br />

        <?php $iJour++; } ?>


</section>

<section>

</section>
</body>
<script>


</script>
</html>

