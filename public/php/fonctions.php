<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->


/*
 *
 * Ce fichier est un fichier de fonction uq'on utilisera un peu partout sur le site, je n'avais pas d'autres idées
 * de comment l'apeller donc voilà.
 *
 *
 * concernant generateForm => le nom de la fonction est un peu tordu, il ne génère pas un firmulaire sémantique
 * mais bien juste les champs l'un à la suite de l'autre, pour savoir comment l'utiliser tu peux regarder le fichier
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
