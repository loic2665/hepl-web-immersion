<?php
//-- ---------------------------------------------------- -->
//--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
//--Groupe : 2203                                         -->
//--Labo : Programmation Web avancée                      -->
//--Application : Site d'immersion à l'école              -->
//--Date de la dernière mise à jour : [DATE DU JOUR]      -->
//-- ---------------------------------------------------- -->

?>


<h2>Combien de jour souhaites-tu participer ?</h2>
<div class="form-group">
    <label for="nb-days">Nombre de jours</label>
    <select class="form-control nb-days" id="nb-days">
        <option selected disabled value="0">Choisissez un nombre de jours</option>
        <?php for($i = 1; $i <= 10; $i++){ // a changer avec la configuration du site et le calcul !!! ?>
            <option value="<?php echo($i); ?>"><?php echo($i > 1 ? $i." jours" : $i." jour"); ?></option>
        <?php } ?>
    </select>
</div>


