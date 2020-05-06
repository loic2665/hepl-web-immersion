<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 05/05/2020          -->
<!-- ---------------------------------------------------- -->


<?php require_once(__DIR__."/../php/require_all.php"); ?>


<html>
<head>
    <title>Immersion HEPL - Gérer</title>
    <?php require_once(__DIR__."/../inc/head.php"); ?>
</head>
<body>
<?php require_once(__DIR__."/../inc/nav_admin.php"); ?>
<section id="content">
    <?php
    /* Requête SQL pour récupérer la table reçue par le $_GET */

    /* Évite les attaques SQL (securite)  échape --> ' " \ */
    $gerer = addslashes(htmlspecialchars($_GET['gerer']));

    $db = new Database();
    $result = $db->conn->query("
        SELECT *
        FROM ".$gerer.";");

    if($result == false) /* Si la requête SQl ne donne pas de résultat alors on affiche le message */
    {
        echo("<h1>Erreur lors de la requête</h1>");
    }
    else /* Sinon on effectue le traitement */
    {
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        /* Requête SQL pour avoir le nom des colonnes */
        $colums = $db->conn->query(" SHOW COLUMNS FROM ".$gerer.";");
        $colname = $colums->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <article id="ajout_modif" hidden>
        <?php
        $champs = array();
        foreach ($colname as $col)
        {
            array_push($champs, generateArray($col));
        }

        ?>

        <fieldset>
            <legend>Ajouter un <?php echo($gerer); ?></legend>
            <?php generateForm($champs); ?>
        </fieldset>

        <button class="btn btn-success" id="send_btn">Valider</button>
        <button class="btn btn-danger" id="cancel_btn">Annuler</button>

    </article>
    <article>
        <legend>Gestion des <?php echo($gerer); ?></legend>
        <a class="btn btn-info">Ajouter</a>

        <table class="table table-hover">
            <thead>
            <tr> <!-- Permet d'afficher dans le tableau chaque nom de colonne récupéré -->
                <?php foreach ($colname as $ligne){ ?>
                <th scope="col"><?php echo($ligne["Field"]); ?> </th>
                <?php } ?>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($array as $ligne){ ?>
                <tr class="table"> <!-- Boucle imbriquée pour affiché les valeurs en fonction du nom de la colonne -->
                    <?php foreach ($colname as $ligne2){ ?>
                    <th scope="row"><?php echo($ligne[$ligne2["Field"]]); ?></th>
                    <?php } ?>
                    <th scope="row"><a class="btn btn-success"  data-course-id="<?php echo($ligne["id"]); ?>">Modifier</a></th>
                    <th scope="row"><a class="btn btn-danger"  data-course-id="<?php echo($ligne["id"]); ?>">Supprimer</a></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </article>
    <?php } ?>
</section>
</body>
<script>




</script>
</html>