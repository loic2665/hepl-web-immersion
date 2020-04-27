<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 26/04/2020          -->
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
<div class="row">
    <div class="col-xs-12 col-xl-3">
        <div class="block-gauche">
            <br/>
            <h1>Prérequis</h1>

            <?php

            $steps = array(
                array("step-welcome", "Bienvenue"),
                array("step-nb-days", "Nombre de jours"),
            );

            ?>


            <?php $i = 0; ?>
            <ol>
                <?php foreach ($steps as $step){ ?>
                <li><a class="step-click" id="list-step-<?php echo($step[0]); ?>" data-target="<?php echo($i); ?>"><?php echo($step[1]); $i++; ?></a></li>
                <?php } ?>
            </ol>

        </div>
    </div>
    <div class="col-xl-9">
        <div class="block-droite">

            <!-- les sections sont ici -->

            <?php $i = 0; ?>
            <?php foreach ($steps as $step){ $stepName = $step[0]; ?>
            <section id="<?php echo($stepName);?>" style="visibility: hidden">
                <div class="center white-text">
                    <?php include_once(__DIR__."/views/prerequis/".$stepName.".php"); ?>
                </div>
            </section>
            <?php $i++; } ?>


        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-xl-9">

        <div class="petit-block-gauche"></div>

    </div>
    <div class="col-xl-3">

        <div class="petit-block-droite block-button">

            <div>
                <a class="btn btn-info prev-button">Précédent</a>
                <a class="btn btn-warning suiv-button">Suivant</a>
            </div>

        </div>


    </div>
</div>

</section>
</body>

<script src="/js/common.js"></script>
<script src="/js/prerequis.js"></script>
</html>

