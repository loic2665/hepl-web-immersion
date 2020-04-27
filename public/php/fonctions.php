<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

function getListCode($n){
    // $n correspond au nombres de jours

    $steps = array();

    for($i = 1; $i <= $n; $i++){

        $step_code = "step-day-".$i;
        $title = "Jour ".$i;
        array_push($steps, array($step_code, $title));
        // ajoute le tableau dans le tableau $steps (devient une matrice à deux dims)

    }

    // todo : a voir : passer sur une troisième page ?
    array_push($steps, array("step-summary", "Résumé", "heure"));
    array_push($steps, array("step-register", "Enregistrement", "heure"));
    return $steps;

}

function generateHTMLForStepList($steps){

    $i = 0;
    ?>
    <ol class="list-steps">
        <?php foreach ($steps as $step){ ?>
        <li><a class="step-click" id="list-step-<?php echo($step[0]); ?>" data-target="<?php echo($i); ?>"><?php echo($step[1]); $i++; ?></a></li>
        <?php } ?>
    </ol>

<?php

}

function generateHTMLForSectionScreen($steps, $dir){

    foreach ($steps as $step){ $step_code = $step[0]; ?>
    <section id="<?php echo($step_code);?>" style="visibility: hidden">
        <div class="center white-text">
            <?php include_once(__DIR__."/../views/".$dir."/".$step_code.".php"); ?>
        </div>
    </section>
    <?php } ?>

    <?php
    // on recoit comme arguments le tableau de steps, et le dossier des vues
    // à chaque elem du tableau, on va générer du code HTML identifié par un id unique
    // à savoir "step-......" pour savoir identifier chaque écran.
    // on le cache avec du style in-line "visibility: hidden",
    // et on include le contenu de la page php avec le bon fichier
    //
    //

}

function generateJSScreens($steps){

foreach ($steps as $step){
    echo("'".$step[0]."',");
    // défini le tableau en javascript sans devoir le hardcoder,
    // permet de le créer "dynamiquement" en fonction des étapes de
    // la page.
}


}