<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : 03/5/2020           -->
//-- ---------------------------------------------------- -->

require_once(__DIR__."/php/require_all.php");

if(!isset($_GET["nbDay"]) || empty($_GET["nbDay"])){

    // si les la clé dans l'url GET 'nbDay' n'existe pas OU
    // que la valeur de la clé 'nbDay' est vide (ou = à 0)
    // todo: redirige l'utilisateur vers la page precédente + msg erreur

    die();

}else if($_GET["nbDay"] <= 0){

    // si le nombre de jour que l'utilisateur à entré est plus petit ou égal à zéro
    // idem todo plus haut
    die("?????");

}else{
    $nbDay = addslashes(htmlspecialchars($_GET["nbDay"]));
    // recupère la donnée
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
    <div class="row">
        <div class="col-xs-12 col-xl-3">
            <div class="block-gauche">
                <br/>
                <h1>Inscription</h1>


            </div>
        </div>
        <div class="col-xl-9">
            <div class="block-droite">


                <!-- les sections sont ici -->

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

</html>

