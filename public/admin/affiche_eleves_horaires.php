<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 12/05/2020          -->
<!-- ---------------------------------------------------- -->


<?php require_once(__DIR__."/../php/require_all.php"); ?>


<html>
<head>
    <title>Immersion HEPL - Afficher</title>
    <?php require_once(__DIR__."/../inc/head.php"); ?>
</head>
<body>
<?php require_once(__DIR__."/../inc/nav_admin.php"); ?>
<section id="content">
    <?php
        /* traitement pour la liste d'affichage */
        $array = Eleves_horaires::getAllEleveHoraireAffiche();
        ?>
        <article>
            <h2>Horaire des élèves</h2>

            <table class="table table-hover">
                <thead>
                <tr> <!-- Permet d'afficher dans le tableau chaque nom de colonne récupéré -->
                    <?/*php foreach ($colname as $ligne){ ?>
                        <th scope="col"><?php echo($ligne["Field"]); ?> </th>
                    <?php }*/ ?>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($array as $ligne){ ?>
                    <tr class="table"> <!-- Boucle imbriquée pour affiché les valeurs en fonction du nom de la colonne -->
                        <?php /*foreach ($colname as $ligne2){ ?>
                            <th scope="row"><?php echo($ligne[$ligne2["Field"]]); ?></th>
                        <?php }*/ ?>
                        <th scope="row"><a class="btn btn-success modif"  data-course-id="<?php echo($ligne["id"]); ?>">Modifier</a></th>
                        <th scope="row"><a class="btn btn-danger del"  data-course-id="<?php echo($ligne["id"]); ?>">Supprimer</a></th>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </article>
</section>
<!-- pour pouvoir récuperer la valeur de $gerer dans la page JS -->
<input type="hidden" id="page" value="<?php echo $gerer; ?>" />
</body>
<!-- type="module" permet de dire que le fichier JS est composé de plusieurs librairies -->
<script type="module" src="./js/gerer.js"></script>

</html>