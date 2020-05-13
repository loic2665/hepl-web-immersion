<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 28/04/2020             */
/***********************************************************/

require_once(__DIR__."/php/require_all.php");


// verification de l'inscription, trouver les éventuelle érreurs

$error = false;
$joursChoisis = array();
$listErrors = array();

foreach ($_SESSION["data_jours"] as $jour) {

    if (in_array($jour["date"], $joursChoisis)) {
        $error = true;
        array_push($listErrors, "Le jour " . $jour["date"] . " est spécifié à deux jours différent.");
    } else {
        array_push($joursChoisis, $jour["date"]);
        for ($i = 1; $i <= 4; $i++) {

            if ($jour["cours"][$i - 1] != 0 && !Horaire::checkHoraireAndId($jour["cours"][$i - 1], $jour["date"], $i)) {
                $error = true;
                array_push($listErrors, "Incohérence entre " . $jour["date"] . " - Cours : " . $jour["cours"][$i - 1] . " et tranche : " . $i);
            }

        }
    }

}




?>


<html>
<head>
    <title>Immersion HEPL - Accueil</title>
    <?php require_once(__DIR__."/inc/head.php"); ?>

</head>
<body>

<?php require_once(__DIR__."/inc/nav.php"); ?>

<section id="content">

    <?php echo(Eleves_horaires::checkTypeAndCountEleveToAdd(1)); ?>
    <?php if($error){ ?>
        <div class="alert alert-danger">
            Désolé, l'inscription donnée n'est pas conforme. Liste des erreurs :
            <ul>
                <?php foreach ($listErrors as $erreur){ ?>
                    <li><?php echo($erreur); ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php }else{ ?>


        <div class="alert alert-success">
            Super ! Votre inscription est conforme.
        </div>

    <?php } ?>


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


    <div>
        <a class="btn btn-danger" id="reset-button">Annuler l'inscription</a>
        <a class="btn btn-success" id="confirm-button">Confirmer l'inscription</a>
    </div>

</section>

<section>

</section>
</body>
<script>


</script>
<script type="module" src="/js/enregistrement.js"></script>
</html>

