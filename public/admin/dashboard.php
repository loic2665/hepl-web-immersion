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

    <h1>Administration</h1>

    <div class="row">
        <div class="col-xl-4">
            <div class="nb-cours-block">
                <div class="center white-text">

                    <h1><b>Cours disponibles</b></h1>
                    <span class="big-size count" data-value="<?php echo(Cours::countSubjects()); ?>">
                      </span>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="nb-profs-block">
                <div class="center white-text">

                    <h1><b>Nombre de professeurs</b></h1>
                    <span class="big-size count" data-value="<?php echo(Enseignant::countTeachers()); ?>">
                      </span>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="nb-profs-block">
                <div class="center white-text">

                    <h1><b>Nombre d'élèves inscrits</b></h1>
                    <span class="big-size count" data-value="<?php echo(Eleve::countStudents()); ?>">
                      </span>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="last-inscrits-block">
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

<script>
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).data('value')
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                $(this).text(this.Counter.toFixed(0));
            }
        });
    });
</script>

</body>

</html>
