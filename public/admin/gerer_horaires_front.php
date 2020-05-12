<!-- ---------------------------------------------------- -->
<!--Auteurs : COLLETTE Loic et DELAVAL Kevin              -->
<!--Groupe : 2203                                         -->
<!--Labo : Programmation Web avancée                      -->
<!--Application : Site d'immersion à l'école              -->
<!--Date de la dernière mise à jour : 11/05/2020          -->
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
        /* traitement pour le formulaire ajout et modif*/
        $array = $result->fetchAll(PDO::FETCH_ASSOC);

        /* Requête SQL pour avoir le nom des colonnes */
        $colums = $db->conn->query(" SHOW COLUMNS FROM ".$gerer.";");
        $colname2 = $colums->fetchAll(PDO::FETCH_ASSOC);

        /* traitement pour la liste d'affichage */
        $array2 = Horaire::getAllLessonsDisplay();

        /* on recupèle les champs qui nous intéresse pour l'ajout */
        $colname = array();
        foreach ($colname2 as $ligne){
            if(strpos($ligne["Field"], "inscription") !== FALSE)
            {
                //je n'ai pas trouver pour faire ça plus proprement -_-
            }
            else
            {
                array_push($colname, $ligne);
            }
        }
    ?>
    <article id="ajout_modif" class="hidden">
        <?php
        $champs = array();
        foreach ($colname as $col)
        {
            array_push($champs, generateArray($col));
        }

        ?>


        <h2 id="entete_ajout_modif"></h2>

        <?php generateForm($champs); ?>

        <button class="btn btn-success valid" id="send_btn">Valider</button>
        <button class="btn btn-danger annul" id="cancel_btn">Annuler</button>

    </article>
    <article id="table_list">
        <h2 id="entete_gestion"></h2>
        <a class="btn btn-info add-row">Ajouter</a>

        <table class="table table-hover">
            <thead>
            <tr> <!-- Permet d'afficher dans le tableau chaque nom de colonne récupéré -->
                <?php foreach ($colname2 as $ligne){ ?>
                <th scope="col"><?php echo($ligne["Field"]); ?> </th>
                <?php } ?>
                <th scope="col">Changer visibilité</th>
                <th scope="col">Déplacer élèves</th>
                <th scope="col">Supprimer</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($array2 as $ligne){ ?>
                <tr class="table"> <!-- Boucle imbriquée pour affiché les valeurs en fonction du nom de la colonne -->
                    <?php foreach ($colname2 as $ligne2){ ?>
                    <th scope="row"><?php echo($ligne[$ligne2["Field"]]); ?></th>
                    <?php } ?>
                    <th scope="row"><a id="chang<?php echo($ligne["id"]); ?>" class="btn btn-info visible <?php if($ligne["inscription"] > 0){echo('disabled');} ?> " data-course-id="<?php echo($ligne["id"]); ?>">Changer visibilité</a></th>
                    <th scope="row"><a id="depel<?php echo($ligne["id"]); ?>" class="btn btn-success dep  <?php if($ligne["inscription"] < 1){echo("disabled");} ?>"  data-course-id="<?php echo($ligne["id"]); ?>">Déplacer élèves</a></th>
                    <th scope="row"><a id="suppr<?php echo($ligne["id"]); ?>" class="btn btn-danger del   <?php if($ligne["inscription"] > 0){echo("disabled");} ?>"  data-course-id="<?php echo($ligne["id"]); ?>">Supprimer</a></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </article>
    <?php } ?>
</section>
<!-- pour pouvoir récuperer la valeur de $gerer dans la page JS -->
<input type="hidden" id="page" value="<?php echo $gerer; ?>" />
</body>
<!-- type="module" permet de dire que le fichier JS est composé de plusieurs librairies -->
<script type="module" src="./js/gerer.js"></script>

</html>