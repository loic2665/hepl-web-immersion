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
    <title>Immersion HEPL - Dashboard</title>
    <?php require_once(__DIR__."/../inc/head.php"); ?>
</head>
<body>

<?php require_once(__DIR__."/../inc/nav_admin.php"); ?>
<section id="content">
<?php 
    if(!estConnecte())
    {
        echo("<h1>Veuillez vous connecter<h1/>");
    }
    else
    { ?>


    <h1>Administration</h1>

    <div class="row">
        <div class="col-xl-3">
            <div class="alert alert-primary block-m">
                <div class="center white-text">

                    <h1><b>Date du jour</b></h1>
                    <span class="big-size count"><?php echo(date("d/m/Y", time())); ?>
                      </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="alert alert-primary block-m">
                <div class="center white-text">

                    <h1><b>Cours disponibles</b></h1>
                    <span class="big-size count" data-value="<?php echo(Cours::countSubjects()); ?>">
                      </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="alert alert-warning block-m">
                <div class="center white-text">

                    <h1><b>Nombre de professeurs</b></h1>
                    <span class="big-size count" data-value="<?php echo(Enseignant::countTeachers()); ?>">
                      </span>

                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="alert alert-success block-m">
                <div class="center white-text">

                    <h1><b>Nombre d'élèves inscrits</b></h1>
                    <span class="big-size count" data-value="<?php echo(Eleve::countStudents()); ?>">
                      </span>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="alert alert-secondary options">
                <div class="center white-text">


                    <h1>Configuration</h1>

                    <?php $config = Config::getAllConfig(); ?>

                    <div>
                        <span class="option-label">Forcer désactiver inscription</span>
                        <div>
                            <label class="switch-rebond">

                                <input type="checkbox" id="switch_close" <?php if($config->force_close_registration){echo("checked");} ?>>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <span class="option-label">Forcer activer inscription</span>
                        <div>
                            <label class="switch-rebond">
                                <input type="checkbox" id="switch_active"  <?php if($config->force_registration){echo("checked");} ?>>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <span class="option-label">Date debut inscription</span>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" id="date_debut" value="<?php echo(date("Y-m-d", $config->start_date)) ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark date_debut" type="button">Mettre à jour</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="option-label">Date fin inscription</span>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" id="date_fin" value="<?php echo(date("Y-m-d", $config->end_date)) ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark date_fin" type="button">Mettre à jour</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="option-label">Archiver l'année</span>
                        <div>
                            <a class="btn btn-danger arch">Archiver les données</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="alert alert-info">
                <div class="center white-text">

                    <h1><b>Les 5 derniers inscrits</b></h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Établissement</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $students = Eleve::getFiveLastStudents();
                        ?>

                        <?php foreach ($students as $ligne){ ?>
                            <tr class="table">
                                <th scope="row"><?php echo($ligne["nom"]); ?></th>
                                <th scope="row"><?php echo($ligne["prenom"]); ?></th>
                                <th scope="row"><?php echo($ligne["etablissement"]); ?></th>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- type="module" permet de dire que le fichier JS est composé de plusieurs librairies -->
<script type="module" src="./js/dashboard.js"></script>

</body>
<?php } ?>
</html>
