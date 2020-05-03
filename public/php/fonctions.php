<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

function getListCodeInscription($n){
    // $n correspond au nombres de jours

    $steps = array();

    for($i = 1; $i <= $n; $i++){

        $step_code = "step-day-".$i;
        $title = "Jour ".$i;
        array_push($steps, array($step_code, $title, "step-day"));
        // ajoute le tableau dans le tableau $steps (devient une matrice à deux dims)

    }

    return $steps;

}

function getListCodeRegister(){

    $steps = array();

    // todo : a voir : passer sur une troisième page ?
    array_push($steps, array("step-summary", "Résumé", "step-summary"));
    array_push($steps, array("step-register", "Enregistrement", "step-register"));
    return $steps;

}




function generateHTMLForStepList($steps_inscription, $steps_register){

    $i = 0;
    ?>
    <ol class="list-steps">
        <?php foreach (array_merge($steps_inscription, $steps_register) as $step){ ?>
            <li><a class="step-click" id="list-step-<?php echo($step[0]); ?>" data-target="<?php echo($i); ?>"><?php echo($step[1]); $i++; ?></a></li>
        <?php } ?>
    </ol>

<?php

}

function generateHTMLForSectionScreenDays($steps, $dir){

    /* VARS A TOUTE LES VUES */

    // normalement il y a juste une variable $i qui permettra d'identifier chaque champs
    $jour = 1;

    /* END OF VARS */

    foreach ($steps as $step){ $stepFile = $step[2]; $stepID = $step[0]; ?>
    <section id="<?php echo($stepID);?>" style="visibility: hidden">
        <div class="center white-text">
            <?php

            $path = __DIR__."/../views/".$dir."/".$stepFile.".php";
            $output = NULL;
            if(file_exists($path)){
                // Extract the variables to a local namespace
                //extract($variables);

                // Start output buffering
                ob_start();

                // Include the template file
                include($path);

                // End buffering and return its contents
                $output = ob_get_clean();
            }else{
                $output = "Vue manquante ? Fichier: ".$path;
            }
            print $output;
            ?>

        </div>
    </section>
    <?php }

}

function generateHTMLForSectionScreenRegister($steps, $dir){

    /* VARS A TOUTE LES VUES */

    // normalement il y a juste une variable $i qui permettra d'identifier chaque champs
    $i = 0;

    /* END OF VARS */

    foreach ($steps as $step){ $stepFile = $step[2]; $stepID = $step[0]; ?>
        <section id="<?php echo($stepID);?>" style="visibility: hidden">
            <div class="center white-text">
                <?php

                $path = __DIR__."/../views/".$dir."/".$stepFile.".php";
                $output = NULL;
                if(file_exists($path)){
                    // Extract the variables to a local namespace
                    //extract($variables);

                    // Start output buffering
                    ob_start();

                    // Include the template file
                    include($path);

                    // End buffering and return its contents
                    $output = ob_get_clean();
                }else{
                    $output = "Vue manquante ? Fichier: ".$path;
                }
                print $output;
                ?>

            </div>
        </section>
    <?php }

}



function generateJSScreens($steps_inscription, $steps_register){

    foreach (array_merge($steps_inscription, $steps_register) as $step){
        echo("'".$step[0]."',");
    }

    // défini le tableau en javascript sans devoir le hardcoder,
    // permet de le créer "dynamiquement" en fonction des étapes de
    // la page.
}