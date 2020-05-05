<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : 27/4/2020           -->
//-- ---------------------------------------------------- -->

require_once(__DIR__."/php/require_all.php");
if(!isset($_SESSION["currJour"])){

    // si les la clé dans l'url GET 'nbDay' n'existe pas OU
    // que la valeur de la clé 'nbDay' est vide (ou = à 0)
    // todo: redirige l'utilisateur vers la page precédente + msg erreur

    die();

}else if($_SESSION["currJour"] < 0){

    // si le nombre de jour que l'utilisateur à entré est plus petit ou égal à zéro
    // idem todo plus haut
    die("?????");

}
$afficheJour = $_SESSION["currJour"] + 1;

?>


<html>
<head>
    <title>Immersion HEPL - Accueil</title>
    <?php require_once(__DIR__."/inc/head.php"); ?>

</head>
<body>

<?php require_once(__DIR__."/inc/nav.php"); ?>

<section id="content">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Inscription</a></li>
        <li class="breadcrumb-item active">Jour <?php echo($afficheJour); ?></li>
    </ol>


    <div class="row">
        <div class="col-md-3 col-lg-3 col-xl-2">
            <div id="block-blocs">
                <div class="list-group">
                    <?php for($i = 1; $i <= 3; $i++){ ?>
                        <a href="#" class="list-group-item list-group-item-action bloc" data-bloc="<?php echo($i); ?>">Bloc <?php echo($i); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9 col-lg-9 col-xl-10">
            <div id="block-contentJour">

                <fieldset>
                    <legend>
                        Inscription - Jour <?php echo($afficheJour);  ?>
                    </legend>

                    <?php $champs = array(
                        array(
                            "label" => "Choix du jour ".$afficheJour,
                            "type" => "select",
                            "name" => "dateJour",
                            "id" => "dateJour",
                            "options" => [],
                        ),

                    );

                    for($i_horaire = 1; $i_horaire <= 4; $i_horaire++){
                        $horaire = array(
                            "label" => "Choix du cours ".($i_horaire),
                            "type" => "select",
                            "name" => "cours".$i_horaire,
                            "id" => "cours".$i_horaire,
                            //"options" => [["value" => "123", "text" => "123"]],
                            "options" => [],
                        );

                        // le options sera rempli en

                        array_push($champs, $horaire);
                    }



                    generateForm($champs);
                    ?>



                </fieldset>

            </div>
        </div>
    </div>


    <script src="/js/inscription.js"></script>



</section>
</body>

</html>

