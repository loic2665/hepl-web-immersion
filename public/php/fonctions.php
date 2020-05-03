<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

function generateForm($champs){

    foreach ($champs as $champ){

        if($champ["type"] == "text"){ ?>

            <div class="form-group">
                <label class="col-form-label" for="<?php echo($champ["id"]); ?>"><?php echo($champ["label"]); ?></label>
                <input type="text" class="form-control" name="<?php echo($champ["name"]); ?>" placeholder="<?php echo($champ["placeholder"]); ?>" id="<?php echo($champ["id"]); ?>">
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
                    <option selected="" disabled>Veuillez selectionner une option</option>
                    <?php foreach($champ["options"] as $option){ ?>
                    <option value="<?php echo($option["value"]); ?>"><?php echo($option["text"]); ?></option>
                    <?php } ?>
                </select>
            </div>

        <?php }else if($champ["type"] == "radio"){ ?>

            <div class="form-group">
                <?php foreach($champ["options"] as $option){ ?>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="<?php echo($champ["id"]); ?>" name="<?php echo($champ["name"]); ?>" value="<?php echo($option["value"]); ?>" class="custom-control-input">
                        <label class="custom-control-label" for="<?php echo($champ["id"]); ?>"><?php echo($option["text"]); ?></label>
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
                        <input type="checkbox" class="custom-control-input" name="<?php echo($champ["name"]); ?>" value="<?php echo($option["value"]); ?>" id="<?php echo($champ["id"]); ?>">
                        <label class="custom-control-label" for="<?php echo($champ["id"]); ?>"><?php echo($option["text"]); ?></label>
                    </div>

                <?php } ?>
            </div>

        <?php }


    }

}