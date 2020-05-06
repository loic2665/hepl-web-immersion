<?php
/***********************************************************/
/*Auteurs : COLLETTE Loic et DELAVAL Kevin                 */
/*Groupe : 2203                                            */
/*Labo : Programmation Web avancée                         */
/*Application : Site d'immersion à l'école                 */
/*Date de la dernière mise à jour : 26/04/2020             */
/***********************************************************/

require_once(__DIR__."/../php/require_all.php");

/*
 *
 * Ce fichier est un fichier de fonction qu'on utilisera un peu partout sur le site, je n'avais pas d'autres idées
 * de comment l'apeller donc voilà.
 *
 *
 * concernant generateForm => le nom de la fonction est un peu tordu, il ne génère pas un formulaire sémantique
 * mais bien juste les champs les uns à la suite des l'autres, pour savoir comment l'utiliser tu peux regarder le fichier
 * /admin/index.php pour la connexion de l'administrateur, c'est court et simple.
 *
 *
 * */
function generateForm($champs){

    foreach ($champs as $champ){

        if($champ["type"] == "text"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <input type="text" class="form-control" name="<?php echo($champ["name"]); ?>" placeholder="<?php echo($champ["placeholder"]); ?>" id="<?php echo($champ["id"]); ?>">
            </div>

        <?php }else if($champ["type"] == "email"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <input type="email" class="form-control" name="<?php echo($champ["name"]); ?>" placeholder="<?php echo($champ["placeholder"]); ?>" id="<?php echo($champ["id"]); ?>">
            </div>

        <?php }else if($champ["type"] == "password"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <input type="password" class="form-control" name="<?php echo($champ["name"]); ?>" placeholder="<?php echo($champ["placeholder"]); ?>" id="<?php echo($champ["id"]); ?>">
            </div>

        <?php }else if($champ["type"] == "number"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <input type="number" class="form-control" name="<?php echo($champ["name"]); ?>" placeholder="<?php echo($champ["placeholder"]); ?>" id="<?php echo($champ["id"]); ?>" min="<?php echo($champ["min"]); ?>" max="<?php echo($champ["max"]); ?>" step="<?php echo($champ["step"]); ?>">
            </div>

        <?php }else if($champ["type"] == "select"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <select id="<?php echo($champ["id"]); ?>" name="<?php echo($champ["name"]); ?>" class="custom-select">
                    <option selected="" value="0" disabled>Veuillez selectionner une option</option>
                    <?php foreach($champ["options"] as $option){ ?>
                    <option value="<?php echo($option["value"]); ?>"><?php echo($option["text"]); ?></option>
                    <?php } ?>
                </select>
            </div>

        <?php }else if($champ["type"] == "radio"){ ?>

            <div class="form-group">
                <label class="col-form-label"><?php echo($champ["label"]); ?></label>
                <?php foreach($champ["options"] as $option){ ?>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="<?php echo($option["id"]); ?>" name="<?php echo($champ["name"]); ?>" value="<?php echo($option["value"]); ?>" class="custom-control-input">
                        <label class="custom-control-label" for="<?php echo($option["id"]); ?>"><?php echo($option["text"]); ?></label>
                    </div>

                <?php } ?>
            </div>

        <?php }else if($champ["type"] == "checkbox"){ ?>

            <div class="form-group">
                <?php foreach($champ["options"] as $option){ ?>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="<?php echo($champ["name"]); ?>" value="<?php echo($option["value"]); ?>" id="<?php echo($champ["id"]); ?>">
                        <label class="custom-control-label" for="<?php echo($champ["id"]); ?>"><?php echo($option["text"]); ?></label>
                    </div>

                <?php } ?>
            </div>

        <?php }else if($champ["type"] == "switch"){ ?>

            <div class="form-group">
                <?php foreach($champ["options"] as $option){ ?>

                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="<?php echo($champ["name"]); ?>" value="<?php echo($option["value"]); ?>" id="<?php echo($option["id"]); ?>">
                        <label class="custom-control-label" for="<?php echo($option["id"]); ?>"><?php echo($option["text"]); ?></label>
                    </div>

                <?php } ?>
            </div>

        <?php }


    }

}

function generateArray($col)
{
    if($col["Key"] == "PRI") /* On affiche pas la clé primaire dans le formulaire */
    {
        return null;
    }
    else if($col["Key"] == "MUL") /* Premet de crée le tableau pour la combobox, clés étrangères */
    {
        $table = substr($col["Field"], 3); /* Récupère le nom de la table pour la clé étrangère */

        $db = new Database();

        $colonnesToShow = array();

        /* Crée un tableaux pour les données qui nous intéresse selon la table */
        if($table == "enseignants")
        {
            $colonnesToShow = array("nom", "prenom");
        }
        else if($table == "locaux")
        {
            $colonnesToShow = array("local");
        }
        else if($table == "eleves")
        {
            $colonnesToShow = array("nom", "prenom");
        }
        else if($table == "cours")
        {
            $colonnesToShow = array("intitule");
        }
        else if($table == "type_cours")
        {
            $colonnesToShow = array("type");
        }
        else if($table == "tranches_horaires")
        {
            $colonnesToShow = array("heure_debut", "heure_fin");
        }

        $result = $db->conn->query("
        SELECT *
        FROM ".$table.";");

        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        $tab = array(
            "id" => $col["Field"],
            "type" => "select",
            "label" => $col["Field"],
            "name" => $col["Field"],
            "options" => [],
        );

        foreach ($array as $line)
        {
            $tmpArray = array();
            $tmpArray["value"] = $line["id"];

            $tmpText = "";
            $tmpText .= $line["id"]." - ";
            for ($i = 0; $i < count($colonnesToShow); $i++)
            {
                 $tmpText .= $line[$colonnesToShow[$i]]. " ";
            }
            $tmpArray["text"] = $tmpText;
            array_push($tab["options"], $tmpArray);

        }

        return $tab;

    }
    else if (strpos($col["Type"], "tinyint") !== FALSE) /* Premet de crée le tableau pour la combobox, pour les boolean */
    {
        return array(
            "id" => $col["Field"],
            "type" => "select",
            "label" => $col["Field"],
            "name" => $col["Field"],
            "options" => [
                ["value" => "1", "text" => "Oui"],
                ["value" => "0", "text" => "Non"],
            ],
        );
    }
    else if (strpos($col["Type"], "varchar") !== FALSE) /* Premet de crée le tableau pour les champs texte*/
    {
        if($col["Field"] == "email")
        {
            return array(
                "id" => $col["Field"],
                "type" => "email",
                "placeholder" => $col["Field"],
                "label" => $col["Field"],
                "name" => $col["Field"]
            );
        }
        else if($col["Field"] == "sexe")
        {
            return array(
                "id" => $col["Field"],
                "type" => "radio",
                "label" => $col["Field"],
                "name" => $col["Field"],
                "options" => [
                    ["value" => "m", "text" => "Homme", "id" => "Homme"],
                    ["value" => "f", "text" => "Femme", "id" => "Femme"],
                ],
            );
        }
        else
        {
            return array(
                "id" => $col["Field"],
                "type" => "text",
                "placeholder" => $col["Field"],
                "label" => $col["Field"],
                "name" => $col["Field"]
            );
        }
    }
    else if (strpos($col["Type"], "date") !== FALSE)
    {
        return array(
            "id" => $col["Field"],
            "type" => "date",
            "placeholder" => $col["Field"],
            "label" => $col["Field"],
            "name" => $col["Field"]
        );
    }
}